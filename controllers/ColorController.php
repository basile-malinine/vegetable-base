<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\models\Color\Color;
use app\models\Color\ColorSearch;

class ColorController extends EntityController
{
    public function actionIndex(): string
    {
        $searchModel = new ColorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Цвет';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new Color();
        $header = 'Цвет (новая)';

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
        $header = 'Цвет [' . $model->value . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = Color::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}