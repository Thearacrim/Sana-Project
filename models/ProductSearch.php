<?php

namespace app\models;

use app\models\Product;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form of `frontend\models\Product`.
 */
class ProductSearch extends Product
{
    public $title, $min, $max;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['status', 'price', 'image_url', 'description', 'type_item', 'title','max','min'], 'safe'],
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
        //find param in yii2
        // print_r(Yii::$app->request->get('price_range'));
        // exit;

        $query->andFilterWhere(['between', 'price', $this->min, $this->max]);
        $query->andFilterWhere(['like', 'status', $this->title])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type_item', $this->type_item]);

            $minprice = Yii::$app->request->get('minprice') ?? 5;
            $maxprice = Yii::$app->request->get('maxprice') ?? 50;
            if (!empty($minprice) && !empty($maxprice)) {
                $minprice = floatval($minprice);
                $maxprice = floatval($maxprice);
                $query->andwhere("price between CONVERT($minprice, DECIMAL) AND CONVERT($maxprice, DECIMAL)");
                // $query->andFilterWhere(['between', 'price', "CONVERT($minprice, DECIMAL)",  "CONVERT($maxprice, DECIMAL)"]);
            }
        if (!empty(Yii::$app->request->get('sort'))) {
            $sort = Yii::$app->request->get('sort');

            switch ($sort) {
                case '$featured':
                    $query->orderBy(['created_date' => SORT_DESC]);
                    break;
                case 'date_new_to_old':
                    $query->orderBy(['created_date' => SORT_DESC]);
                    break;
                case 'date_old_to_new':
                    $query->orderBy(['created_date' => SORT_ASC]);
                    break;
                case 'a_to_z':
                    $query->orderBy(['status' => SORT_ASC]);
                    break;
                case 'z_to_a':
                    $query->orderBy(['status' => SORT_DESC]);
                    break;
                case 'price_low_to_high':
                    $query->orderBy(['price' => SORT_ASC]);
                    break;
                case 'price_high_to_low':
                    $query->orderBy(['price' => SORT_DESC]);
                    break;

                default:
                    $query->orderBy(['created_date' => SORT_DESC]);
                    break;
            }
        }

        return $dataProvider;
    }
}
