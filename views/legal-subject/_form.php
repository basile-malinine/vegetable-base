<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\LegalSubject\LegalSubject;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var LegalSubject $model */
/** @var string $header */

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

        <div class="row form-row">
            <!-- Юридическое лицо -->
            <div class="form-col col-3">
                <?= $form->field($model, 'is_legal')->checkbox(
                    [
                        'onchange' => '
                            let labelName = $(".field-legalsubject-name > .col-form-label")[0];
                            let labelFullName = $(".field-legalsubject-full_name > .col-form-label")[0];
                            console.log($(this).val());
                            if ($(this).prop("checked")) {
                                labelName.innerText = "Название организации";
                                labelFullName.innerText = "Полное название организации";
                            } else {
                                labelName.innerText = "ФИО";
                                labelFullName.innerText = "ФИО (полностью)";
                            }',
                    ]
                ) ?>
            </div>
        </div>

        <div class="row form-row">
            <!-- Название или ФИО -->
            <div class="form-col col-2">
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                ])->label($model->is_legal ? 'Название организации' : 'ФИО') ?>
            </div>

            <!-- Полное название или ФИО -->
            <div class="form-col col-6">
                <?= $form->field($model, 'full_name')->textInput([
                    'maxlength' => true,
                ])->label($model->is_legal ? 'Полное название организации' : 'ФИО (полностью)') ?>
            </div>
        </div>

        <div class="row form-last-row">
            <!-- ИНН -->
            <div class="form-col col-2">
                <?= $form->field($model, 'inn')->textInput([
                    'maxlength' => true,
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/legal-subject/index', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
