<?php

use app\models\Company\CompanyAlias;

/** @var yii\web\View $this */
/** @var CompanyAlias $model */
/** @var string $header */
/** @var string $company_id */
?>

<?= $this->render('_form', compact('model', 'header', 'company_id')) ?>
