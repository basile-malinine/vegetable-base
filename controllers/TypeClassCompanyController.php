<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\models\TypeClassCompany\TypeCompany;
use app\models\TypeClassCompany\TypeClassCompany;
use app\models\TypeClassCompany\TypeClassCompanySearch;

class TypeClassCompanyController extends EntityController
{
    public function actionIndex($type_company_id = null): string
    {
        $searchModel = new TypeClassCompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $header = 'Классы';
        if ($type_company_id) {
            $header .= ' для Типа контрагентов "' . TypeCompany::findOne($type_company_id)->name . '"';
        } else {
            $header .= ' Типов контрагентов';
        }

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header', 'type_company_id']));
    }

    public function actionCreate($type_company_id = null)
    {
        $model = new TypeClassCompany();

        $header = 'Класс';
        if ($type_company_id) {
            $header .= ' для Типа контрагента "' . TypeCompany::findOne($type_company_id)->name . '" (новый)';
        } else {
            $header .= ' контрагента (новый)';
        }

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index\\' . $type_company_id ?: '']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header', 'type_company_id'));
    }

    public function actionEdit($id, $type_company_id = null)
    {
        $model = $this->findModel($id);

        $header = 'Класс';
        if ($type_company_id) {
            $header .= ' для Типа контрагента "' . TypeCompany::findOne($type_company_id)->name . '" ["' . $model->name . '"  ]';
        } else {
            $header .= ' Типа контрагента "' . TypeCompany::findOne($model->type_company_id)->name . '" ["' . $model->name . '"]';
        }

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index\\' . $type_company_id ?: '']);
            }
        }

        return $this->render('edit', compact('model', 'header', 'type_company_id'));
    }

    public function actionDelete($id, $type_company_id = null)
    {
        $this->deleteById($id);

        return $this->redirect(['index\\' . $type_company_id ?: '']);
    }

    protected function findModel($id)
    {
        if (($model = TypeClassCompany::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}