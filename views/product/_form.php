<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\Product\Product $model */

/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\Unit\Unit;

?>

<div class="entity-list-top-panel">
    <div class="entity-list-header d-inline">
        <?= $header ?>
    </div>
</div>

<div class="entity-content">
    <div class="entity-unit-form">

        <?php $form = ActiveForm::begin([
            'id' => 'entity-unit-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-form-label p-0'],
                'inputOptions' => ['class' => 'form-control form-control-sm m-0'],
                'errorOptions' => ['class' => 'invalid-feedback'],
                'enableClientValidation' => false,
            ],
        ]); ?>

        <div class="row">
            <!-- Наименование -->
            <div class="entity-form-content col-5">
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                ]) ?>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Ед. изм. -->
            <div class="entity-form-content col-1">
                <?= $form->field($model, 'unit_id')->dropDownList(Unit::getList()) ?>
            </div>

            <!-- Вес -->
            <div class="entity-form-content col-2">
                <?= $form->field($model, 'weight')->textInput([
                        'readonly' => 'true',
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-dark btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/product/index', ['class' => 'btn btn-light btn-outline-dark btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
