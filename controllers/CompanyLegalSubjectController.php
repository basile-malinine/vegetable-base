<?php

namespace app\controllers;

use app\models\Company\Company;
use app\models\Company\CompanyLegalSubject;
use app\models\Company\CompanyLegalSubjectSearch;
use app\models\LegalSubject\LegalSubject;
use yii\web\NotFoundHttpException;

class CompanyLegalSubjectController extends EntityController
{
    public function actionIndex($company_id = null): string
    {
        $searchModel = new CompanyLegalSubjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $header = 'Доверенные лица';
        if ($company_id) {
            $header .= ' контрагента "' . Company::findOne($company_id)->name . '"';
        } else {
            $header .= ' контрагентов';
        }

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header', 'company_id']));
    }

    public function actionCreate($company_id = null)
    {
        $model = new CompanyLegalSubject();

        $header = 'Доверенное лицо';
        if ($company_id) {
            $header .= ' контрагента "' . Company::findOne($company_id)->name . '" (новое)';
        } else {
            $header .= ' (новое)';
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

        $header = 'Доверенное лицо';
        if ($company_id) {
            $header .= ' контрагента "' . Company::findOne($company_id)->name . '" ["' . $model->name . '"]';
        } else {
            $header .= ' контрагента "' . $model->company->name
                . '" ["' . $model->legal_subject->name . '"]';
        }

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index\\' . $company_id ?: '']);
            }
        }

        return $this->render('edit', compact('model', 'header', 'company_id'));
    }

    protected function findModel($id)
    {
        if (($model = CompanyLegalSubject::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}