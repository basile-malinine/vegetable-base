<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var Company $model */

/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\select2\Select2;
use app\models\Company\Company;
use app\models\Company\CompanyAlias;
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

            <div class="col-4">
                <div class="row">
                    <!-- Продавец -->
                    <div class="form-col col-3">
                        <?= $form->field($model, 'is_seller')->widget(Select2::class, [
                            'data' => [0 => 'Нет', 1 => 'Да'],
                            'hideSearch' => true,
                        ]); ?>
                    </div>

                    <!-- Покупатель -->
                    <div class="form-col col-3">
                        <?= $form->field($model, 'is_buyer')->widget(Select2::class, [
                            'data' => [0 => 'Нет', 1 => 'Да'],
                            'hideSearch' => true,
                        ]); ?>
                    </div>

                    <!-- Название -->
                    <div class="form-col col-6">
                        <?= $form->field($model, 'name')->textInput([
                            'maxlength' => true,
                        ]) ?>
                    </div>
                </div>
            </div>

        </div>

        <!-- При создании не отображается -->
        <div class="row form-row" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
            <div class="col-4">
                <!-- Псевдонимы -->
                <div class="row">
                    <div class="form-col col-12">
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
                                <a href="/company-alias/index/<?= $model->id ?>" id="aliases-edit" class="btn-item-edit"><i class="fa fa-ellipsis-h"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- При создании не отображается -->
        <div class="row form-last-row" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
            <div class="col-4">
                <!-- Доверенные лица -->
                <div class="row">
                    <div class="form-col col-12">
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
                                <a href="/company-legal-subject/index/<?= $model->id ?>" id="legal-subjects-edit" class="btn-item-edit"><i class="fa fa-ellipsis-h"></i></a>
                            </div>
                        </div>
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
