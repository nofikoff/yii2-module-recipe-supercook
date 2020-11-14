<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nofikoff\supercook\models\Ingredient */

$this->title = 'Create Ingredient';
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
$this->params['breadcrumbs'][] = ['label' => 'Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
