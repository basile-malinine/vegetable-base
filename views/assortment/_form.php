<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var Assortment $model */
/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\select2\Select2;
use app\models\Assortment\Assortment;
use app\models\Product\Product;

$actionId = Yii::$app->requestedAction->id;
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

        <div class="row <?= $actionId == 'create' ? 'form-last-row' : 'form-row' ?>">

            <div class="row">
                <!-- Базовый продукт -->
                <div class="form-col col-3">
                    <?= $form->field($model, 'product_id')->widget(Select2::class, [
                        'data' => Product::getList(),
                        'options' => [
                            'placeholder' => 'Не назначен',
                            'onchange' => '
                                $.post(
                                    "/product/get-colors", 
                                    {id: $(this).val()}, 
                                    (data) => {
                                        $("#assortment-color_id").children("option").remove();
                                        $.each(data, function(key, value) {
                                            $("#assortment-color_id").append($("<option>", value));
                                        });
                                        $("#assortment-color_id" ).prop("selectedIndex", -1);
                                        $("#assortment-color_id").prop("disabled", (data.length === 0));
                                        }
                                );
                            ',
                        ],
                    ]); ?>
                </div>

                <!-- Название -->
                <div class="form-col col-4">
                    <?= $form->field($model, 'name')->textInput([
                        'maxlength' => true,
                    ]) ?>
                </div>
            </div>

        </div>

        <!-- При создании не отображается -->
        <div class="row form-last-row" <?= $actionId == 'create' ? 'hidden' : '' ?>>
            <!-- Цвет -->
            <div class="row">
                <div class="form-col col-3">
                    <?php $data = Product::getColorListByProductId($model->product_id); ?>
                    <?= $form->field($model, 'color_id')->widget(Select2::class, [
                        'data' => $data,
                        'options' => [
                            'placeholder' => 'Не назначен',
                            'disabled' => !(bool)$data,
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]); ?>
                </div>
            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/assortment', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
