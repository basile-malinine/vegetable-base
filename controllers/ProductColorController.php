<?php

namespace app\controllers;

use app\models\Product\Product;
use app\models\ProductColor\ProductColor;
use app\models\ProductColor\ProductColorSearch;
use yii\web\NotFoundHttpException;

class ProductColorController extends EntityController
{
    public function actionIndex($product_id = null): string
    {
        $searchModel = new ProductColorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $header = 'Цвета';
        if ($product_id) {
            $header .= ' продукта "' . Product::findOne($product_id)->name . '"';
        } else {
            $header .= ' продуктов';
        }

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header', 'product_id']));
    }

    public function actionCreate($product_id = null)
    {
        $model = new ProductColor();

        $header = 'Цвет';
        if ($product_id) {
            $header .= ' продукта "' . Product::findOne($product_id)->name . '" (новый)';
        } else {
            $header .= ' (новый)';
        }

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index\\' . $product_id ?: '']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header', 'product_id'));
    }

    public function actionEdit($id, $product_id = null)
    {
        $model = $this->findModel($id);

        $header = 'Цвет';
        if ($product_id) {
            $header .= ' продукта "' . Product::findOne($product_id)->name . '" ["' . $model->color->value . '"]';
        } else {
            $header .= ' продукта "' . $model->product->name
                . '" ["' . $model->color->value . '"]';
        }

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index\\' . $product_id ?: '']);
            }
        }

        return $this->render('edit', compact('model', 'header', 'product_id'));
    }

    public function actionDelete($id, $product_id = null)
    {
        $this->deleteById($id);

        return $this->redirect(['index\\' . $product_id ?: '']);
    }

    protected function findModel($id)
    {
        if (($model = ProductColor::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
