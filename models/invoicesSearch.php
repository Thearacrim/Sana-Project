<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\invoices;

/**
 * invoicesSearch represents the model behind the search form of `backend\models\invoices`.
 */
class invoicesSearch extends invoices
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id', 'Customer'], 'integer'],
            [['Issue_date', 'Customer', 'globalSearch', 'Due_date', 'from_date', 'to_date', 'Type', 'status'], 'safe'],
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
        $query = invoices::find();

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
        $query->andFilterWhere(['between', 'DATE(Issue_date)', $this->from_date, $this->to_date])
            ->andFilterWhere([
                'OR',
                ['like', 'Customer', $this->globalSearch],

            ]);
        return $dataProvider;
    }
}
