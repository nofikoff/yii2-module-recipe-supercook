<?php
$this->title = 'Create Ingredient';
$this->params['breadcrumbs'][] = ['label' => 'Recipe search', 'url' => ['/recipe']];
?>
<div class="recipe-default-index">
    <h1>Recipe module</h1>
    <p>

    <h3>Модуль позволяет создать и управлять базой данных рецептов</h3>
    <ul>
        <li>Администратор базы/ авторизированный пользователь - создает рецепты из ингредиентов<br>
            Авторизация средствами Yii2 <br>
            Логин Пароль на админку admin / admin
        </li>
        <ul>
            <li><a href="/recipe/dish">Блюда</a></li>
            <li><a href="/recipe/ingredient">Ингредиенты</a></li>
        </ul>


        <li>Пользователи системы могут фильтровать/искать рецепты в базе</li>
    </ul>

    </p>

</div>
