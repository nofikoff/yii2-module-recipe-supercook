<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nofikoff\supercook\models\Dish */

$this->title = 'Create Dish';
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="dish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_ingredients_id_name' => $list_ingredients_id_name,
    ]) ?>

</div>
