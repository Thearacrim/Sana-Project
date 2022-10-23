<?php

namespace app\modules\Admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\Admin\models\Coupon;

/**
 * CouponSearch represents the model behind the search form of `app\modules\Admin\models\Coupon`.
 */
class CouponSearch extends Coupon
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['coupon_title', 'discount_on', 'from_date', 'to_date', 'coupon_type', 'coupon_type', 'created_date', 'expire_date', 'status'], 'safe'],
            [['coupon_code', 'discount'], 'number'],
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
        $query = Coupon::find();

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
            'between', 'DATE(created_date)', $this->from_date, $this->to_date
        ])
            ->andFilterWhere([
                'OR',
                [
                    'like', 'status', $this->globalSearch
                ],
                ['like', 'price', $this->globalSearch],
                ['like', 'created_date', $this->globalSearch],

            ]);

        return $dataProvider;
    }
}
