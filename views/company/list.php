<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Company\CompanyAlias;
use app\models\Company\CompanySearch;
use app\models\LegalSubject\LegalSubject;

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var CompanySearch $searchModel */
/** @var string $header */

$this->registerJs('let controllerName = "company";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/company/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
                'label' => 'Название (псевдонимы)',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 520px;'
                ],

                'filter' =>
                    '
                    <div class="row d-flex align-items-center">
                        <div class="col-9">' .
                    Html::activeInput('text', $searchModel, 'name', [
                        'class' => 'form-control form-control-sm',
                    ])
                    . '</div>
                        <div class="col-3 ps-0 pb-1">' .

                    Html::activeCheckBox($searchModel, 'aliasOn', [
                        'class' => 'form-check-input',
                        'label' => false,
                    ]) .
                    Html::activeLabel($searchModel, 'aliasOn', [
                        'class' => 'form-check-label',
                        'label' => 'Псевдоним',
                    ])
                    . '
                        </div>
                    </div>
                ',
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
                'value' => function ($model) {
                    $val = '<strong>' . $model->name . '</strong>';
                    $aliases = CompanyAlias::getListByCompanyId($model->id);
                    if (!empty($aliases)) {
                        $aliases = implode(', ', $aliases);
                        $val .= ' (' . $aliases . ')';
                    }
                    return $val;
                },
            ],

            // Доверенные лица
            [
                'format' => 'raw',
                'attribute' => 'legal_subject',
                'label' => 'Доверенные лица',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 520px;'
                ],
                'value' => function ($model) {
                    $cls = $model->company_legal_subject;
                    $ids = ArrayHelper::getColumn($cls, 'legal_subject_id');
                    $val = '';
                    if (!empty($ids)) {
                        $ls = LegalSubject::getListByIds($ids);
                        $val = implode(', ', $ls);
                    }
                    return $val;
                },
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // Продавец
            [
                'format' => 'raw',
                'header' => '<i class="fas fa-upload"></i>',
                'attribute' => 'is_seller',
                'filter' => [0 => 'нет', 1 => 'да'],
                'filterInputOptions' => ['class' => 'form-control form-control-sm', 'prompt' => 'все'],
                'value' => function ($model) {
                    return $model->is_seller ? '<i class="fas fa-check"></i>' : '';
                },
                'contentOptions' => [
                    'style' => 'color: #0077ff; text-align: center',
                ],
                'headerOptions' => [
                    'style' => 'width: 56px',
                ],
            ],

            // Покупатель
            [
                'format' => 'raw',
                'header' => '<i class="fa fa-download"></i>',
                'attribute' => 'is_buyer',
                'filter' => [0 => 'нет', 1 => 'да'],
                'filterInputOptions' => ['class' => 'form-control form-control-sm', 'prompt' => 'все'],
                'value' => function ($model) {
                    return $model->is_buyer ? '<i class="fas fa-check"></i>' : '';
                },
                'contentOptions' => [
                    'style' => 'color: #0077ff; text-align: center',
                ],
                'headerOptions' => [
                    'style' => 'width: 56px;',
                ],

            ],

            // Пустота
            [
            ],
        ],
    ]); ?>

</div>
