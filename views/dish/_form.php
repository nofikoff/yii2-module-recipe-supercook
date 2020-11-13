<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\recipe\models\Dish */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php

    echo $form->field($model, 'ingredientsArray')->widget(\kartik\select2\Select2::classname(), [
        'name' => 'ingredients',
        'language' => 'ru',
        'value' => $model->ingredients, // initial value (will be ordered accordingly and pushed to the top)
        'data' => $list_ingredients_id_name,
        'maintainOrder' => true,
        'showToggleAll' => false,
        'toggleAllSettings' => [
            'unselectLabel' => '<i class="glyphicon glyphicon-remove-sign"></i> Убрать все',
            'unselectOptions' => ['class' => 'text-danger'],
        ],
        'options' => ['placeholder' => 'Выберите ингредиенты', 'multiple' => true],
        'pluginOptions' => [
            'tags' => false,
            'maximumSelectionLength' => Yii::$app->getModule('recipe')->params['max_number_ingredients_one_dish'],
        ],
    ])->label('Ингредиенты');
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
