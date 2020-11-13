

$(document).ready(function () {
    $(document).on('change', '#ingredient-select', function () {
        $.ajax({
            url: '/recipe/search',
            type: 'post',
            data: {'selected': $(this).val()},
            dataType: 'JSON'
        }).success(function (data) {
            console.log(data.result);
            if (data.status === 'ok') {
                $('#search-result').html(data.result);
            } else {
                $('#search-result').html('<p class="text-danger">Нет данных</p>');
            }
        })
    });
});
