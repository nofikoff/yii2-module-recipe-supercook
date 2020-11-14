<?php

use kartik\select2\Select2;
use yii\bootstrap\Html;
use yii\grid\GridView;
use nofikoff\supercook\assets\RecipeAsset;
RecipeAsset::register($this);

$this->title = 'Create Ingredient';
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
?>
<div class="recipe-default-index">
    <p>

    <h2>Модуль позволяет создать и управлять базой данных рецептов</h2>
    <ul>
        <li>Администратор базы/ авторизированный пользователь - создает рецепты из ингредиентов<br>
            Авторизация средствами Yii2 <br>
            Логин Пароль admin / admin
        </li>
        <ul>
            <li><a href="/recipe/dish">Блюда</a></li>
            <li><a href="/recipe/ingredient">Ингредиенты</a></li>
        </ul>


        <li>Пользователи системы могут фильтровать/искать рецепты в базе</li>
    </ul>

    </p>

</div>
<hr>
<div class="dish-index">


    <?php echo Select2::widget([
        'name' => 'selected',
        'language' => 'ru',
        'id' => 'ingredient-select',
        'data' => $list_ingredients_id_name,
        'showToggleAll' => false,
        'options' => ['placeholder' => 'Выберите ингредиент ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'maximumSelectionLength' => Yii::$app->getModule('recipe')->params['max_number_ingredients_one_dish'],
        ],
    ]);


    ?>
</div>
<div id="search-result"></div>


