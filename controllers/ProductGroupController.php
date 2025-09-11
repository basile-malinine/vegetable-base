<?php

namespace app\controllers;

use app\models\Product\ProductGroup;
use yii\db\IntegrityException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Product\ProductGroupSearch;

class ProductGroupController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductGroupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $header = 'Классификатор продуктов';

        return $this->render('list', compact('dataProvider', 'header'));
    }

    public function actionCreate()
    {
        $model = new ProductGroup();

        $header = 'Группа классификатора продуктов (новая)';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact(['model', 'header']));
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        $header = 'Группа классификатора продуктов [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $dbMessages = \Yii::$app->params['messages']['db'];
        try {
            $model->delete();
        } catch (IntegrityException $e) {
            \Yii::$app->session->setFlash('error', $dbMessages['delIntegrityError']);
        } catch (\Exception $e) {
            \Yii::$app->session->setFlash('error', $dbMessages['delError']);
        }

        return $this->redirect(['index']);
    }

    private function findModel($id)
    {
        if (($model = ProductGroup::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function postRequestAnalysis($model): bool
    {
        if ($model->load($this->request->post())) {
            if ($model->validate() && $model->save()) {
                return true;
            }
        }
        return false;
    }
}