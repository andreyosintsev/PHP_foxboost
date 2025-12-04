<?php
/*
* Template Name: Panel
*
* template-panel.php
*
* Template file for control panel for campaigns.
* /panel
*
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2025 asosintsev@yandex.ru
*/
?>
<?php get_header(); ?>
<?php
    $template_url   = get_template_directory_uri();

?>
<main class="main">
    <div class="wrapper">
        <section class="section">
            <h2 class="title">Панель управления</h2>
            <?php if (!( is_user_logged_in() && current_user_can('administrator') )) { ?>
                <div class="access-denied">
                    <h2>Доступ запрещён</h2>
                    <p>Для входа в панель управления необходимо авторизоваться как администратор,<br>
                     а затем вновь вернуться на эту страницу</p>
                    <div><a class="button access-denied__link" href="<?php echo esc_url(wp_login_url()); ?>">Войти</a></div>
                </div>
            <?php
                return;
            }?>
            <div class="panel">
                <div class="panel__title">Общая статистика</div>
                <div class="panel__content">
                    <div class="panel-stats">
                        <div class="panel-stats_card card-stats">
                            <?php
                                $count_foxboosts = wp_count_posts('foxboost');
                                $foxboosts_published = $count_foxboosts->publish;
                            ?>
                            <div class="card-stats__value"><?php echo $foxboosts_published; ?></div>
                            <div class="card-stats__description"><?php echo declination($foxboosts_published, ['Фоксбуст', 'Фоксбуста', 'Фоксбустов']);?> на сайте</div>
                        </div>
                        <div class="panel-stats_card card-stats">
                            <?php $subscribers_total = getTotalSubscribers(); ?>
                            <?php $subscribers_active = getActiveSubscribers(); ?>
                            <div class="card-stats__value"><?php echo $subscribers_total; ?> (<?php echo $subscribers_active; ?>)</div>
                            <div class="card-stats__description"><?php echo declination($subscribers_total, ['Пользователь зарегистрирован', 'Пользователя зарегистрировано', 'Пользователей зарегистрировано']);?></div>
                        </div>
                        <div class="panel-stats_card card-stats">
                            <?php $total_subscriptions = getTotalSubscriptions(); ?>
                            <div class="card-stats__value"><?php echo $total_subscriptions; ?></div>
                            <div class="card-stats__description"><?php echo declination($total_subscriptions, ['Подписка', 'Подписки', 'Подписок']);?> от пользователей</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel__title panel__title_border-bottom panel__title_with-search">
                    Заявки по фоксбустам
                    <div class="input-search panel__search">
                        <input class="input input-search__input" id="panel-filter" type="text" placeholder="Фильтр по названию" />
                        <button class="input-search__button" type="submit">
                            <svg width="800px" height="800px" class="input-search__icon" id="panel-filter-clear"  viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000"><path d="M10 12.6l.7.7 1.6-1.6 1.6 1.6.8-.7L13 11l1.7-1.6-.8-.8-1.6 1.7-1.6-1.7-.7.8 1.6 1.6-1.6 1.6zM1 4h14V3H1v1zm0 3h14V6H1v1zm8 2.5V9H1v1h8v-.5zM9 13v-1H1v1h8z"/></svg>
                        </button>
                    </div>
                </div>
                <div class="panel__content">

                    <?php
                        $foxboosts_active = getFoxboostIdsByStatus('active');
