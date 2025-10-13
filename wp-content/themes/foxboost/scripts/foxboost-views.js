const base_url = 'http://localhost/foxboost';

$(document).on('click', '.card-foxboost__link', function(e){
    e.preventDefault();

    const $link = $(this);

    const url = `${base_url}/api/increase-views.php`;
    const postId = $link.data('postid');
    const counters = $(`.card-foxboost__views[data-postid=${postId}]`);

    $.getJSON(url, { field: 'views', post_id: postId})
    .done(result => {
        if (result.success) counters.text(result.new_value);
        else console.error('Ошибка обновления просмотров');
    })
    .fail((jqXHR, textStatus, errorThrown) =>
    {
        console.error('Ошибка AJAX: ', textStatus, errorThrown);
    });

    window.location.href = $link.attr('href');
});