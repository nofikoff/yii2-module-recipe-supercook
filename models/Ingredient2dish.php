<?php

namespace app\modules\recipe\models;

use Yii;

/**
 * This is the model class for table "ingredient2dish".
 *
 * @property int $id
 * @property int $ingredient_id
 * @property int $dish_id
 * @property int|null $ingredient_weight_gram
 *
 * @property Dish $dish
 * @property Ingredient $ingredient
 */
class Ingredient2dish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient2dish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredient_id', 'dish_id', 'ingredient_weight_gram'], 'integer'],
            [['ingredient_id', 'dish_id'], 'unique', 'targetAttribute' => ['ingredient_id', 'dish_id']],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::className(), 'targetAttribute' => ['dish_id' => 'id']],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingredient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ingredient_id' => 'Ingredient ID',
            'dish_id' => 'Dish ID',
            'ingredient_weight_gram' => 'Ingredient Weight Gram',
        ];
    }

    /**
     * Gets query for [[Dish]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['id' => 'dish_id']);
    }

    /**
     * Gets query for [[Ingredient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }
}
