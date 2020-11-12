<?php

namespace app\modules\recipe\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\recipe\models\Ingredient2dish;

/**
 * Ingredient2dishSearch represents the model behind the search form of `app\modules\recipe\models\Ingredient2dish`.
 */
class Ingredient2dishSearch extends Ingredient2dish
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ingredient_id', 'dish_id', 'ingredient_weight_gram'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ingredient2dish::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ingredient_id' => $this->ingredient_id,
            'dish_id' => $this->dish_id,
            'ingredient_weight_gram' => $this->ingredient_weight_gram,
        ]);

        return $dataProvider;
    }
}
