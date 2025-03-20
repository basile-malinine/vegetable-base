<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var Company $model */

/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\Company\Company;
use app\models\Company\CompanyAlias;
use app\models\Company\CompanyTypeClassCompany;
use app\models\LegalSubject\LegalSubject;

$this->registerCssFile('@web/css/company.css');
?>

<div class="page-top-panel">
    <div class="page-top-panel-header d-inline">
        <?= $header ?>
    </div>
</div>

<div class="page-content">
    <div class="page-content-form">

        <?php $form = ActiveForm::begin([
            'id' => 'page-content-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-form-label pt-0'],
                'inputOptions' => ['class' => 'form-control form-control-sm'],
                'errorOptions' => ['class' => 'invalid-feedback'],
                'enableClientValidation' => false,
            ],
        ]); ?>

        <div class="row <?= Yii::$app->requestedAction->id == 'create' ? 'form-last-row' : 'form-row' ?>">
            <div class="col-3">
                <!-- Название -->
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                ]) ?>
            </div>

            <!-- При создании не отображается -->
            <div class="col-4" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
                <!-- Псевдонимы -->
                <?php
                $items = CompanyAlias::getListByCompanyId($model->id);
                $values = '';
                foreach ($items as $id => $name) {
                    $values .= '<div class="set-item">' . $name . '</div>';
                }
                if (empty($values)) {
                    $values = '<div class="set-item-none">Нет</div>';
                }
                ?>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Псевдонимы</label>
                    <div class="set-container d-flex flex-row">
                        <div class="d-flex flex-row flex-wrap">
                            <?php echo $values; ?>
                        </div>
                        <a href="/company-alias/index/<?= $model->id ?>" id="aliases-edit"
                           class="btn-item-edit"><i class="fa fa-ellipsis-h"></i></a>
                    </div>
                </div>
            </div>

            <!-- При создании не отображается -->
            <div class="col-4" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
                <!-- Доверенные лица -->
                <?php
                $company_legal_subjects = $model->company_legal_subject;
                $ids = [];
                foreach ($company_legal_subjects as $idx => $company_legal_subject) {
                    $ids[] = $company_legal_subject->legal_subject_id;
                }
                $items = LegalSubject::getListByIds($ids);
                $values = '';
                foreach ($items as $id => $name) {
                    $values .= '<div class="set-item">' . $name . '</div>';
                }
                if (empty($values)) {
                    $values = '<div class="set-item-none">Нет</div>';
                }
                ?>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Доверенные лица</label>
                    <div class="set-container d-flex flex-row">
                        <div class="d-flex flex-row flex-wrap">
                            <?php echo $values; ?>
                        </div>
                        <a href="/company-legal-subject/index/<?= $model->id ?>" id="legal-subjects-edit"
                           class="btn-item-edit"><i class="fa fa-ellipsis-h"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- При создании не отображается -->
        <div class="row form-last-row" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
            <div class="col-4" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
                <!-- Типы и Классы -->
                <?php
                $company_type_classes = $model->company_type_class_company;
                $ids = [];
                foreach ($company_type_classes as $idx => $company_type_class) {
                    $ids[] = $company_type_class->id;
                }
                $items = CompanyTypeClassCompany::getListByIds($ids);
                $values = '';
                foreach ($items as $id => $name) {
                    $values .= '<div class="set-item">' . $name . '</div>';
                }
                if (empty($values)) {
                    $values = '<div class="set-item-none">Нет</div>';
                }
                $isNotActual = CompanyTypeClassCompany::notActualByCompanyId($model->id);
                $isNewRecs = CompanyTypeClassCompany::newRecByCompanyId($model->id);
                $label = 'Типы и Классы';
                $labelAdd = [];
                if ($isNotActual) {
                    array_push($labelAdd, 'есть неактуальные');
                }
                if ($isNewRecs) {
                    array_push($labelAdd, 'есть новые');
                }
                if (count($labelAdd)){
                    $label .= ' (' . implode(', ', $labelAdd) . ')';
                }
                ?>
                <div class="mb-3">
                    <label class="col-form-label pt-0"><?php echo $label; ?></label>
                    <div class="set-container d-flex flex-row">
                        <div class="d-flex flex-row flex-wrap">
                            <?php echo $values; ?>
                        </div>
                        <a href="/company-type-class-company/index/<?= $model->id ?>" id="legal-subjects-edit"
                           class="btn-item-edit"><i class="fa fa-ellipsis-h"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/company', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
