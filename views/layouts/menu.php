<?php

use yii\bootstrap5\Nav;
use app\models\Company\Company;
use app\models\LegalSubject\LegalSubject;

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-5'],
    'encodeLabels' => false,

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
                    'label' => 'Цвета',
                    'url' => '/color',
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
                    'label' => 'Доверенные лица контрагентов',
                    'url' => ['/company-legal-subject/index'],
                    'disabled' => !(bool)Company::find()->count() || !(bool)LegalSubject::find()->count(),
                ],

                [
                    'label' => 'Юридические / Физические лица',
                    'url' => ['/legal-subject/index'],
                ],
            ],
        ],
    ]
]);
