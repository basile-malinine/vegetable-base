<?php

namespace app\models\LegalSubject;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class LegalSubjectSearch extends LegalSubject
{
    public function rules(): array
    {
        return [
            [['name', 'inn', 'country'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = LegalSubject::find()
        ->joinWith(['country']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['country'] = [
            'asc' => ['country.name' => SORT_ASC, 'name' => SORT_ASC],
            'desc' => ['country.name' => SORT_DESC, 'name' => SORT_ASC],
            'default' => SORT_DESC,
        ];

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'inn', $this->inn]);
        $query->andFilterWhere(['like', 'country.name', $this->country]);

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }
        return $dataProvider;
    }
}
