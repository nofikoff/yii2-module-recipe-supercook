<?php

namespace app\modules\recipe\controllers;

use app\modules\recipe\models\Ingredient;
use app\modules\recipe\models\Ingredient2dish;
use Yii;
use app\modules\recipe\models\Dish;
use app\modules\recipe\models\DishSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DishController implements the CRUD actions for Dish model.
 */
class DishController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $action->controller->redirect('/site/login');
                },

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

        ];
    }

    /**
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Dish();
        // список моделей ингредиентов N штук по молчанию
        for ($i = 0; $i < Yii::$app->getModule('recipe')->params['max-number-ingredients-one-dish']; $i++) {
            $listModelsIngredient[] = new Ingredient2dish();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // орабатываем список НОВЫХ ингредиентов
            foreach (Yii::$app->request->post('Ingredient2dish')['ingredient_id'] as $key => $ingradient_id) {
                if ($ingradient_id) {
                    $listModelsIngredient[$key]->dish_id = $model->id;
                    $listModelsIngredient[$key]->ingredient_id = $ingradient_id;
                    $listModelsIngredient[$key]->save();
                }
            }
            //
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $list_ingredients_id_name = ArrayHelper::map(Ingredient::find()->orderBy('name')->asArray()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'listModelsIngredient' => $listModelsIngredient,
            'list_ingredients_id_name' => $list_ingredients_id_name,
        ]);
    }

    /**
     * Updates an existing Dish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // список моделей ингредиентов - только те что в наличии

        // массив имеющихся
        $listModelsIngredient = Ingredient2dish::find()->where(['dish_id' => $id])->All();
        $find = sizeof($listModelsIngredient);
        // список моделей ингредиентов N штук по молчанию пустых болванок
        for ($i = 0; $i < (Yii::$app->getModule('recipe')->params['max-number-ingredients-one-dish'] - $find); $i++) {
            $listModelsIngredient[] = new Ingredient2dish();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // сбрасываем старые ингредиенты
            Yii::$app->db->createCommand("DELETE FROM `ingredient2dish` WHERE `dish_id` = " . $model->id)->execute();
            // орабатываем список новых ингредиентов
            foreach (Yii::$app->request->post('Ingredient2dish')['ingredient_id'] as $key => $ingradient_id) {
                if ($ingradient_id) {
                    $modelIngredient = new Ingredient2dish();
                    $modelIngredient->dish_id = $model->id;
                    $modelIngredient->ingredient_id = $ingradient_id;
                    $modelIngredient->save();
                }
            }
            //
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $list_ingredients_id_name = ArrayHelper::map(Ingredient::find()->orderBy('name')->asArray()->all(), 'id', 'name');

        return $this->render('update', [
            'model' => $model,
            'listModelsIngredient' => $listModelsIngredient,
            'list_ingredients_id_name' => $list_ingredients_id_name,
        ]);
    }

    /**
     * Deletes an existing Dish model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
