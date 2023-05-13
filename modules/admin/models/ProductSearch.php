<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\modules\admin\models\Product`.
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
            [['id', 'tourday', 'tournight', 'tourhour', 'tourmin', 'status', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'namekh', 'overview', 'overviewkh', 'highlight', 'highlight_kh', 'pick_up', 'pick_up_kh', 'drop_off', 'drop_off_kh', 'price_include_kh', 'price_exclude_kh', 'price_include', 'price_exclude', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['rate'], 'number'],
            [['globalSearch', 'from_date', 'to_date'], 'safe']
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
            'tourday' => $this->tourday,
            'tournight' => $this->tournight,
            'tourhour' => $this->tourhour,
            'tourmin' => $this->tourmin,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'rate' => $this->rate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'namekh', $this->namekh])
            ->andFilterWhere(['like', 'overview', $this->overview])
            ->andFilterWhere(['like', 'overviewkh', $this->overviewkh])
            ->andFilterWhere(['like', 'highlight', $this->highlight])
            ->andFilterWhere(['like', 'highlight_kh', $this->highlight_kh])
            ->andFilterWhere(['like', 'pick_up', $this->pick_up])
            ->andFilterWhere(['like', 'pick_up_kh', $this->pick_up_kh])
            ->andFilterWhere(['like', 'drop_off', $this->drop_off])
            ->andFilterWhere(['like', 'drop_off_kh', $this->drop_off_kh])
            ->andFilterWhere(['like', 'price_include_kh', $this->price_include_kh])
            ->andFilterWhere(['like', 'price_exclude_kh', $this->price_exclude_kh]);

        return $dataProvider;
    }
}
