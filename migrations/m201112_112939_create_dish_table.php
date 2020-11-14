<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dish}}`.
 */
class m201112_112939_create_dish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dish}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique(),
            'photo' => $this->string(200)->null(),
        ]);

        $this->insert('dish', [
            "name" => 'Чашка черного чая',
            "photo" => null,
        ]);

        $this->insert('dish', [
            "name" => 'Чашка кофе',
            "photo" => null,
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dish}}');
    }
}
