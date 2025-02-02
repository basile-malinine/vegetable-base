<?php
use yii\bootstrap5\Nav;

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-5'],
    'items' => [
        [
            'label' => 'Справочники',
            'items' => [
                [
                    'label' => 'Единицы измерения',
                    'url' => ['/unit/index'],
                ]
            ],
        ],
    ]
]);
