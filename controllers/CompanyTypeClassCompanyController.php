<?php

namespace app\controllers;

use app\models\Company\CompanyTypeClassCompany;
use yii\web\NotFoundHttpException;
use app\models\Company\Company;
use app\models\Company\CompanyTypeClassCompanySearch;

class CompanyTypeClassCompanyController extends EntityController
{
    public function actionIndex($company_id = null): string
    {
        $searchModel = new CompanyTypeClassCompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $header = 'Типы и Классы';
        if ($company_id) {
            $header .= ' для контрагента "' . Company::findOne($company_id)->name . '"';
        } else {
            $header .= ' контрагентов';
        }

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header', 'company_id']));
    }

    public function actionCreate($company_id = null)
    {
        $model = new CompanyTypeClassCompany();

        $header = 'Свойство Тип и Класс';
        if ($company_id) {
            $header .= ' для контрагента "' . Company::findOne($company_id)->name . '" (новое)';
        } else {
            $header .= ' контрагента (новое)';
        }

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index\\' . $company_id ?: '']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header', 'company_id'));
    }

    public function actionEdit($id, $company_id = null)
    {
        $model = $this->findModel($id);

        $header = 'Свойство Тип и Класс';
        if ($company_id) {
            $header .= ' для контрагента "' . Company::findOne($company_id)->name
                . '" [' . $model->type_company->name . '::'  . $model->type_class_company->name . ']';
        } else {
            $header .= ' контрагента "' . Company::findOne($model->company_id)->name
                . '" [' . $model->type_company->name . '::'  . $model->type_class_company->name . ']';
        }

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index\\' . $company_id ?: '']);
            }
        }

        return $this->render('edit', compact('model', 'header', 'company_id'));
    }

    public function actionDelete($id, $company_id = null)
    {
        $this->deleteById($id);

        return $this->redirect(['index\\' . $company_id ?: '']);
    }

    protected function findModel($id)
    {
        if (($model = CompanyTypeClassCompany::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}