<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\select2\Select2;
use app\models\Company\Company;
use app\models\Company\CompanyAlias;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var CompanyAlias $model */
/** @var string $header */
/** @var string $company_id */

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

        <?php $company_id = $company_id ?? null; ?>
        <div class="row form-row" <?= $company_id ? 'hidden' : '' ?>>
            <!-- Контрагент -->
            <div class="form-col col-3">
                <?php $model->company_id = $company_id ?: $model->company_id ?>
                <?= $form->field($model, 'company_id')->widget(Select2::class, [
                    'data' => Company::getList(),
                ]) ?>
            </div>
        </div>

        <div class="row form-last-row">
            <!-- Псевдоним -->
            <div class="form-col col-3">
                <?= $form->field($model, 'name')->textInput(
                    [
                        'maxlength' => true,
                    ]
                ) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/company-alias/index/' . $company_id ?: '', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
