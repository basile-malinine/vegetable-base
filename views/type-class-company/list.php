<?php

use yii\grid\GridView;
use app\models\TypeClassCompany\TypeCompanySearch;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var TypeCompanySearch $searchModel */
/** @var string $header */
/** @var integer $type_company_id */

$this->registerJs('let controllerName = "type-class-company";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?php
            if ($type_company_id) {
                echo '<a href="/type-company/edit/' . $type_company_id . '"'
                    . ' class="btn btn-return btn-light btn-outline-secondary btn-sm mt-1 me-3 pe-2"><i class="fa fa-arrow-left"></i>'
                    . '</a>';
            }
            ?>
            <?= $header ?>
            <a href="/type-class-company/create/<?= $type_company_id ?: '' ?>"
               class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
                <i class="fa fa-plus"></i>
                <span class="ms-2">Добавить</span>
            </a>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => !$type_company_id ? $searchModel : null,

        'rowOptions' => function ($model, $key, $index, $grid) {
            $type_company_id = Yii::$app->request->get('type_company_id');
            return [
                'class' => 'contextMenuRow',
                'data-row-id' => $model->id . ($type_company_id ? '/' . $type_company_id : ''),
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

            // Класс
            [
                'attribute' => 'name',
                'label' => 'Класс',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Тип
            [
                'attribute' => 'type_company',
                'enableSorting' => true,
                'visible' => !$type_company_id,
                'value' => 'type_company.name',
                'headerOptions' => [
                    'style' => 'width: 240px;'
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
