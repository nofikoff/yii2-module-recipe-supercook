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

        $oneIngredientModel = new Ingredient();

        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // джойним с ингредиентами в поисках не активных
        $dataProvider->query->joinWith(['ingredients']);
        // только те блюда у кого активные инградиенты
        $dataProvider->query->where(
            [
                'not in',
                'dish.id',
                (Dish::find()
                    ->select(['dish.id'])
                    ->joinWith(['ingredients'])
                    ->andFilterWhere(['ingredient.status' => 0])
                )
            ]);


        // обработчик
        if (Yii::$app->request->get()) {

            if (!$dataProvider->getTotalCount()) {
                //error,danger,success,info,warning
                Yii::$app->session->setFlash('danger', "Ничего не найдено");

            }
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'oneIngredientModel' => $oneIngredientModel,
            'list_ingredients_id_name' => ArrayHelper::map(Ingredient::find()->orderBy('name')->asArray()->all(), 'id', 'name'),

        ]);
    }
}
