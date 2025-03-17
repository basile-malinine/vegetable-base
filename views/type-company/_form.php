<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var TypeCompany $model */

/** @var string $header */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\select2\Select2;
use app\models\TypeClassCompany\TypeCompany;
use app\models\TypeClassCompany\TypeClassCompany;

$this->registerCssFile('@web/css/company.css');
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

        <div class="row <?= Yii::$app->requestedAction->id == 'create' ? 'form-last-row' : 'form-row' ?>">
            <div class="form-col col-4">
                <!-- Название -->
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                ]) ?>
            </div>
        </div>

        <!-- При создании не отображается -->
        <div class="row form-last-row" <?= Yii::$app->requestedAction->id == 'create' ? 'hidden' : '' ?>>
            <div class="col-4">
                <!-- Классы -->
                <?php
                $items = TypeClassCompany::getListByTypeCompanyId($model->id);
                $values = '';
                foreach ($items as $id => $name) {
                    $values .= '<div class="set-item">' . $name . '</div>';
                }
                if (empty($values)) {
                    $values = '<div class="set-item-none">Нет</div>';
                }
                ?>
                <div class="mb-3">
                    <label class="col-form-label pt-0">Классы</label>
                    <div class="set-container d-flex flex-row">
                        <div class="d-flex flex-row flex-wrap">
                            <?php echo $values; ?>
                        </div>
                        <a href="/type-class-company/index/<?= $model->id ?>" id="aliases-edit"
                           class="btn-item-edit"><i class="fa fa-ellipsis-h"></i></a>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/type-company', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
