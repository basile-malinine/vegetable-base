<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\models\InfoSource\InfoSource;
use app\models\InfoSource\InfoSourceSearch;

class InfoSourceController extends EntityController
{
    public function actionIndex(): string
    {
        $searchModel = new InfoSourceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Источники информации';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new InfoSource();
        $header = 'Источник информации (новый)';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header'));
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        $header = 'Источник информации [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = InfoSource::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}