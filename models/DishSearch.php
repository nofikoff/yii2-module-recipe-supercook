<?php

namespace nofikoff\supercook\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DishSearch represents the model behind the search form of `nofikoff\supercook\models\Dish`.
 */
class DishSearch extends Dish
{
    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'photo'], 'safe'],
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
        $query = Dish::find();

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
        ]);

        $query->andFilterWhere(['like', 'dish.name', $this->name])
            ->andFilterWhere(['like', 'dish.photo', $this->photo]);

        return $dataProvider;
    }


}
