<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Unit\Unit;
use app\models\Unit\UnitSearch;

class UnitController extends Controller
{
    public function actionIndex(): string
    {
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Единицы измерения';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new Unit();
        $header = 'Единица измерения (новая)';

        if ($this->request->isPost) {
            $this->postRequestAnalysis($model);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header'));
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        $header = 'Единица измерения [' . $model->name . ']';

        if ($this->request->isPost) {
            $this->postRequestAnalysis($model);
        }

        return $this->render('edit', compact('model', 'header'));
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Unit::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // Обработка POST-запроса
    private function postRequestAnalysis($model): void
    {
        if ($model->load($this->request->post())) {
            if ($model->validate()) {
                $model->save();
                $this->redirect(['/unit/index']);
            }
        }
    }
}
