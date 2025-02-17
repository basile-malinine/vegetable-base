<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="staticBackdropLabel">Псевдонимы</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <label class="col-form-label pt-0" for="alias-name">Название</label>
                <input type="text" id="alias-name" class="form-control form-control-sm">
            </div>

            <div class="modal-footer">
                <div class="form-group">
                    <?= Html::a('Добавить', '', [
                        'id' => 'add-alias',
                        'class' => 'btn btn-light btn-outline-primary btn-sm me-2',
                        'data-bs-dismiss' => 'modal',
                    ]) ?>
                    <?= Html::a('Отмена', '', [
                        'class' => 'btn btn-light btn-outline-secondary btn-sm',
                        'data-bs-dismiss' => 'modal',
                    ]) ?>
                </div>
            </div>

        </div>
    </div>
</div>