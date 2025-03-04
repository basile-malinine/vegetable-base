<?php

use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \app\models\Unit\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $header */

$this->registerJs('let controllerName = "unit";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/unit/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
            // Весовой / не весовой (иконка)
            [
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->is_weight ? '<i class="fas fa-balance-scale"></i>' : '';
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

            // Вес (кг)
            [
                'attribute' => 'weight',
                'enableSorting' => false,
                'contentOptions' => [
                    'style' => 'width: 100px; text-align: right;',
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
