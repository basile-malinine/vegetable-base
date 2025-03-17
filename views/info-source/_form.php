<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;
use kartik\select2\Select2;
use app\models\InfoSourceGroup\InfoSourceGroup;
use app\models\InfoSource\InfoSource;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var InfoSource $model */
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
            <!-- Название -->
            <div class="form-col col-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row form-row">
            <!-- Класс -->
            <div class="form-col col-1">
                <?= $form->field($model, 'class')->widget(Select2::class, [
                    'data' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'],
                    'hideSearch' => true,
                ]); ?>
            </div>

            <!-- Рейтинг -->
            <div class="form-col col-1">
                <?= $form->field($model, 'rating')->widget(Select2::class, [
                    'data' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'],
                    'hideSearch' => true,
                ]); ?>
            </div>

            <!-- Группа -->
            <div class="form-col col-4">
                <?= $form->field($model, 'info_source_group_id')->widget(Select2::class, [
                    'data' => InfoSourceGroup::getList(),
                    'options' => [
                        'placeholder' => 'Группа не выбрана',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]); ?>
            </div>
        </div>

        <div class="row form-last-row">
            <!-- Комментарий -->
            <div class="form-col col-12">
                <?= $form->field($model, 'comment')->textarea() ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/info-source/index', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
