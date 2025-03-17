<?php

namespace app\models\InfoSourceGroup;

use app\models\InfoSourceGroup\InfoSourceGroup;
use yii\data\ActiveDataProvider;

class InfoSourceGroupSearch extends InfoSourceGroup
{
    public function rules()
    {
        return [
            [['name', 'comment'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = InfoSourceGroup::find();
        $dataProvider = new ActiveDataProvider(compact('query'));

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
            'default' => SORT_DESC,
        ];

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'comment', $this->comment]);

        if (!isset($params['sort'])) {
            $query->orderBy('name ASC');
        }

        return $dataProvider;
    }
}