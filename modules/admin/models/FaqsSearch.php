<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Faqs;

/**
 * FaqsSearch represents the model behind the search form of `app\modules\admin\models\Faqs`.
 */
class FaqsSearch extends Faqs
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'email', 'subject', 'description', 'created_date', 'updated_date'], 'safe'],
            [['globalSearch'], 'safe']
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
        $query = Faqs::find();

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
            'status' => $this->status,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->globalSearch])
            ->andFilterWhere(['like', 'email', $this->globalSearch])
            ->andFilterWhere(['like', 'subject', $this->globalSearch])
            ->andFilterWhere(['like', 'description', $this->globalSearch]);

        return $dataProvider;
    }
}
