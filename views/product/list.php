<?php

use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \app\models\Product\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $header */

$this->registerJsFile('@web/js/product.js');

?>
<div class="entity-content">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="entity-list-top-panel">
        <div class="entity-list-header">
            <?= $header ?>
            <a href="/product/create" class="btn btn-light btn-outline-dark btn-sm ms-5 pe-3">
                <i class="fa fa-plus"></i>
                <span class="ms-2">Добавить</span>
            </a>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'class' => 'contextMenuRow',
                'data-row-id' => $model->id,
            ];
        },

        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№ п/п',
                'headerOptions' => [
                    'style' => 'text-align: center; width: 70px;'
                ],
                'contentOptions' => [
                    'style' => 'text-align: center;'
                ]
            ],

            // Наименование
            [
                'attribute' => 'name',
                'enableSorting' => true,
                'contentOptions' => [
                    'style' => 'width: 350px;'
                ],
            ],

            // Ед. изм.
            [
                'attribute' => 'unit_id',
                'enableSorting' => false,
                'value' => function ($model) {
                    return $model->unit->name;
                },
                'contentOptions' => [
                    'style' => 'width: 70px;'
                ],
            ],

            // Вес
            [
                'attribute' => 'weight',
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'width: 100px;'
                ],
                'value' => function ($model) {
                    return $model->weight ?: '';
                },
            ],

            // Пустота
            [
                'value' => function ($model) { return ''; },
            ],
        ],

        'tableOptions' => [
            'class' => 'table table-condensed table-striped table-bordered table-hover mt-1'
        ],
    ]); ?>


</div>
