<?php

use yii\bootstrap5\Nav;
use app\models\Company\Company;

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

                '<hr class="dropdown-divider">',
                [
                    'label' => 'Контрагенты',
                    'url' => ['/company'],
                ],

                [
                    'label' => 'Псевдонимы контрагентов',
                    'url' => ['/company-alias/index'],
                    'disabled' => !(bool)Company::find()->count(),
                ],

                [
                    'label' => 'Юридические / Физические лица',
                    'url' => ['/legal-subject/index'],
                ],
            ],
        ],
    ]
]);
