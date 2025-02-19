<?php

use yii\grid\GridView;
use app\models\Company\CompanyLegalSubjectSearch;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var CompanyLegalSubjectSearch $searchModel */
/** @var string $header */
/** @var integer $company_id */

$this->registerJsFile('@web/js/company-legal-subject.js');

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
            <a href="/company-legal-subject/create<?= $company_id ? '/' . $company_id : '' ?>"
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
            ];
        },

        'columns' => [
            // ID
            [
                'attribute' => 'id',
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
            ],

            // Контрагент
            [
                'attribute' => 'company',
                'enableSorting' => true,
                'visible' => !$company_id,
                'value' => 'company.name',
                'headerOptions' => [
                    'style' => 'width: 300px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Доверенное лицо Название
            [
                'attribute' => 'legal_subject',
                'label' => 'Доверенное лицо Название',
                'enableSorting' => true,
                'value' => 'legal_subject.name',
                'headerOptions' => [
                    'style' => 'width: 300px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Доверенное лицо Полное название
            [
                'attribute' => 'legal_subject_full',
                'label' => 'Доверенное лицо Полное название',
                'enableSorting' => true,
                'value' => 'legal_subject.full_name',
                'headerOptions' => [
                    'style' => 'width: 460px;'
                ],
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
