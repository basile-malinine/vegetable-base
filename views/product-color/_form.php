<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\select2\Select2;
use app\models\Product\Product;
use app\models\ProductColor\ProductColor;
use app\models\Color\Color;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var ProductColor $model */
/** @var string $header */
/** @var string $company_id */

$isOldModel = isset($model->product_id) && $model->product_id
    && isset($model->color_id) && $model->color_id;
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

        <!-- Продукт -->
        <?php $product_id = $product_id ?? null; ?>
        <div class="row form-row" <?= $product_id ? 'hidden' : '' ?>>
            <div class="form-col col-3">
                <?php $model->product_id = $product_id ?: $model->product_id ?>
                <?= $form->field($model, 'product_id')->widget(Select2::class, [
                    'data' => Product::getList(),
                    'options' => [
                        'placeholder' => 'Выберите продукт',
                    ],
                ]) ?>
            </div>
        </div>

        <!-- Цвет продукта -->
        <div class="row form-last-row">
            <div class="form-col col-3">
                <?= $form->field($model, 'color_id')->widget(Select2::class, [
                    'data' => Color::getList(),
                    'value' => $isOldModel ? $model->color_id : null,
                    'options' => [
                        'placeholder' => 'Выберите цвет для продукта',
                    ],
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/product-color/index/' . $product_id ?: '', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
