<?php
/**
 * row-campaign.php
 *
 * The partial for displaying single row of campaign table.
 *
 * @link        https://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php
    $template_url   = get_template_directory_uri();

    $number = !empty($args['number']) ? $args['number'] : '';

    $email = !empty($args['email']) ? $args['email'] : 'Не указан';

    //если e-mail не указан, вручную отправить уведомление нельзя';
    $disabled = empty($args['email']) ? 'disabled' : '';

    $name = !empty($args['name']) ? $args['name'] : 'Без имени';

    $promocode = !empty($args['promocode']) ? 'promo' : 'promo-no';
    /*
     *  promocode - использование промокода
     *
     *  promo     - был использован промокод
     *  promo-no  - без промокода
     */

    $promocode_htmls = [
        'promo' => '<div class="campaign__table-cell campaign__table-cell_promocode promocode_used">'. $args['promocode'] .'</div>',
        'promo-no' => '<div class="campaign__table-cell campaign__table-cell_promocode">Без промокода</div>'
    ];

    $status = !empty($args['status']) ? $args['status'] : 'sent-no';
    /*
     *  status - статусы отправки
     *
     *  sent-auto -   отправлено
     *  sent-manual - отправлено вручную
     *  sent-no -     не отправлено
     */

    $status_htmls = [
        'sent-auto' => '<div class="campaign__table-cell campaign__table-cell_status status_sent">
                            <span class="campaign__display_1200">Отправлено</span>
                            <span class="campaign__display_600">Отправлено</span>
                        </div>',
        'sent-man' => '<div class="campaign__table-cell campaign__table-cell_status status_sent">
                            <span class="campaign__display_1200">Отправлено вручную</span>
                            <span class="campaign__display_600">Отправлено</span>
                       </div>',
        'sent-no' => '<div class="campaign__table-cell campaign__table-cell_status status_not-sent">
                            <span class="campaign__display_1200">Уведомление не отправлено</span>
                            <span class="campaign__display_600">Не отправлено</span>
                      </div>'
    ];
?>

<div class="campaign__table-cell campaign__table-cell_number"><?php echo $number; ?></div>
<div class="campaign__table-cell campaign__table-cell_email"><?php echo $email; ?></div>
<div class="campaign__table-cell campaign__table-cell_name"><?php echo $name; ?></div>
<?php echo $promocode_htmls[$promocode]; ?>
<?php echo $status_htmls[$status]; ?>
<div class="campaign__table-cell campaign__table-cell_control">
    <button class="button campaign__button button_send" <?php echo $disabled; ?>>
        <span class="button__text campaign__display_1200" title="Отправить вручную">Отправить</span>
        <img
                class="button__image button__image_send"
                src="<?php echo $template_url; ?>/images/buttons/send.svg"
                alt="Отправить"
                title="Отправить вручную"
                    />
    </button>
    <button class="button campaign__button button_edit">
        <img
                class="button__image button__image_edit"
                src="<?php echo $template_url; ?>/images/buttons/edit.svg"
                alt="Редактировать"
                title="Редактировать"
                    />
    </button>
    <button class="button campaign__button button_delete">
        <img
                class="button__image button__image_delete"
                src="<?php echo $template_url; ?>/images/buttons/delete.svg"
                alt="Удалить"
                title="Удалить"
                    />
    </button>
</div>