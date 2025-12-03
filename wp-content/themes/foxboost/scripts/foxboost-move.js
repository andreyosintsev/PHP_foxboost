console.log('foxboost-move.js loaded');

const base_url = 'http://localhost/foxboost';

$(document).on('click', '.button_complete, .button_restart, .button_archive, .button_restore', function(e){
    const $link = $(this);

    const url = `${base_url}/api/foxboost-move.php`;
    const postId = $link.data('postid');
    const moveTo = $link.data('moveto');

    $.getJSON(url, { post_id: postId, move_to: moveTo})
        .done(result => {
            if (result.success) {
                console.log(`Фоксбуст ${result.post_id} перемещен в статус ${result.move_to}`);
                location.reload();
            }
            else console.error(`Ошибка перемещения фоксбуста ${result.post_id} в статус ${result.move_to}`);
        })
        .fail((jqXHR, textStatus, errorThrown) =>
        {
            console.error('Ошибка AJAX: ', textStatus, errorThrown);
        });
});