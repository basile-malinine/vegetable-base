<?php

use app\models\Company\CompanyLegalSubject;

/** @var yii\web\View $this */
/** @var CompanyLegalSubject $model */
/** @var string $header */
/** @var string $company_id */
?>

<?= $this->render('_form', compact('model', 'header', 'company_id')) ?>
