<?php

use yii\grid\GridView;
use app\models\Company\CompanyAliasSearch;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var CompanyAliasSearch $searchModel */
/** @var string $header */
/** @var integer $company_id */

$this->registerJs('let controllerName = "company-alias";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?php
            if ($company_id) {
                echo '<a href="/company/edit/' . $company_id . '"'
                    . ' class="btn btn-return btn-light btn-outline-secondary btn-sm mt-1 me-3 pe-2"><i class="fa fa-arrow-left"></i>'
                    . '</a>';
            }
            ?>
            <?= $header ?>
            <a href="/company-alias/create/<?= $company_id ? $company_id : '' ?>"
               class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
                <i class="fa fa-plus"></i>
                <span class="ms-2">Добавить</span>
            </a>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => !$company_id ? $searchModel : null,

        'rowOptions' => function ($model, $key, $index, $grid) {
            $company_id = Yii::$app->request->get('company_id');
            return [
                'class' => 'contextMenuRow',
                'data-row-id' => $model->id . ($company_id ? '/' . $company_id : ''),
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

            // Псевдоним
            [
                'attribute' => 'name',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm'
                ],
            ],

            // Контрагент
            [
                'attribute' => 'company',
                'enableSorting' => true,
                'visible' => !$company_id,
                'value' => 'company.name',
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
