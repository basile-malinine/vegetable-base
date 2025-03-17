<?php

use app\models\TypeClassCompany\TypeClassCompany;

/** @var yii\web\View $this */
/** @var TypeClassCompany $model */
/** @var string $header */
/** @var string $type_company_id */
?>

<?= $this->render('_form', compact('model', 'header', 'type_company_id')) ?>
