<?php

use yii\helpers\Html;
use yii\grid\GridView;


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
                        $str .= "- <a href='/recipe/ingredient/update?id=$ingredient->id'>" . $ingredient->name . "</a> " . ($ingredient->status ? "" : "<span style='color: red'>отключен</span>") . "<br>";

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
