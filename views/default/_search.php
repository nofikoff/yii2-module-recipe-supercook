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

    <div class="row">
        <?php
        //$listIdSearchIngredient
        foreach ($listModelsIngredient as $key => $ingredient) {
            echo $form
                // присваиваем индекс полю атрибута т.к. здесь все обьекты с одинаковым и менем и атрибутом
                ->field($ingredient, "ingredient_id[]", [])
                ->dropDownList(
                    $list_ingredients_id_name,
                    //лайфхак - для режима UPDATE указываем какой параметр на до селектить
                    ['prompt' => '-Select one-', 'options' => [$ingredient->ingredient_id => ["Selected" => true]]]
                )
                ->label('Ingredient #' . ($key + 1));
        }

        $oneIngredientModel
        ?>
        <div class="col-md-3">
<!--            --><?//=
//            $form->field($model, 'education_id')
//                ->dropDownList(
//                    \yii\helpers\ArrayHelper::map(
//                        \app\models\Education::find()
//                            ->select('id, name_education')
//                            ->all(),
//                        'id',
//                        'name_education'
//                    ),
//                    ['prompt' => '- не важно -']
//                )
//            ?>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', ['/'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
