<?php

use yii\helpers\Html;
use app\models\Company\Company;

/** @var yii\web\View $this */
/** @var Company $model */
/** @var string $header */
?>
<div class="unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model', 'header')) ?>

</div>
