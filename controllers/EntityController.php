<?php

namespace app\controllers;

use yii\web\Controller;
use yii\db\IntegrityException;
use yii\web\NotFoundHttpException;
use app\models\Company\Company;
use app\models\Company\CompanySearch;

class EntityController extends Controller
{
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

    // Обработка POST-запроса
    protected function postRequestAnalysis($model): bool
    {
        if ($model->load($this->request->post())) {
            if ($model->validate() && $model->save()) {
                return true;
            }
        }
        return false;
    }
}
