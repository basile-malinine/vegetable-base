<?php

namespace app\models\InfoSource;

use yii\data\ActiveDataProvider;

class InfoSourceSearch extends InfoSource
{
    public $group = '';

    public function rules()
    {
        return [
            [['name', 'group', 'class', 'rating', 'comment'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = InfoSource::find()
        ->joinWith('info_source_group');

        $dataProvider = new ActiveDataProvider(compact('query'));

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
            'default' => SORT_DESC,
        ];
        $dataProvider->sort->attributes['group'] = [
            'asc' => ['info_source_group.name' => SORT_ASC, 'name' => SORT_ASC],
            'desc' => ['info_source_group.name' => SORT_DESC, 'name' => SORT_ASC],
            'default' => SORT_ASC,
        ];
        $dataProvider->sort->attributes['class'] = [
            'asc' => ['class' => SORT_ASC, 'name' => SORT_ASC],
            'desc' => ['class' => SORT_DESC, 'name' => SORT_ASC],
            'default' => SORT_ASC,
        ];
        $dataProvider->sort->attributes['rating'] = [
            'asc' => ['rating' => SORT_ASC, 'name' => SORT_ASC],
            'desc' => ['rating' => SORT_DESC, 'name' => SORT_ASC],
            'default' => SORT_ASC,
        ];

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'info_source_group.name', $this->group]);
        $query->andFilterWhere(['like', 'class', $this->class]);
        $query->andFilterWhere(['like', 'rating', $this->rating]);

        if (!isset($params['sort'])) {
            $query->orderBy('name ASC');
        }

        return $dataProvider;
    }
}