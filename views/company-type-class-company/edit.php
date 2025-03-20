<?php

use app\models\Company\CompanyTypeClassCompany;

/** @var yii\web\View $this */
/** @var CompanyTypeClassCompany $model */
/** @var string $header */
/** @var string $company_id */
?>

<?= $this->render('_form', compact('model', 'header', 'company_id')) ?>
