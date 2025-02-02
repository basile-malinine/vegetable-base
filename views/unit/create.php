<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Unit $model */
/** @var string $header */
?>
<div class="unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'header')) ?>

</div>
