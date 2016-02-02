<?php

namespace app\models\search;

use app\models\Access;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Note;

/**
 * NoteSearch represents the model behind the search form about `app\models\Note`.
 */
class NoteSearch extends Note
{
    public $access;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creator'], 'integer'],
            [['text', 'date_create', 'access'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['access']);
    }

    /**
     * @inheritdoc
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
        $query = Note::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['access']);

        $dataProvider->sort->attributes['access'] = [
            'asc' => ['evrnt_access.user_id' => SORT_ASC],
            'desc' => ['evrnt_access.user_id' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'evrnt_note.id' => $this->id,
            'evrnt_note.creator' => $this->creator,
            'evrnt_note.date_create' => $this->date_create,
            'evrnt_access.user_id' => $this->access['user_id'],
        ]);

        $query->andFilterWhere(['like', 'evrnt_note.text', $this->text]);

        return $dataProvider;
    }
}
