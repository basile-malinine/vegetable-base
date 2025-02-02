$(document).ready(function () {
    // обработка двойного клика на запись в таблице
    $('.contextMenuRow').on('dblclick', function () {
        var rowId = $(this).attr('data-row-id');
        $(location).attr('href', "/unit/edit/" + rowId);
    });

    // инициализация контекстного меню для таблицы с данными
    var menu = new BootstrapMenu('.contextMenuRow', {
        fetchElementData: function ($rowElem) {
            var rowId = $rowElem.data('rowId');
            return rowId;
        },
        actions: [
            {
                name: 'Редактировать',
                iconClass: 'fa-pen',
                onClick: function (id) {
                    document.location.href = "/unit/edit/" + id;
                }
            },
            {
                name: 'Удалить',
                iconClass: 'fa-trash-alt',
                onClick: function (id) {
                    if (confirm("Вы точно хотите удалить запись?")) {
                        document.location.href = "/unit/delete/" + id;
                    }
                }
            }
        ]
    });
});
