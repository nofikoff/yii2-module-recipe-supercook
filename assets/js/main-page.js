// by Novikov.ua 2020

$(document).ready(function () {
    $(document).on('change', '#ingredient-select', function () {
        $.ajax({
            type: "post",
            url: '/recipe/default/search',
            data: {'selected': $(this).val()},
            dataType: 'JSON',
            success: function (data) {
                console.log(data.result);
                if (data.status === 'ok') {
                    $('#search-result').html(data.result);
                } else {
                    $('#search-result').html('<p class="text-danger">Сбой чтения данных</p>');
                }
            }
        });
    });
});
