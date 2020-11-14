<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nofikoff\supercook\models\Dish */

$this->title = 'Update Dish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_ingredients_id_name' => $list_ingredients_id_name,
    ]) ?>

</div>
