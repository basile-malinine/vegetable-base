<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Product\Product;
use app\models\Product\ProductSearch;

class ProductController extends Controller
{
    /*    public function behaviors()
        {
        }
    */
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
            $this->postRequestAnalysis($model, $header);
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
            $this->postRequestAnalysis($model, $header);
        } else {

            return $this->render('edit', compact('model', 'header'));
        }

        return $this->render('edit',
            compact('model', 'header')
        );
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // Обработка POST-запроса
    private function postRequestAnalysis($model, $header)
    {
        if ($model->load($this->request->post())) {
            if ($model->validate()) {
                $model->save();
                $this->redirect(['/product/index']);
            } else {
                return $this->render('create', compact('model', 'header'));
            }
        }
    }
}