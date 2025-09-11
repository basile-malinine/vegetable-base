<?php

use yii\bootstrap5\Nav;
use app\models\Company\Company;
use app\models\LegalSubject\LegalSubject;
use app\models\Product\Product;
use app\models\Product\ProductGroup;

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-5'],
    'encodeLabels' => false,

    'items' => [
        [
            'label' => 'Справочники',
            'items' => [
                [
                    'label' => 'Классификатор продуктов',
                    'url' => ['/product-group'],
                ],

                [
                    'label' => 'Продукты',
                    'url' => ['/product'],
                ],

                [
                    'label' => 'Номенклатура',
                    'url' => ['/assortment'],
                    'disabled' => Product::find()->count() === 0,
                ],

                '<hr class="dropdown-divider">',

                [
                    'label' => 'Страны',
                    'url' => ['/country'],
                ],

                [
                    'label' => 'Единицы измерения',
                    'url' => ['/unit'],
                ],

                [
                    'label' => 'Цвета',
                    'url' => '/color',
                ],

                '<hr class="dropdown-divider">',

                [
                    'label' => 'Группы источников информации',
                    'url' => ['/info-source-group'],
                ],

                [
                    'label' => 'Источники информации',
                    'url' => ['/info-source'],
                ],

                '<hr class="dropdown-divider">',

                [
                    'label' => 'Контрагенты',
                    'url' => ['/company'],
                ],

                [
                    'label' => 'Типы и Классы контрагентов',
                    'url' => ['/type-company'],
                    'disabled' => !(bool)Company::find()->count(),
                ],

                [
                    'label' => 'Псевдонимы контрагентов',
                    'url' => ['/company-alias'],
                    'disabled' => !(bool)Company::find()->count(),
                ],

                [
                    'label' => 'Доверенные лица контрагентов',
                    'url' => ['/company-legal-subject'],
                    'disabled' => !(bool)Company::find()->count() || !(bool)LegalSubject::find()->count(),
                ],

                [
                    'label' => 'Юридические / Физические лица',
                    'url' => ['/legal-subject'],
                ],
            ],
        ],
    ]
]);
