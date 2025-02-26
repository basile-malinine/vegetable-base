<?php

namespace app\models\ProductColor;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductColorSearch extends ProductColor
{
    public $product;
    public $color;

    public function rules(): array
    {
        return [
            [['product', 'color'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ProductColor::find()
            ->joinWith(['product', 'color']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['product'] = [
            'asc' => ['product.name' => SORT_ASC, 'color.value' => SORT_ASC],
            'desc' => ['product.name' => SORT_DESC, 'color.value' => SORT_ASC],
        ];
        $dataProvider->sort->attributes['color'] = [
            'asc' => ['color.value' => SORT_ASC, 'product.name' => SORT_ASC],
            'desc' => ['color.value' => SORT_DESC, 'product.name' => SORT_ASC],
        ];

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'product.name', $this->product]);
        $query->andFilterWhere(['like', 'color.value', $this->color]);

        // Если выводим список для конкретного Продукта
        if ($params['product_id'] ?? null) {
            $query->andFilterWhere(['product_id' => $params['product_id']]);
        }

        if (!isset($params['sort'])) {
            $query->orderBy('color.value ASC, product.name ASC');
        }
        return $dataProvider;
    }
}