<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\recipe\models\DishSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dish-search">


    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    ?>

<!--    <div class="row">-->
<!--        --><?php
//        for ($i = 0; $i < Yii::$app->getModule('recipe')->params['max_number_ingredients_one_dish']; $i++) {
//            echo '<div class="col-md-4">';
//            echo $form
//                // присваиваем индекс полю атрибута т.к. здесь все обьекты с одинаковым и менем и атрибутом
//                ->field($model, "atr_interface_ingredient_id[]", [])
//                ->dropDownList(
//                    $list_ingredients_id_name,
//                    //лайфхак - для режима UPDATE указываем какой параметр надо селектить
//                    ['prompt' => '-Select one-', 'options' => [$queryParams[$i] => ["Selected" => true]]]
//                )
//                ->label('Ingredient #' . ($i + 1));
//            echo '</div>';
//        }
//        ?>
<!--    </div>-->

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', ['/'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
