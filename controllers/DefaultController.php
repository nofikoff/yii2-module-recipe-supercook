<?php

namespace app\modules\recipe\controllers;

use app\modules\recipe\models\Dish;
use app\modules\recipe\models\DishSearch;
use app\modules\recipe\models\Ingredient;
use app\modules\recipe\models\Ingredient2dish;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `recipe` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $list_ingredients_id_name = Ingredient::find()->select(['name', 'id'])->indexBy('id')->andWhere(['status' => '1'])->column();
        return $this->render('index', [
            'list_ingredients_id_name' => $list_ingredients_id_name,
        ]);
    }

    public function actionSearch()
    {
        if (!Yii::$app->request->isAjax) {
            die("Ajax");
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        $selected = \Yii::$app->request->post('selected');

        //выбираем все блюда для текущего набора ингредиентов
        $matches = Ingredient2dish::find()
            //джойним три траблицы
            ->select(['dish.name', 'ingredient2dish.dish_id', 'COUNT(ingredient.id) as MatchCount'])
            ->leftJoin('ingredient', 'ingredient.id = ingredient2dish.ingredient_id')
            ->leftJoin('dish', 'dish.id = ingredient2dish.dish_id')
            // только текущий набор инг
            ->andWhere(['in', 'ingredient_id', $selected])
            // только активные инг
            ->andWhere('ingredient.status = 1')
            //группирум резуьлта по блюдам
            ->groupBy('ingredient2dish.dish_id')
            // только те блда где совпало от 2х инг
            ->having('COUNT(ingredient_id)>=2')
            // сортируем блюда по количеству совпавших инг
            ->orderBy('MatchCount DESC')
            ->asArray()
            ->all();

        // не менее 2з ингредиентов
        if (sizeof($selected) < 2) {
            return [
                'status' => 'ok',
                'result' => '<p class="text-warning">Выберите больше ингредиентов</p>'
            ];
        }

        //пустой результат
        if (empty($matches)) {
            return [
                'status' => 'ok',
                'result' => '<p class="text-warning">Ничего не найдено</p>'
            ];
        }

        $someMatches = [];
        $exactMatch = [];

        // переберм полученные блюда
        foreach ($matches as $matchElement) {
            $ingredientsArray = [];
            $dishQuery = Ingredient::find()->joinWith('ingredient2dishes')->where(['dish_id' => $matchElement['dish_id']]);
            // из чего найденное блюда
            $ingredients_list = $dishQuery->all();
            // сколько инг
            $count = $dishQuery->count();


            // перебираем инг в массив $ingredientsArray
            foreach ($ingredients_list as $item) {
                // не смотря на присутсвие в запрсе ingredient.status = 1
                // пропускаем сразу блдюда с неативными инг
                if (!$item->status) {
                    //следующее блюдо
                    continue 2;
                }

                //подкраишваем список инг
                $ingredientsArray[] = in_array($item->id, $selected) ?
                    Html::tag('span', $item->name, ['class' => 'text-info'])
                    :
                    $item->name;
            }

            $ingredients = implode(', ', $ingredientsArray);
            $name = $matchElement['name'] . ' [ совпадений: ' . $matchElement['MatchCount'] . ' ]';

            $someMatches[$name] = $ingredients;
            if ($matchElement['MatchCount'] == $count && $count == sizeof($selected)) {
                $exactMatch[$name] = $ingredients;
            }
        }

        // отрисовываем списко блюд
        return [
            'result' => $this->renderAjax('_item', [
                // если точных совпадений нет - выводим частичные
                'dishes' => (!empty($exactMatch)) ? $exactMatch : $someMatches,
                'comment' => (!empty($exactMatch)) ? 'Точное совпадение' : 'Частичное совпадение',
            ]),
            'status' => 'ok'
        ];
    }

}
