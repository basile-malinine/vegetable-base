<?php

namespace app\models\Assortment;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class AssortmentSearch extends Assortment
{
    public $product;
    public $color;

    public function rules()
    {
        return [
            [['name', 'product', 'color'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Assortment::find()
            ->distinct()
            ->joinWith(['product', 'color']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'product.name', $this->product]);
        $query->andFilterWhere(['like', 'color.name', $this->color]);

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }

        return $dataProvider;
    }
}