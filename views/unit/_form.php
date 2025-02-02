<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\Unit $model */
/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
?>

<div class="entity-list-top-panel">
    <div class="entity-list-header d-inline">
        <?= $header ?>
    </div>
</div>

<div class="entity-content">
    <div class="row entity-unit-form">
<!--        <div class="col-lg-3">-->

            <?php $form = ActiveForm::begin([
                'id' => 'entity-unit-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-5 col-form-label mr-sm-1'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control form-control-sm'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    'enableClientValidation' => false,
                ],
            ]); ?>

            <div class="entity-form-content col-2 mb-4">
                <?= $form->field($model, 'name')->textInput(
                    [
                        'maxlength' => true,
                    ]
                ) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-dark btn-sm me-2']) ?>
                <?= Html::a('Отмена', '/unit/index', ['class' => 'btn btn-light btn-outline-dark btn-sm']) ?>
            </div>

            <?php ActiveForm::end(); ?>

<!--        </div>-->
    </div>
</div>
