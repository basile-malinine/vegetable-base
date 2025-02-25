<?php

use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \app\models\Product\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $header */

$this->registerJsFile('@web/js/product.js');

?>
<div class="page-content">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/product/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
            // Весовой / не весовой (иконка)
            [
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->unit->is_weight ? '<i class="fas fa-balance-scale"></i>' : '';
                },
                'contentOptions' => [
                    'style' => 'color: #0077ff; text-align: center',
                ],
                'headerOptions' => [
                    'style' => 'width: 30px;',
                ],
            ],

            // ID
            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'text-align: right; width: 50px;'
                ],
                'filter' => false,
            ],

            // Наименование
            [
                'attribute' => 'name',
                'enableSorting' => true,
                'contentOptions' => [
                    'style' => 'width: 350px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Ед. изм.
            [
                'attribute' => 'unit',
                'enableSorting' => false,
                'filter' => false,
                'value' => 'unit.name',
                'contentOptions' => [
                    'style' => 'width: 70px;',
                ],
            ],

            // Вес
            [
                'attribute' => 'weight',
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'width: 100px; text-align: right;',
                ],
                'value' => function ($model) {
                    return $model->weight ?: '';
                },
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
