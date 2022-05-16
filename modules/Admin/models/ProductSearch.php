<?php

namespace app\modules\Admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\Admin\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_by', 'created_date', 'updated_date'], 'integer'],
            [['status', 'price', 'image_url', 'description', 'created_date', 'updated_date'], 'safe'],
            [['globalSearch', 'from_date', 'to_date'], 'safe'],
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
            'sort' => ['defaultOrder' => ['created_date' => SORT_DESC]]

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
        $query->andFilterWhere(['between', 'DATE(created_date)', $this->from_date, $this->to_date])
            ->andFilterWhere([
                'OR',
                ['like', 'status', $this->globalSearch],
                ['like', 'price', $this->globalSearch],
                ['like', 'created_date', $this->globalSearch],

            ]);
        // $query->orFilterWhere(['like', 'status', $this->globalSearch])
        //     ->orFilterWhere(['like', 'price', $this->globalSearch])
        //     ->orFilterWhere(['like', '', $this->globalSearch])
        //     ->orFilterWhere(['like', 'description', $this->globalSearch]);

        return $dataProvider;
    }
}
