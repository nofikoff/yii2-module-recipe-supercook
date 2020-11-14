<?php

use yii\helpers\Html;
use yii\grid\GridView;


$this->title = 'Ingredients';
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ingredient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',

            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status ? "ok" : "<span style='color: red'>ОТКЛЮЧЕН</span>";
                },
                'filter' => [0 => 'отключен', 1 => 'включен'],

            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
