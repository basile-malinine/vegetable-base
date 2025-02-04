<?php

use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \app\models\Unit\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $header */

$this->registerJsFile('@web/js/unit.js');

?>
<div class="entity-content">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="entity-list-top-panel">
        <div class="entity-list-header">
            <?= $header ?>
            <a href="/unit/create" class="btn btn-light btn-outline-secondary btn-sm ms-5 pe-3">
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
            // ID
            [
                'attribute' => 'id',
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'text-align: right; width: 50px;'
                ],
            ],

            // Имя
            [
                'attribute' => 'name',
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'width: 120px;'
                ],
            ],

            // Вес
            [
                'attribute' => 'weight',
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'width: 100px; text-align: right;'
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

        'tableOptions' => [
            'class' => 'table table-condensed table-striped table-bordered table-hover mt-2'
        ],
    ]); ?>

</div>
