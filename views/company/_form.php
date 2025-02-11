<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\Company\Company;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var Company $model */
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
            <!-- Продавец -->
            <div class="form-col col-2">
                <?= $form->field($model, 'is_seller')->checkbox(
                    [
                        'onchange' => '',
                    ]
                ) ?>
            </div>

            <!-- Покупатель -->
            <div class="form-col col-2">
                <?= $form->field($model, 'is_buyer')->checkbox(
                    [
                        'onchange' => '',
                    ]
                ) ?>
            </div>
        </div>

        <div class="row form-last-row">
            <!-- Название -->
            <div class="form-col col-4">
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                ]) ?>
            </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-secondary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/company', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
