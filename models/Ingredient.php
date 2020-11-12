<?php

namespace app\modules\recipe\models;

use Yii;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $id
 * @property string $name
 * @property string|null $photo
 *
 * @property Ingredient2dish[] $ingredient2dishes
 * @property Dish[] $dishes
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['photo'], 'string', 'max' => 200],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'photo' => 'Photo',
        ];
    }

    /**
     * Gets query for [[Ingredient2dishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient2dishes()
    {
        return $this->hasMany(Ingredient2dish::className(), ['ingredient_id' => 'id']);
    }

    /**
     * Gets query for [[Dishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasMany(Dish::className(), ['id' => 'dish_id'])->viaTable('ingredient2dish', ['ingredient_id' => 'id']);
    }
}