//                        var_dump($foxboosts_active);
                        $foxboosts_active_count = count($foxboosts_active);
                        if ($foxboosts_active_count > 0) { ?>

                            <div class="section-campaign">
                                <div class="section-campaign__title">
                                    Сбор заявок
                                    <span class="section-campaign__number">
                                        (<?php echo $foxboosts_active_count. declination($foxboosts_active_count, [' фоксбуст', ' фоксбуста', ' фоксбустов']); ?>)
                                    </span>
                                </div>
                                <div class="section-campaign__content">
                                    <?php foreach($foxboosts_active as $foxboosts_active_id) {
                                        $subscriptions = getSubscriptionsByFoxboostId($foxboosts_active_id);
                                        $subscriptions_count = count($subscriptions);
                                    ?>

                                        <div class="campaign <?php if ($subscriptions_count > 0) echo 'campaign_expanded'; ?>">
                                            <div class="campaign__header">
                                                <div class="campaign__title">
                                                    <?php echo getFoxboostNameById($foxboosts_active_id); ?>
                                                    <span class="campaign__status campaign__status_active campaign__display_1200">cбор заявок (<?php echo $subscriptions_count .' '. declination($subscriptions_count, ['заявка', 'заявки', 'заявок'])?>)</span>
                                                    <span class="campaign__status campaign__status_active campaign__display_600">сбор (<?php echo $subscriptions_count .' '. declination($subscriptions_count, ['заявка', 'заявки', 'заявок'])?>)</span>
                                                </div>
                                                <div class="campaign__control">
                                                    <button class="button campaign__button button_complete" data-postid="<?php echo $foxboosts_active_id; ?>" data-moveto="completed">
                                                        <span class="button__text">Завершить сбор</span>
                                                        <img
                                                                class="button__image button__image_complete"
                                                                src="<?php echo $template_url; ?>/images/buttons/complete.svg"
                                                                alt="Завершить"
                                                        />
                                                    </button>
                                                    <button class="button campaign__button button_sendall">
                                                        <span class="button__text">Отправить всем</span>
                                                        <img
                                                                class="button__image button__image_send-all"
                                                                src="<?php echo $template_url; ?>/images/buttons/send.svg"
                                                                alt="Отправить"
                                                        />
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="campaign__content">
                                                <div class="campaign__table">
                                                    <?php
                                                        if (count($subscriptions) < 1) echo '<div class="campaign__table-cell campaign__table-cell_no-applications">Заявок нет</div>';

                                                        foreach ($subscriptions as $i => $subscription) {
                                                            $subscription['number'] = $i + 1;
                                                            $subscription['post_id'] = $foxboosts_active_id;
                                                            echo get_template_part('partials/row-campaign', null, $subscription);
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                    <?php } ?>

                    <?php
                    $foxboosts_completed = getFoxboostIdsByStatus('completed');
                    $foxboosts_completed_count = count($foxboosts_completed);
                    if ($foxboosts_completed_count > 0) { ?>


                        <div class="section-campaign">
                            <div class="section-campaign__title">
                                Сбор заявок окончен
                                <span class="section-campaign__number">
                                    (<?php echo $foxboosts_completed_count. declination($foxboosts_completed_count, [' фоксбуст', ' фоксбуста', ' фоксбустов']); ?>)
                                </span>
                            </div>
                            <div class="section-campaign__content">
                            <?php foreach($foxboosts_completed as $foxboosts_completed_id) {
                                $subscriptions = getSubscriptionsByFoxboostId($foxboosts_completed_id);
                                $subscriptions_count = count($subscriptions);
                                ?>

                                <div class="campaign <?php if ($subscriptions_count > 0) echo 'campaign_expanded'; ?>">
                                    <div class="campaign__header">
                                        <div class="campaign__title">
                                            <?php echo getFoxboostNameById($foxboosts_completed_id); ?>
                                            <span class="campaign__status campaign__status_completed campaign__display_1200">
                                                cбор заявок окончен (<?php echo $subscriptions_count .' '. declination($subscriptions_count, ['заявка', 'заявки', 'заявок'])?>)</span>
                                            <span class="campaign__status campaign__status_completed campaign__display_600">окончен (<?php echo $subscriptions_count .' '. declination($subscriptions_count, ['заявка', 'заявки', 'заявок'])?>)</span>
                                        </div>
                                        <div class="campaign__control">
                                            <button class="button campaign__button button_restart" data-postid="<?php echo $foxboosts_completed_id; ?>" data-moveto="active">
                                                <span class="button__text">Возобновить сбор</span>
                                                <img
                                                        class="button__image button__image_restart"
                                                        src="<?php echo $template_url; ?>/images/buttons/restart.svg"
                                                        alt="Возобновить"
                                                />
                                            </button>
                                            <button class="button campaign__button button_archive" data-postid="<?php echo $foxboosts_completed_id; ?>" data-moveto="archive">
                                                <span class="button__text">Отправить в архив</span>
                                                <img
                                                        class="button__image button__image_archive"
                                                        src="<?php echo $template_url; ?>/images/buttons/archive.svg"
                                                        alt="Отправить"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                    <div class="campaign__content">
                                        <div class="campaign__table">
                                            <?php
                                                $subscriptions = getSubscriptionsByFoxboostId($foxboosts_completed_id);
                                                if (count($subscriptions) < 1) echo '<div class="campaign__table-cell campaign__table-cell_no-applications">Заявок нет</div>';

                                                foreach ($subscriptions as $i => $subscription) {
                                                    $subscription['number'] = $i + 1;
                                                    $subscription['post_id'] = $foxboosts_completed_id;
                                                    echo get_template_part('partials/row-campaign', null, $subscription);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                    <?php } ?>

                    <?php
                    $foxboosts_archive = getFoxboostIdsByStatus('archive');
                    $foxboosts_archive_count = count($foxboosts_archive);
                    if ($foxboosts_archive_count > 0) { ?>

                        <div class="section-campaign">
                            <div class="section-campaign__title">
                                Архив
                                <span class="section-campaign__number">
                                    (<?php echo $foxboosts_archive_count. declination($foxboosts_archive_count, [' фоксбуст', ' фоксбуста', ' фоксбустов']); ?>)
                                </span>
                            </div>
                            <div class="section-campaign__content">
                                <?php foreach($foxboosts_archive as $foxboosts_archive_id) {
                                    $subscriptions = getSubscriptionsByFoxboostId($foxboosts_archive_id);
                                    $subscriptions_count = count($subscriptions);
                                ?>

                                <div class="campaign <?php if ($subscriptions_count > 0) echo 'campaign_expanded'; ?>">
                                    <div class="campaign__header">
                                        <div class="campaign__title">
                                            <?php echo getFoxboostNameById($foxboosts_archive_id); ?>
                                            <span class="campaign__status campaign__status_archive campaign__display_1200">
                                                в архиве (<?php echo $subscriptions_count .' '. declination($subscriptions_count, ['заявка', 'заявки', 'заявок']);?>)
                                            </span>
                                            <span class="campaign__status campaign__status_archive campaign__display_600">
                                                в архиве (<?php echo $subscriptions_count .' '. declination($subscriptions_count, ['заявка', 'заявки', 'заявок']);?>)
                                            </span>
                                        </div>
                                        <div class="campaign__control">
                                            <button class="button campaign__button button_restore" data-postid="<?php echo $foxboosts_archive_id; ?>" data-moveto="completed">
                                                <span class="button__text">Восстановить из архива</span>
                                                <img
                                                        class="button__image button__image_restore"
                                                        src="<?php echo $template_url; ?>/images/buttons/restore.svg"
                                                        alt="Восстановить"
                                                />
                                            </button>
                                        </div>
                                    </div>
                                    <div class="campaign__content">
                                        <div class="campaign__table">
                                            <?php
                                                $subscriptions = getSubscriptionsByFoxboostId($foxboosts_archive_id);
                                                if (count($subscriptions) < 1) echo '<div class="campaign__table-cell campaign__table-cell_no-applications">Заявок нет</div>';

                                                foreach ($subscriptions as $i => $subscription) {
                                                    $subscription['number'] = $i + 1;
                                                    echo get_template_part('partials/row-campaign', null, $subscription);
                                                }

                                            ?>


                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>