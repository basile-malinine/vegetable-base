$(document).ready(function () {
    // обработка двойного клика на запись в таблице
    $('.contextMenuRow').on('dblclick', function () {
        let rowId = $(this).attr('data-row-id');
        $(location).attr('href', "/product/edit/" + rowId);
    });

    // инициализация контекстного меню для таблицы с данными
    let menu = new BootstrapMenu('.contextMenuRow', {
        fetchElementData: function ($rowElem) {
            return $rowElem.data('rowId');
        },
        actions: [
            {
                name: 'Редактировать',
                iconClass: 'fa-pen',
                onClick: (id) => {
                    document.location.href = "/product/edit/" + id;
                }
            },
            {
                name: 'Удалить',
                iconClass: 'fa-trash-alt',
                onClick: (id) => {
                    if (confirm("Вы точно хотите удалить запись?")) {
                        document.location.href = "/product/delete/" + id;
                    }
                }
            }
        ]
    });
});
