<?php

use yii\grid\GridView;
use app\models\ProductColor\ProductColorSearch;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var ProductColorSearch $searchModel */
/** @var string $header */
/** @var integer $product_id */

$this->registerJs('let controllerName = "product-color";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?php
            if ($product_id) {
                echo '<a href="/product/edit/' . $product_id . '"'
                    . ' class="btn btn-return btn-light btn-outline-secondary btn-sm mt-1 me-3 pe-2"><i class="fa fa-arrow-left"></i>'
                    . '</a>';
            }
            ?>
            <?= $header ?>
            <a href="/product-color/create<?= $product_id ? '/' . $product_id : '' ?>"
               class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
                <i class="fa fa-plus"></i>
                <span class="ms-2">Добавить</span>
            </a>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => !$product_id ? $searchModel : null,

        'rowOptions' => function ($model, $key, $index, $grid) {
            $product_id = Yii::$app->request->get('product_id');
            return [
                'class' => 'contextMenuRow',
                'data-row-id' => $model->id . ($product_id ? '/' . $product_id : ''),
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

            // Цвет продукта Значение
            [
                'attribute' => 'color',
                'enableSorting' => true,
                'value' => 'color.value',
                'headerOptions' => [
                    'style' => 'width: 300px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Продукт
            [
                'attribute' => 'product',
                'enableSorting' => true,
                'visible' => !$product_id,
                'value' => 'product.name',
                'headerOptions' => [
                    'style' => 'width: 300px;'
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
