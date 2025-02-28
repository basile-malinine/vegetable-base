<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use app\models\Assortment\Assortment;
use app\models\Assortment\AssortmentSearch;

class AssortmentController extends EntityController
{
    public function actionIndex()
    {
        $searchModel = new AssortmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $header = 'Номенклатура';

        return $this->render('list', compact(['searchModel', 'dataProvider', 'header']));
    }


    public function actionCreate()
    {
        $model = new Assortment();
        $header = 'Номенклатура (новая позиция)';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['assortment/edit/' . $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'header'));
    }

    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        $header = 'Номенклатура [' . $model->name . ']';

        if ($this->request->isPost) {
            if ($this->postRequestAnalysis($model)) {
                $this->redirect(['index']);
            }
        }

        return $this->render('edit', compact('model', 'header'));
    }

    protected function findModel($id)
    {
        if (($model = Assortment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}