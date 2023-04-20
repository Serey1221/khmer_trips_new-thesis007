<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `app\modules\admin\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;
    public function rules()
    {
        return [
            [['id', 'category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['img_url', 'slug', 'title', 'short_description', 'description', 'created_date', 'updated_date'], 'safe'],
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
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_date' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['between', 'DATE(created_date)', $this->from_date, $this->to_date])
            ->andFilterWhere([
                'OR',
                ['like', 'title', $this->globalSearch],
                ['like', 'slug', $this->globalSearch],
                ['like', 'name', $this->globalSearch],
            ]);

        return $dataProvider;
    }
}
