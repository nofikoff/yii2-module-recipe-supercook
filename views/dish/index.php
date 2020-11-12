<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\recipe\models\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dishes';
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
$this->params['breadcrumbs'][] = $this->title;

//Yii::$app->getModule('recipe')->params['max-number-ingredients-one-dish'];

?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'photo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
