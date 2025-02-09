<?php
use yii\bootstrap5\Nav;

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-5'],
    'items' => [
        [
            'label' => 'Справочники',
            'items' => [
                [
                    'label' => 'Продукты',
                    'url' => ['/product/index'],
                ],

                [
                    'label' => 'Единицы измерения',
                    'url' => ['/unit/index'],
                ],

                [
                    'label' => 'Юридические / Физические лица',
                    'url' => ['/legal-subject/index'],
                ],
            ],
        ],
    ]
]);
