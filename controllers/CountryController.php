<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\Country\Country;
use app\models\Country\CountrySearch;

class CountryController extends EntityController
{
    public function actionIndex(): string
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Страны';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new Country();
        $header = 'Страна (новая)';

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
        $header = 'Страна [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = Country::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetInnName()
    {
        $id = \Yii::$app->request->post('id');
        $isLegal = \Yii::$app->request->post('isLegal');
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        return $isLegal ? $model->inn_legal_name : $model->inn_name;
    }
}