<?php

namespace app\models\LegalSubject;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class LegalSubjectSearch extends LegalSubject
{
    public function rules(): array
    {
        return [
//            [['id'], 'integer'],
            [['name', 'inn'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = LegalSubject::find();
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
//        $query->andFilterWhere([
//            'id' => $this->id,
//        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'inn', $this->inn]);

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }
        return $dataProvider;
    }
}
