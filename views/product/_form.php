<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\Product\Product $model */

/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\Unit\Unit;

// 'create' или 'edit'
$action = Yii::$app->controller->action->id;
// Список Ед. изм. для формы
$unitList = Unit::getList();
// Вычисляем значение по умолчанию в списке
$unitDefault = array_keys($unitList)[0];
// Вес у Ед. изм. по умолчанию (если весовая, должен быть вес)
$weightDefault = Unit::findOne($unitDefault)->weight;
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
                'labelOptions' => ['class' => 'col-form-label pt-0'],
                'inputOptions' => ['class' => 'form-control form-control-sm m-0'],
                'errorOptions' => ['class' => 'invalid-feedback'],
                'enableClientValidation' => false,
            ],
        ]); ?>

        <div class="row form-content-row">
            <!-- Наименование -->
            <div class="entity-form-content col-5">
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                ]) ?>
            </div>
        </div>

        <div class="row form-last-row">
            <!-- Ед. изм. -->
            <div class="entity-form-content col-2">
                <?= $form->field($model, 'unit_id')->dropDownList(Unit::getList(), [
                    'onchange' => '
                        let weights = ' . json_encode(
                            Unit::find()
                                ->select(['weight'])
                                ->where('is_weight')
                                ->indexBy('id')
                                ->column()
                        ) . ';
                        let weight = weights[this.value];
                        let isWeight = Boolean(weights[this.value]);
                        $("#product-weight").val(weight);
                        $("#product-weight").attr("readonly", isWeight);
                    ',
                ]) ?>
            </div>

            <!-- Вес -->
            <div class="entity-form-content col-2">
                <?= $form->field($model, 'weight')->textInput([
                    'readonly' => $action === 'create'
                        ? (bool)$weightDefault
                        : (bool)$model->unit->is_weight,
                    'value' => $action === 'create'
                        ? $weightDefault
                        : $model->unit->weight,
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-secondary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/product/index', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
