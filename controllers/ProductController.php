<?php

namespace app\controllers;

use yii\web\Controller;
use yii\db\IntegrityException;
use yii\web\NotFoundHttpException;
use app\models\Product\Product;
use app\models\Product\ProductSearch;

class ProductController extends EntityController
{
    public function actionIndex(): string
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Продукты';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new Product();
        $header = 'Продукт (новый)';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['product/edit/' . $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header'));
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        $header = 'Продукт [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}