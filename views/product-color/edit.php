<?php

use app\models\ProductColor\ProductColor;

/** @var yii\web\View $this */
/** @var ProductColor $model */
/** @var string $header */
/** @var string $product_id */
?>

<?= $this->render('_form', compact('model', 'header', 'product_id')) ?>
