<?php

namespace nofikoff\supercook\models;


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

    private $_ingredientsArray;


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
            [['name'], 'unique', 'message' => 'Блюдо с таким названием уже существует'],
            [['ingredientsArray'], 'safe'],
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

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->updateIngredients();
    }

    private function updateIngredients()
    {
        $currentIngredientsIds = $this->getIngredients()->select('id')->column();
        $newIngredientsIds = $this->getIngredientsArray();

        foreach (array_filter(array_diff($newIngredientsIds, $currentIngredientsIds)) as $IngredientId) {
            if ($Ingredient = Ingredient::findOne($IngredientId)) {
                $this->link('ingredients', $Ingredient);
            }
        }

        foreach (array_filter(array_diff($currentIngredientsIds, $newIngredientsIds)) as $IngredientId) {
            if ($Ingredient = Ingredient::findOne($IngredientId)) {
                $this->unlink('ingredients', $Ingredient, true);
            }
        }
    }

    public function getIngredientsArray()
    {
        if ($this->_ingredientsArray === null) {
            $this->_ingredientsArray = $this->getIngredients()->select('id')->column();
        }
        return $this->_ingredientsArray;
    }

    public function setIngredientsArray($value)
    {
        $this->_ingredientsArray = (array)$value;

    }





}
