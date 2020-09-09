<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Performance;

/**
 * PerformanceSearch represents the model behind the search form of `app\models\Performance`.
 */
class PerformanceSearch extends Performance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_new', 'age_restriction', 'performance_length', 'hall'], 'integer'],
            [['title', 'img_path', 'show_date', 'trailer', 'banner', 'author', 'short_desc', 'desc'], 'safe'],
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
        $query = Performance::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'show_date' => $this->show_date,
            'age_restriction' => $this->age_restriction,
            'performance_length' => $this->performance_length,
            'hall' => $this->hall,
            'is_new' => $this->is_new,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'img_path', $this->img_path])
            ->andFilterWhere(['like', 'trailer', $this->trailer])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'short_desc', $this->short_desc])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
