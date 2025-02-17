/*
 * Обработка наборов Псевдонимы
 */

$(document).ready(function () {
    function addAliasOnClick(e) {
        alert($('#alias-name').val());
    }
    $('#add-alias').on('click', addAliasOnClick);
});