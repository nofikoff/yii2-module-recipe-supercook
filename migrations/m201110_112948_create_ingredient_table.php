<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredient}}`.
 */
class m201112_112948_create_ingredient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredient}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique(),
            'status' => $this->integer(1),
            'photo' => $this->string(200)->null(),
        ]);

        $this->insert('ingredient', [
            "name" => 'Вода',
            "photo" => null,
            "status" => 1,
        ]);

        $this->insert('ingredient', [
            "name" => 'Сахар',
            "photo" => null,
            "status" => 1,
        ]);

        $this->insert('ingredient', [
            "name" => 'Заварка',
            "photo" => null,
            "status" => 1,
        ]);

        $this->insert('ingredient', [
            "name" => 'Сливки',
            "photo" => null,
            "status" => 1,
        ]);

        $this->insert('ingredient', [
            "name" => 'Топик банановый',
            "photo" => null,
            "status" => 0,
        ]);

        $this->insert('ingredient', [
            "name" => 'Растворимый кофе',
            "photo" => null,
            "status" => 1,
        ]);

        $this->insert('ingredient', [
            "name" => 'Коньяк',
            "photo" => null,
            "status" => 1,
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ingredient}}');
    }
}
