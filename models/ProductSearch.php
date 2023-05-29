<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
  /**
   * {@inheritdoc}
   */
  public $selectedCity, $selectedDate, $totalGuest;
  public function rules()
  {
    return [
      [['id', 'tourday', 'tournight', 'tourhour', 'tourmin', 'status', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
      [['name', 'namekh', 'overview', 'overviewkh', 'highlight', 'highlight_kh', 'pick_up', 'pick_up_kh', 'drop_off', 'drop_off_kh', 'price_include_kh', 'price_exclude_kh', 'price_include', 'price_exclude', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
      [['rating'], 'number'],
      [['selectedCity', 'selectedDate', 'totalGuest'], 'safe']
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
    $query->joinWith(['cities']);

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


    $query->andFilterWhere(['IN', 'product_city.city_id', $this->selectedCity]);
    //   ->andFilterWhere(['like', 'name', $this->globalSearch], ['like', 'namekh', $this->globalSearch]);

    $query->groupBy(['product.id']);

    // print_r($query->createCommand()->getRawSql());
    // exit;

    return $dataProvider;
  }
}
