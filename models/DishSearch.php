<?php

namespace app\modules\recipe\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DishSearch represents the model behind the search form of `app\modules\recipe\models\Dish`.
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

        $query->joinWith(['ingredients']);
//        $query->andWhere(['ingredient.id' => 1]);

        if (isset($params))
            foreach ($params as $ingr) {
                $query->orFilterWhere([
                    'ingredient.id' => $ingr
                ]);
            }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'photo', $this->photo]);


        return $dataProvider;
    }

    public function searchCompleteMatch($params)
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


        $query->joinWith(['ingredients']);
//        $query->andWhere(['ingredient.id' => 1]);

        if (isset($params))
            foreach ($params as $ingr) {
                // ОСНОВНОЕ МЯСО
                $query->andFilterWhere([
                    'ingredient_id1' => $ingr
                ]);
            }


        return $dataProvider;
    }


}
