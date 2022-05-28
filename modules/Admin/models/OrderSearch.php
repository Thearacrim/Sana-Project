<?php

namespace app\modules\Admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\Admin\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\modules\admin\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id', 'customer_id', 'status', 'created_by'], 'integer'],
            [['code', 'note', 'created_date', 'globalSearch', 'from_date', 'to_date'], 'safe'],
            [['sub_total', 'discount', 'grand_total'], 'number'],
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
        $query = Order::find()->joinwith('order');

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
        $query->andFilterWhere(['between', 'DATE(created_date)', $this->from_date, $this->to_date]);

        $query->FilterWhere(['like', 'code', $this->globalSearch])
            ->orFilterWhere(['like', 'customer.name', $this->globalSearch]);

        return $dataProvider;
    }
}
