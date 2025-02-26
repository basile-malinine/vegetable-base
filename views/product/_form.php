<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\Product\Product $model */

/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\Color\Color;
use app\models\Unit\Unit;

$this->registerCssFile('@web/css/company.css');

// 'create' или 'edit'
$action = Yii::$app->controller->action->id;
// Список Ед. изм. для формы
$unitList = Unit::getList();
// Вычисляем значение по умолчанию в списке
$unitDefault = array_keys($unitList)[0];
// Вес у Ед. изм. по умолчанию (если весовая, должен быть вес)
$weightDefault = Unit::findOne($unitDefault)->weight;
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
                'inputOptions' => ['class' => 'form-control form-control-sm m-0'],
                'errorOptions' => ['class' => 'invalid-feedback'],
                'enableClientValidation' => false,
            ],
        ]); ?>

        <div class="row <?= Yii::$app->requestedAction->id == 'create' ? 'form-last-row' : 'form-row' ?>">
            <!-- Наименование -->
            <div class="form-col col-4">
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                ]) ?>
            </div>

            <!-- Ед. изм. -->
            <div class="form-col col-2">
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
            <div class="form-col col-2">
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

        <!-- При создании не отображается -->
        <div class="row form-last-row" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
            <div class="col-4">
                <!-- Цвета продукта -->
                <div class="row">
                    <div class="form-col col-12">
                        <?php
                        $product_colors = $model->product_color;
                        $ids = [];
                        foreach ($product_colors as $idx => $product_color) {
                            $ids[] = $product_color->color_id;
                        }
                        $items = Color::getListByIds($ids);
                        $values = '';
                        foreach ($items as $id => $value) {
                            $values .= '<div class="set-item">' . $value . '</div>';
                        }
                        if (empty($values)) {
                            $values = '<div class="set-item-none">Нет</div>';
                        }
                        ?>
                        <div class="mb-3">
                            <label class="col-form-label pt-0">Цвета</label>
                            <div class="set-container d-flex flex-row">
                                <div class="d-flex flex-row flex-wrap">
                                    <?php echo $values; ?>
                                </div>
                                <a href="/product-color/index/<?= $model->id ?>" id="legal-subjects-edit" class="btn-item-edit"><i class="fa fa-ellipsis-h"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/product/index', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
