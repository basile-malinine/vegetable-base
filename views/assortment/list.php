<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use app\models\Assortment\AssortmentSearch;

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var AssortmentSearch $searchModel */
/** @var string $header */

$this->registerJsFile('@web/js/assortment.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/assortment/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
            ],

            // Название
            [
                'format' => 'raw',
                'attribute' => 'name',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 520px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Базовый продукт
            [
                'format' => 'raw',
                'attribute' => 'product',
                'value' => 'product.name',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 260px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Цвет
            [
                'format' => 'raw',
                'attribute' => 'color',
                'value' => 'color.value',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 130px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Пустота
            [
            ],
        ],
    ]); ?>

</div>
