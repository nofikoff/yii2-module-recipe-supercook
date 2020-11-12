<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\recipe\models\DishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dishes';
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="dish-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return "<a href='/recipe/dish/update?id=$model->id'>$model->name</a>";
                },
            ],


            [
                'attribute' => 'ingredients',
                'format' => 'raw',
                'value' => function ($model) {
                    $str = "";
                    foreach ($model->ingredients as $ingredient) {
                        $str .= "- " . $ingredient->name . " " . ($ingredient->status ? "" : "<span style='color: red'>отключен</span>") . "<br>";

                    }
                    return $str;
                },
                //                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here
                'filter' => $list_ingredients_id_name,

            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
