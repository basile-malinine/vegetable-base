<?php

namespace app\controllers;

use yii\web\Controller;
use yii\db\IntegrityException;
use yii\web\NotFoundHttpException;
use app\models\LegalSubject\LegalSubject;
use app\models\LegalSubject\LegalSubjectSearch;

class LegalSubjectController extends EntityController
{
    public function actionIndex(): string
    {
        $searchModel = new LegalSubjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $header = 'Юридические / физические лица';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }

    public function actionCreate()
    {
        $model = new LegalSubject();
        $header = 'Юридическое / физическое лицо (новое)';

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
        $header = 'Юридическое / физическое лицо [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = LegalSubject::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
