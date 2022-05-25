<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `frontend\models\Product`.
 */
class ProductSearch extends Product
{
    public $title;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['status', 'price', 'image_url', 'description', 'type_item', 'title'], 'safe'],
            [['rate'], 'number'],
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
        $query = Product::find();

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
            'category_id' => $this->category_id,
            'rate' => $this->rate,
        ]);

        $query->andFilterWhere(['like', 'status', $this->title])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type_item', $this->type_item]);

        return $dataProvider;
    }
}
