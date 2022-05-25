<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Invoices;

/**
 * SearchInvoices represents the model behind the search form of `backend\models\Invoices`.
 */
class SearchInvoices extends Invoices
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['Customer', 'Issue_date', 'Due_date', 'globalSearch', 'from_date', 'to_date', 'Type', 'status'], 'safe'],
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
        $query = Invoices::find();

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
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'Issue_date' => $this->Issue_date,
        //     'Due_date' => $this->Due_date,
        // ]);

        $query->andFilterWhere(['between', 'DATE(Issue_date)', $this->from_date, $this->to_date])
            ->andFilterWhere([
                'OR',
                ['like', 'customer', $this->globalSearch],
                ['like', 'status', $this->globalSearch],
                // ['like', 'created_date', $this->globalSearch],

            ]);

        return $dataProvider;
    }
}
