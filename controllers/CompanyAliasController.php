<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\models\Company\Company;
use app\models\Company\CompanyAlias;
use app\models\Company\CompanyAliasSearch;

class CompanyAliasController extends EntityController
{
    public function actionIndex($company_id = null): string
    {
        $searchModel = new CompanyAliasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $header = 'Псевдонимы';
        if ($company_id) {
            $header .= ' для контрагента "' . Company::findOne($company_id)->name . '"';
        } else {
            $header .= ' контрагентов';
        }

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header', 'company_id']));
    }

    public function actionCreate($company_id = null)
    {
        $model = new CompanyAlias();

        $header = 'Псевдоним';
        if ($company_id) {
            $header .= ' для контрагента "' . Company::findOne($company_id)->name . '" (новый)';
        } else {
            $header .= ' (новый)';
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

        $header = 'Псевдоним';
        if ($company_id) {
            $header .= ' для контрагента "' . Company::findOne($company_id)->name . '" [' . $model->name . ']';
        } else {
            $header .= ' (новый)';
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
        if (($model = CompanyAlias::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}