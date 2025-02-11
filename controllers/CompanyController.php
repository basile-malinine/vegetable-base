<?php

namespace app\controllers;

use yii\web\Controller;
use yii\db\IntegrityException;
use yii\web\NotFoundHttpException;
use app\models\Company\Company;
use app\models\Company\CompanySearch;

class CompanyController extends Controller
{
    public function actionIndex(): string
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Контрагенты';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new Company();
        $header = 'Контрагент (новый)';

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
        $header = 'Контрагент [' . $model->name . ']';

        if ($this->request->isPost) {
            $this->postRequestAnalysis($model);
        }

        return $this->render('edit', compact('model', 'header'));
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $dbMessages = \Yii::$app->params['messages']['db'];
        try {
            $model->delete();
            \Yii::$app->session->setFlash('success', $dbMessages['delSuccess']);
        } catch (IntegrityException $e) {
            \Yii::$app->session->setFlash('error', $dbMessages['delIntegrityError']);
        } catch (\Exception $e) {
            \Yii::$app->session->setFlash('error', $dbMessages['delError']);
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Company::findOne(['id' => $id])) !== null) {
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
                $this->redirect(['/company/index']);
            }
        }
    }
}
