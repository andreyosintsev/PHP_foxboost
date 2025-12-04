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

    $args = is_array($args) ? $args : [];

    $number = $args['number'] ?? '';
    $subscriber_id = $args['id'] ?? '';
    $post_id = $args['post_id'] ?? '';
    $email = $args['email'] ?? 'Не указан';
    $tel = $args['tel'] ?? 'Не указан';
    $name = $args['name'] ?? 'Без имени';
    $has_promocode = $args['promocode'] ?? false;
    $subscription_id = $args['subscription_id'] ?? '';
    $is_sent = $args['order_sent'] ?? false;

    //если e-mail не указан, вручную отправить уведомление нельзя;
    $disabled = empty($args['email']) ? 'disabled' : '';

    if ($has_promocode) {
        $promocode_html = '<div class="campaign__table-cell campaign__table-cell_promocode promocode_used">'. $has_promocode .'</div>';
    } else {
        $promocode_html = '<div class="campaign__table-cell campaign__table-cell_promocode">Без промокода</div>';
    }

    if ($is_sent) {
        $date = date('d.m.Y', strtotime($is_sent));
        $status_html = '<div class="campaign__table-cell campaign__table-cell_status status_sent">
                            <span class="campaign__display_1200">Отправлено  '. $date .'</span>
                            <span class="campaign__display_600">Отправлено</span>
                        </div>';
    } else {
        $status_html = '<div class="campaign__table-cell campaign__table-cell_status status_not-sent">
                            <span class="campaign__display_1200">Уведомление не отправлено</span>
                            <span class="campaign__display_600">Не отправлено</span>
                        </div>';
    }
?>

<div class="campaign__table-cell campaign__table-cell_number"><?php echo $number; ?></div>
<div class="campaign__table-cell campaign__table-cell_email"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></div>
<div class="campaign__table-cell campaign__table-cell_name"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></div>
<div class="campaign__table-cell campaign__table-cell_tel"><?php echo htmlspecialchars($tel, ENT_QUOTES, 'UTF-8'); ?></div>
<?php echo $promocode_html; ?>
<?php echo $status_html; ?>
<div class="campaign__table-cell campaign__table-cell_control">
    <button class="button campaign__button button_send"
        <?php echo $disabled; ?>
        data-subscriptionid="<?php echo $subscription_id; ?>"
    >
        <span class="button__text campaign__display_1200" title="Отправить вручную">Отправить</span>
        <img
                class="button__image button__image_send"
                src="<?php echo $template_url; ?>/images/buttons/send.svg"
                alt="Отправить"
                title="Отправить вручную"
        >
    </button>
    <button class="button campaign__button button_edit">
        <img
                class="button__image button__image_edit"
                src="<?php echo $template_url; ?>/images/buttons/edit.svg"
                alt="Редактировать"
                title="Редактировать"
        >
    </button>
    <button class="button campaign__button button_delete"
        data-postid="<?php echo $post_id; ?>"
        data-subscriberid="<?php echo $subscriber_id; ?>"
    >
        <img
                class="button__image button__image_delete"
                src="<?php echo $template_url; ?>/images/buttons/delete.svg"
                alt="Удалить"
                title="Удалить"
        >
    </button>
</div>