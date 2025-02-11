<?php

use yii\grid\GridView;
use app\models\Company\CompanySearch;

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var CompanySearch $searchModel */
/** @var string $header */

$this->registerJsFile('@web/js/company.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header">
            <?= $header ?>
            <a href="/company/create" class="btn btn-light btn-outline-secondary btn-sm ms-5 pe-3">
                <i class="fa fa-plus"></i>
                <span class="ms-2">Добавить</span>
            </a>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'class' => 'contextMenuRow',
                'data-row-id' => $model->id,
            ];
        },

        'columns' => [
            // ID
            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
            ],

            // Название
            [
                'attribute' => 'name',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 450px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Продавец
            [
                'format' => 'raw',
//                'header' => '<i class="fas fa-sign-out-alt"></i>',
                'attribute' => 'is_seller',
                'filter' => false,
                'value' => function ($model) {
                    return $model->is_seller ? '<i class="fas fa-check"></i>' : '';
                },
                'contentOptions' => [
                    'style' => 'color: #0077ff; text-align: center',
                ],
                'headerOptions' => [
                    'style' => 'width: 120px',
                ],
            ],

            // Покупатель
            [
                'format' => 'raw',
//                'header' => '<i class="fas fa-sign-in-alt"></i>',
                'attribute' => 'is_buyer',
                'filter' => false,
                'value' => function ($model) {
                    return $model->is_buyer ? '<i class="fas fa-check"></i>' : '';
                },
                'contentOptions' => [
                    'style' => 'color: #0077ff; text-align: center',
                ],
                'headerOptions' => [
                    'style' => 'width: 120px',
                ],

            ],

            // Пустота
            [
            ],
        ],
    ]); ?>

</div>
