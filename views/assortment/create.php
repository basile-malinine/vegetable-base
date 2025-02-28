<?php

use app\models\Assortment\Assortment;

/** @var yii\web\View $this */
/** @var Assortment $model */
/** @var string $header */
?>

<div class="unit-create">
    <?= $this->render('_form', compact('model', 'header')) ?>
</div>
