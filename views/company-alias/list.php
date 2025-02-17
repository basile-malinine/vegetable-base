<?php

use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \app\models\Company\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $header */
/** @var integer $company_id */

$this->registerJsFile('@web/js/company-alias.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?php
            if ($company_id) {
                echo '<a href="/company/edit/' . $company_id . '"'
                    . ' class="btn btn-light btn-outline-secondary btn-sm mt-1 me-3 pe-2"><i class="fa fa-arrow-left"></i>'
                    . '</a>';
            }
            ?>
            <?= $header ?>
            <a href="/company-alias/create/<?= $company_id ? $company_id : '' ?>"
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
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
            ],

            // Псевдоним
            [
                'attribute' => 'name',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Контрагент
            [
                'attribute' => 'company',
                'enableSorting' => true,
                'visible' => !$company_id,
                'value' => function ($model) {
                    return $model->company->name;
                },
                'headerOptions' => [
                    'style' => 'width: 240px;'
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
