<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Company\Company;
use app\models\Company\CompanyTypeClassCompany;
use app\models\InfoSource\InfoSource;
use app\models\TypeClassCompany\TypeCompany;
use app\models\TypeClassCompany\TypeClassCompany;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var CompanyTypeClassCompany $model */
/** @var string $header */
/** @var string $company_id */

$isOldModel = isset($model->company_id) && $model->company_id
    && isset($model->type_company_id) && $model->type_company_id;
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

        <!-- Контрагент -->
        <?php $company_id = $company_id ?? null; ?>
        <div class="row form-row" <?= $company_id ? 'hidden' : '' ?>>
            <div class="form-col col-3">
                <?php $model->company_id = $company_id ?: $model->company_id ?>
                <?= $form->field($model, 'company_id')->widget(Select2::class, [
                    'data' => Company::getList(),
                    'options' => [
                        'placeholder' => 'Выберите контрагента',
                    ],
                ]) ?>
            </div>
        </div>

        <div class="row form-row">
            <!-- Тип контрагента -->
            <div class="form-col col-3">
                <?= $form->field($model, 'type_company_id')->widget(Select2::class, [
                    'data' => TypeCompany::getList(),
                    'value' => $isOldModel ? $model->type_company_id : null,
                    'options' => [
                        'placeholder' => 'Выберите Тип контрагента',
                        'onchange' => '
                            const $classCompanyId = $("#companytypeclasscompany-type_class_company_id")
                            $.post(
                                "/type-class-company/get-list-by-type", 
                                {typeId: $(this).val()}, 
                                (data) => {
                                        console.log(data);
                                        $classCompanyId.children("option").remove();
                                        $.each(data, function(key, value) {
                                            $classCompanyId.append($("<option>", value));
                                        });
                                        $classCompanyId.prop("selectedIndex", -1);
                                        $classCompanyId.prop("disabled", (data.length === 0));
                                }
                            );
                        ',
                    ],
                ]) ?>
            </div>

            <!-- Класс контрагента -->
            <div class="form-col col-3">
                <?= $form->field($model, 'type_class_company_id')->widget(Select2::class, [
                    'data' => $isOldModel ? TypeClassCompany::getListByTypeCompanyId($model->type_company_id) : [],
                    'value' => $isOldModel ? $model->type_class_company_id : null,
                    'disabled' => !$isOldModel,
                    'options' => [
                        'placeholder' => 'Выберите Класс контрагента',
                    ],
                ]) ?>
            </div>
        </div>

        <div class="row form-last-row">
            <!-- Источник информации -->
            <div class="form-col col-3">
                <?= $form->field($model, 'info_source_id')->widget(Select2::class, [
                    'data' => InfoSource::getList(),
                    'value' => $isOldModel ? $model->info_source_id : null,
                    'options' => [
                        'placeholder' => 'Выберите Источник информации',
                    ],
                ]) ?>
            </div>

            <!-- Дата информации -->
            <div class="form-col col-3">
                <?= $form->field($model, 'date_info')->widget(DatePicker::class, [

                    'name' => 'date_info',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'removeButton' => false,
                    'readonly' => true,
                    'size' => 'sm',

                    'options' => [
                        'value' => $isOldModel ? date('d.m.Y', strtotime($model->date_info)) : date('d.m.Y'),
                    ],

                    'pluginOptions' => [
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true,
                    ],

                ]) ?>
            </div>

            <!-- Дата актуальности -->
            <div class="form-col col-3">
                <?= $form->field($model, 'date_actuality')->widget(DatePicker::class, [

                    'name' => 'date_actuality',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'readonly' => true,
                    'size' => 'sm',

                    'pluginOptions' => [
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true,
                    ],

                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-light btn-outline-primary btn-sm me-2']) ?>
            <?= Html::a('Отмена', '/company-type-class-company/index/' . $company_id ?: '', ['class' => 'btn btn-light btn-outline-secondary btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
