<?php

use yii\bootstrap\Html;
use yii\grid\GridView;

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


    <?php echo $this->render('_search',
        [
            'model' => $searchModel,
            'oneIngredientModel' => $oneIngredientModel
        ]);


    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',


            [
                'attribute' => 'ingredients',
                'format' => 'raw',
                'value' => function ($model) {
                    $str = "";
                    foreach ($model->ingredients as $ingredient) {
                        $str .= "- " . $ingredient->name . " " . ($ingredient->status ? "" : "<span style='color: red'>отключен</span>") . "<br>";

                    }
                    return $str;
                },
                //                'contentOptions' => ['style' => 'min-width: 150px; max-width: 200px; '], // <-- right here
                'filter' => $list_ingredients_id_name,

            ],


        ],
    ]);


    ?>
</div>
