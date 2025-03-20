<?php

use yii\grid\GridView;
use app\models\Company\CompanyTypeClassCompanySearch;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var CompanyTypeClassCompanySearch $searchModel */
/** @var string $header */
/** @var integer $company_id */

$this->registerJs('let controllerName = "company-type-class-company";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?php
            if ($company_id) {
                echo '<a href="/company/edit/' . $company_id . '"'
                    . ' class="btn btn-return btn-light btn-outline-secondary btn-sm mt-1 me-3 pe-2"><i class="fa fa-arrow-left"></i>'
                    . '</a>';
            }
            ?>
            <?= $header ?>
            <a href="/company-type-class-company/create/<?= $company_id ? $company_id : '' ?>"
               class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
                <i class="fa fa-plus"></i>
                <span class="ms-2">Добавить</span>
            </a>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'rowOptions' => function ($model, $key, $index, $grid) {
            $company_id = Yii::$app->request->get('company_id');
            return [
                'class' => 'contextMenuRow',
                'data-row-id' => $model->id . ($company_id ? '/' . $company_id : ''),
                'style' => $model->date_actuality ? 'font-weight: bold' : '',
            ];
        },

        'columns' => [
            // ID
            [
                'attribute' => 'id',
                'enableSorting' => false,
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
            ],

            // Контрагент
            [
                'attribute' => 'company_id',
                'enableSorting' => true,
                'visible' => !$company_id,
                'value' => 'company.name',
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Тип
            [
                'attribute' => 'type_company_id',
                'enableSorting' => true,
                'value' => 'type_company.name',
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Класс
            [
                'attribute' => 'type_class_company_id',
                'enableSorting' => true,
                'value' => 'type_class_company.name',
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Источник информации
            [
                'attribute' => 'info_source_id',
                'enableSorting' => true,
                'value' => 'info_source.name',
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            [
                'attribute' => 'date_info',
                'value' => function ($model) {
                    return date("d.m.Y", strtotime($model->date_info));
                },
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],

            ],

            [
                'attribute' => 'date_actuality',
                'value' => function ($model) {
                    return $model->date_actuality ? date("d.m.Y", strtotime($model->date_actuality)) : 'Не актуально';
                },
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Пустота
            [
                'value' => function ($model) {
                    return '';
                },
            ],
        ],
    ]); ?>

</div>
