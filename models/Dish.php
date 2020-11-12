<?php

namespace app\modules\recipe\models;

use Yii;

/**
 * This is the model class for table "dish".
 *
 * @property int $id
 * @property string $name
 * @property string|null $photo
 *
 * @property Ingredient2dish[] $ingredient2dishes
 * @property Ingredient[] $ingredients
 */
class Dish extends \yii\db\ActiveRecord
{

    public $atr_interface_ingredient_id;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dish';
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
            [['atr_interface_ingredient_id'], 'safe'],
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
        return $this->hasMany(Ingredient2dish::className(), ['dish_id' => 'id']);
    }

    /**
     * Gets query for [[Ingredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingredient_id'])->viaTable('ingredient2dish', ['dish_id' => 'id']);
    }

}
