<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\Unit\Unit $model */

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

        <?php $form = ActiveForm::begin([
            'id' => 'entity-unit-form',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-form-label pt-0'],
                'inputOptions' => ['class' => 'form-control form-control-sm'],
                'errorOptions' => ['class' => 'invalid-feedback'],
                'enableClientValidation' => false,
            ],
        ]); ?>

        <div class="row form-last-row">
            <!-- Наименование -->
            <div class="entity-form-content col-2">
                <?= $form->field($model, 'name')->textInput(
                    [
                        'maxlength' => true,
                    ]
                ) ?>
            </div>

            <!-- Весовая -->
            <div class="entity-form-content col-1">
                <?= $form->field($model, 'is_weight')->dropDownList(
                        [0 => 'Нет', 1 => 'Да'],
                    [
                            'onchange' => '
                                if ($(this).val() == 1) {
                                    $("#unit-weight").attr("readonly", false);
                                } else {
                                    $("#unit-weight").val("");
                                    $("#unit-weight").attr("readonly", true);
                                }',
                    ]
                ) ?>
            </div>

            <!-- Вес -->
            <div class="entity-form-content col-2">
                <?= $form->field($model, 'weight')->textInput([
                        'readonly' => !(bool)$model->is_weight,
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-secondary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/unit/index', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
