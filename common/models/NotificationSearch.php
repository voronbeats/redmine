<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notification;

/**
 * NotificationSearch represents the model behind the search form of `common\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'flag', 'user_id'], 'integer'],
            [['text', 'date_add'], 'safe'],
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
    public function search($params, $user_id = false)
    {
        $query = Notification::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
               ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if($user_id) {
            $query->andFilterWhere([
                'user_id' => $user_id, 
            ]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'flag' => $this->flag,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);
        $query->andFilterWhere(['like', 'date_add', $this->date_add]);

        return $dataProvider;
    }
}
