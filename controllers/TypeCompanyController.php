<?php

namespace app\controllers;

use app\models\TypeClassCompany\TypeClassCompany;
use yii\web\NotFoundHttpException;
use app\models\TypeClassCompany\TypeCompany;
use app\models\TypeClassCompany\TypeCompanySearch;

class TypeCompanyController extends EntityController
{
    public function actionIndex()
    {
        $searchModel = new TypeCompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Типы и Классы контрагентов';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new TypeCompany();
        $header = 'Тип (новый)';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $modelTypeClass = new TypeClassCompany();
                $modelTypeClass->type_company_id = $model->id;
                $modelTypeClass->name = $model->name . ' (auto)';
                $modelTypeClass->save();
                $this->redirect(['type-company/edit/' . $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header'));
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        $header = 'Тип [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = TypeCompany::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}