<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredient2dish}}`.
 */
class m201112_112956_create_ingredient2dish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredient2dish}}', [
            'id' => $this->primaryKey(),
            'ingredient_id' => $this->integer()->notNull(),
            'dish_id' => $this->integer()->notNull(),
            'ingredient_weight_gram' => $this->integer()->Null(),
        ]);

        $this->createIndex(
            'idx-ingredient2dish-ingredient_id',
            'ingredient2dish',
            'ingredient_id'
        );

        $this->addForeignKey(
            'fk-ingredient2dish-ingredient_id',
            'ingredient2dish',
            'ingredient_id',
            'ingredient',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-ingredient2dish-dish_id',
            'ingredient2dish',
            'dish_id'
        );

        $this->addForeignKey(
            'fk-ingredient2dish-dish_id',
            'ingredient2dish',
            'dish_id',
            'dish',
            'id',
            'CASCADE'
        );

        // только одна пара ингредиент - блюдо
        $this->createIndex(
            'idx-unique-ingredient2dish-ingredient_id-dish_id',
            'ingredient2dish',
            'ingredient_id, dish_id',
            1
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //  // drops foreign key for table `user`
        //        $this->dropForeignKey(
        //            'fk-post-author_id',
        //            'post'
        //        );
        //
        //        // drops index for column `author_id`
        //        $this->dropIndex(
        //            'idx-post-author_id',
        //            'post'
        //        );
        //
        //        // drops foreign key for table `category`
        //        $this->dropForeignKey(
        //            'fk-post-category_id',
        //            'post'
        //        );
        //
        //        // drops index for column `category_id`
        //        $this->dropIndex(
        //            'idx-post-category_id',
        //            'post'
        //        );

        $this->dropTable('{{%ingredient2dish}}');
    }
}
