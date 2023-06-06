<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Booking;

/**
 * BookingSearch represents the model behind the search form of `app\modules\admin\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['total_amount', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
            [['paid'], 'number'],
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
        $query = Booking::find();
        $query->joinWith('customer');

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

        $query->andFilterWhere(['between', 'DATE(booking.created_at)', $this->from_date, $this->to_date])
            ->andFilterWhere([
                'OR',
                ['like', 'booking.code', $this->globalSearch],
                ['like', 'customer.first_name', $this->globalSearch],
                ['like', 'customer.last_name', $this->globalSearch]
            ]);

        return $dataProvider;
    }
}
