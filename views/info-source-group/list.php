<?php

use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \app\models\InfoSourceGroup\InfoSourceGroupSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $header */

$this->registerJs('let controllerName = "info-source-group";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/info-source-group/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
                    'style' => ' width: 50px;',
                ],
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
            ],

            // Название
            [
                'attribute' => 'name',
                'headerOptions' => [
                    'style' => 'width: 360px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Название
            [
                'attribute' => 'comment',
                'enableSorting' => false,
                'headerOptions' => [
                    'style' => 'width: 600px;'
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
