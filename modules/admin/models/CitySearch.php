<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\City;

/**
 * CitySearch represents the model behind the search form of `app\modules\admin\models\City`.
 */
class CitySearch extends City
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id', 'status', 'country_id'], 'integer'],
            [['img_url', 'name', 'name_kh', 'description', 'created_at', 'updated_at'], 'safe'],
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
        $query = City::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
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
            'status' => $this->status,
            'country_id' => $this->country_id,
        ]);

        $query->andFilterWhere(['between', 'DATE(created_at)', $this->from_date, $this->to_date])
            ->andFilterWhere(
                ['like', 'name', $this->globalSearch],
                ['like', 'name_kh', $this->globalSearch],
                ['like', 'description', $this->globalSearch]
            );


        return $dataProvider;
    }
}
