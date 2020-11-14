<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model nofikoff\supercook\models\Ingredient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <hr>
    <?= $form->field($model, 'status')->checkbox()->label('Ingredient status affects dish status') ?>


    <!--    --><?//= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
