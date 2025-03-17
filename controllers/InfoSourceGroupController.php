<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\models\InfoSourceGroup\InfoSourceGroup;
use app\models\InfoSourceGroup\InfoSourceGroupSearch;

class InfoSourceGroupController extends EntityController
{
    public function actionIndex(): string
    {
        $searchModel = new InfoSourceGroupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Группы источников информации';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new InfoSourceGroup();
        $header = 'Группа источника информации (новая)';

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
        $header = 'Группа источника информации [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = InfoSourceGroup::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}