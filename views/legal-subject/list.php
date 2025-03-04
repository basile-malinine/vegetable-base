<?php

use yii\grid\GridView;
use app\models\LegalSubject\LegalSubjectSearch;

/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var LegalSubjectSearch $searchModel */
/** @var string $header */

$this->registerJs('let controllerName = "legal-subject";', \yii\web\View::POS_HEAD);
$this->registerJsFile('@web/js/contextmenu-list.js');

?>
<div class="page-content">
    <div class="page-top-panel">
        <div class="page-top-panel-header d-flex">
            <?= $header ?>
            <a href="/legal-subject/create" class="btn btn-light btn-outline-secondary btn-sm mt-1 ms-auto pe-3">
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
            // Юридическое / физическое (иконка)
            [
                'format' => 'raw',
                'value' => function ($model) {
                    return !$model->is_legal ? '<i class="fas fa-user"></i>' : '';
                },
                'contentOptions' => [
                    'style' => 'color: #0077ff; text-align: center',
                ],
                'headerOptions' => [
                    'style' => 'width: 30px',
                ],
            ],

            // ID
            [
                'attribute' => 'id',
                'contentOptions' => [
                    'style' => 'text-align: right;'
                ],
                'headerOptions' => [
                    'style' => 'width: 50px;'
                ],
            ],

            // Название или ФИО
            [
                'attribute' => 'name',
                'enableSorting' => true,
                'headerOptions' => [
                    'style' => 'width: 350px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            // ИНН
            [
                'attribute' => 'inn',
                'label' => 'Идентификатор',
                'enableSorting' => false,
                'headerOptions' => [
                    'style' => 'width: 180px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
                ],
            ],

            [
                'attribute' => 'country',
                'value' => 'country.name',
                'headerOptions' => [
                    'style' => 'width: 240px;'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control form-control-sm',
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
