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
        $dsplay_none = false;
        $searchModel = new DishSearch();
        $queryParams=[];
        // валидация по клоичеству параметров
//        if (isset(Yii::$app->request->queryParams['DishSearch']['atr_interface_ingredient_id'])) {
//            $queryParams = array_unique(Yii::$app->request->queryParams['DishSearch']['atr_interface_ingredient_id']);
//            $queryParams = array_filter($queryParams, function ($a) {
//                return $a !== "";
//            });
//            if (sizeof($queryParams) < 2) {
//                //error,danger,success,info,warning
//                Yii::$app->session->setFlash('danger', "Укажите больше 1 ингредиента");
//                $dsplay_none = true;
//            }
//        } else {
//            $dsplay_none = true;
//        }

        // Если найдены блюда с полным совпадением ингредиентов вывести только их.
        $dataProvider = $searchModel->searchCompleteMatch($queryParams);
//        if (!$dataProvider->getTotalCount()) {
//            // Если найдены блюда с частичным совпадением ингредиентов  вывести в порядке уменьшения
//            // совпадения ингредиентов вплоть до 2х.
//            $dataProvider = $searchModel->search($queryParams);
//            //Если найдены блюда с совпадением менее чем 2 ингредиента или не найдены вовсе  вывести “Ничего не найдено”.
//            if (!$dataProvider->getTotalCount()) {
//                $dataProvider = $searchModel->search($queryParams);
//            }
//        }

        // джойним с ингредиентами не активных (в серч модели уже есть)
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

        // гасим виджет таблицы если выше приказали независимо от результата
        /**if ($dsplay_none)
         * $dataProvider->query->where('0=1');**/

        // ничего не нашли
        if (!$dataProvider->getTotalCount() and Yii::$app->request->get()) {
            //error,danger,success,info,warning
            Yii::$app->session->setFlash('warning', "Ничего не найдено");
        }
        //}


        return $this->render('index', [
            'queryParams' => $queryParams,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'list_ingredients_id_name' => ArrayHelper::map(Ingredient::find()->orderBy('name')->asArray()->all(), 'id', 'name'),

        ]);
    }
}
