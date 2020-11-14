
# ДЕМО
https://recipe.protection.com.ua/


# УСТАНОВКА МОДУЛЯ

- Модуль разместить в папке @app\modules\recipe\
- Добавить зависимость composer require kartik-v/yii2-widget-select2
- Добавить в конфиг блока modules
```
    'modules' => [
        'recipe' => [
            'class' => 'app\modules\recipe\Recipe',
        ],
    ],
```
## Выполнить миграцию: ##
yii migrate/up --migrationPath=@app/modules/recipe/migrations

# ЗАДАНИЕ
Создать модуль выборки блюд по заданным пользователем ингредиентам. Административная часть:

## Админ часть ##
- CRUD добавления ингредиентов.
- CRUD формирования блюд из этих ингредиентов.
- Администратор может скрыть один из ингредиентов, в этом случае блюдо содержащее этот ингредиент тоже должно быть скрыто.

## Пользовательская часть: ##
Пользователь может выбрать до 5ти ингредиентов для приготовления блюда, при этом:
- Если выбрано менее 2х ингредиентов  не производить поиск, выдать сообщение: “Выберите больше ингредиентов”.
- Если найдены блюда с полным совпадением ингредиентов вывести только их.
- Если найдены блюда с частичным совпадением ингредиентов  вывести в порядке уменьшения совпадения ингредиентов вплоть до 2х.
- Если найдены блюда с совпадением менее 2х ингредиента или не найдены - “Ничего не найдено”.

# ОТЧЕТ

- Поставил Yii2 c помощью composer (15 минут)
- Создал миграцию БД yii migrate/create dish_table --migrationPath=/modules/recipe/migrations (30 минут)
- Сегенрировал by Gii модуль/gii/module (5 мин)
- Сгенерировал by Gii модели модуля с учетом неймспейс app\modules\recipe\models (10 мин)
  убедился что ForeignKeys связи прописаны во всех трех моделях
- Сгенерировал CRUD by Gii (15 минут)
  представления и пр с учетом пути @app/modules/recipe/views/
- Подправил дефолтный шаблон для навигации по разделам модуля (15 мин)
- Авторизация (5 мин)
- Шаблон редактирования Блюда + Ajax форма Select2 (15 мин)
- Вынес параметры/config модуля - значание максимальное количество ингрединетов в блюде 5 шт
- Шаблон выбора Блюда + Ajax контроллер /serch + JS обработки события для формирования POST запроса (60 мин)
- Подключение JS в assets модуля (10 мин)
- Search Model блюд на главной. MySQL запросы и проверки (30 мин)
- Тестирование (10 мин)





