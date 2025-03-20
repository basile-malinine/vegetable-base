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
        $this->deleteById($id);

        return $this->redirect(['index']);
    }

    protected function deleteById($id)
    {
        $model = $this->findModel($id);

        $dbMessages = \Yii::$app->params['messages']['db'];
        try {
            $model->delete();
        } catch (IntegrityException $e) {
            \Yii::$app->session->setFlash('error', $dbMessages['delIntegrityError']);
        } catch (\Exception $e) {
            \Yii::$app->session->setFlash('error', $dbMessages['delError']);
        }
    }

    // Обработка POST-запроса
    protected function postRequestAnalysis($model): bool
    {
        if ($model->load($this->request->post())) {
            if ($model->validate()) {
                if ($model->save()) {
                    return true;
                }
            }
        }
        return false;
    }
}
