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
    // список моделей игредиентов для отображения в виде списка дропдаунов
    if (isset($listModelsIngredient))
        foreach ($listModelsIngredient as $key => $ingredient) {
            echo $form
                // присваиваем индекс полю, т.к. здесь все обьекты с одинаковым и менем и атрибутом
                ->field($ingredient, "ingredient_id[]")
                ->dropDownList(
                    $list_ingredients_id_name,
                    //лайфхак - для режима UPDATE указываем какой параметр на до селектить
                    ['prompt' => '-Select one-', 'options' => [$ingredient->ingredient_id => ["Selected" => true]]]
                )
                ->label('Ingredient #' . ($key + 1));
        }
    ?>


    <!--    --><? //= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
