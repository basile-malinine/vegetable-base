<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TypeClassCompany\TypeClassCompany;
use app\models\TypeClassCompany\TypeCompanySearch;

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var TypeCompanySearch $searchModel */
/** @var string $header */

$this->registerJs('let controllerName = "type-company";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/type-company/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
                'attribute' => 'name',
                'label' => 'Тип',
                'headerOptions' => ['style' => 'width: 420px;'],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Классы
            [
                'attribute' => 'type_class_company',
                'label' => 'Классы',
                'value' => function ($model) {
                    $val = '';
                    $classes = TypeClassCompany::getListByTypeCompanyId($model->id);
                    if (!empty($classes)) {
                        $classes = implode(', ', $classes);
                        $val = $classes;
                    }
                    return $val;
                },
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],
        ],
    ]); ?>

</div>
