<?php

namespace app\modules\recipe\controllers;

use app\modules\recipe\models\Dish;
use app\modules\recipe\models\DishSearch;
use app\modules\recipe\models\Ingredient;
use app\modules\recipe\models\Ingredient2dish;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

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

        // валидация по клоичеству параметров
        if (isset(Yii::$app->request->queryParams['DishSearch']['atr_interface_ingredient_id'])) {
            $queryParams = array_unique(Yii::$app->request->queryParams['DishSearch']['atr_interface_ingredient_id']);
            $queryParams = array_filter($queryParams, function($a) {return $a !== "";});
            //print_r($queryParams);
            if (sizeof($queryParams) == 1) {
                Yii::$app->session->setFlash('danger', "Укажите больше 1 ингредиента");
            }
        }
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search($queryParams);

        // джойним с ингредиентами в поисках не активных (в серч модели уже есть)
        //$dataProvider->query->joinWith(['ingredients']);
        // только те блюда у кого активные ингрдиенты - ДЛЯ ГЛАВНОЙ - Админу это условие НЕ надо
        $dataProvider->query->andFilterWhere(
            [
                'not in', 'dish.id',
                (Dish::find()
                    ->select(['dish.id'])
                    ->joinWith(['ingredients'])
                    ->andFilterWhere(['ingredient.status' => 0])
                )
            ]);

        // flash сообщение о результате поиска
        if (Yii::$app->request->get()) {

            if (!$dataProvider->getTotalCount()) {
                //error,danger,success,info,warning
                Yii::$app->session->setFlash('danger', "Ничего не найдено");
            }
        }


        return $this->render('index', [
            'queryParams' => $queryParams,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'list_ingredients_id_name' => ArrayHelper::map(Ingredient::find()->orderBy('name')->asArray()->all(), 'id', 'name'),

        ]);
    }
}
