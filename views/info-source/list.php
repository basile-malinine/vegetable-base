<?php

use yii\grid\GridView;
use app\models\InfoSource\InfoSourceSearch;

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var InfoSourceSearch $searchModel */
/** @var string $header */

$this->registerJs('let controllerName = "info-source";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/info-source/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
            ],

            // Название
            [
                'attribute' => 'name',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 280px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Группа
            [
                'attribute' => 'group',
                'value' => 'info_source_group.name',
                'headerOptions' => [
                    'style' => 'width: 280px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Класс
            [
                'attribute' => 'class',
                'headerOptions' => [
                    'style' => 'width: 80px;',
                ],
                'contentOptions' => [
                    'style' => 'text-align: center;',
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Рейтинг
            [
                'attribute' => 'rating',
                'headerOptions' => [
                    'style' => 'width: 80px;',
                ],
                'contentOptions' => [
                    'style' => 'text-align: center;',
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Комментарий
            [
                'attribute' => 'comment',
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],
        ],
    ]); ?>

</div>
