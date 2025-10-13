<?php
/**
 * card-foxboost.php
 *
 * The partial for displaying the foxboost card.
 *
 * @link        https://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
    $post_id = $args['post_id'];    //ID записи фоксбуста
    if (empty($post_id)) return;

    $title          = get_the_title($post_id);                   //Название фоксбуста
    $description    = strip_tags(get_the_content($post_id)) ;    //Описание фоксбуста

    $image          = get_field('image', $post_id, false);    //Изображение фоксбуста
    $image_url      = wp_get_attachment_url($image);
    $special        = get_field('special', $post_id, false);  //Наш выбор или бестселлер
    $datetogo       = get_field('datetogo', $post_id, false); //Дата окончания сбора заявок
    $link           = get_field('link', $post_id, false);     //Ссылка на лендинг
    $apps           = get_field('apps', $post_id, false);     //Количество заявок
    $views          = get_field('views', $post_id, true);    //Количество просмотров

    $dateString = declination(daysToGo($datetogo), ['остался', 'осталось', 'осталось']) .' '. daysToGo($datetogo) .' '. declination(daysToGo($datetogo), ['день', 'дня', 'дней']);
?>
<div class="card-foxboost section-foxboost__card">
    <div class="card-foxboost__caption">
        <div class="card-foxboost__image">
            <a class="card-foxboost__link" href="<?php echo $link; ?>" title="<?php echo $title; ?>" data-postid="<?php echo $post_id; ?>">
                <img
                        class="card-foxboost__img"
                        src="<?php echo $image_url; ?>"
                        alt="<?php echo $title; ?>"
                />
            </a>
            <div class="card-foxboost__image-overlay">
                <p class="card-foxboost__image-caption">Посмотреть фоксбуст</p>
            </div>
        </div>
        <div class="card-foxboost__stats">
            <div class="card-foxboost__togo-apps"><?php echo $dateString; ?>, <?php echo $apps; ?> заявок</div>
            <div class="card-foxboost__views" data-postid="<?php echo $post_id; ?>"><?php echo $views; ?></div>
        </div>
        <h3 class="card-foxboost__title">
            <a class="card-foxboost__link" href="<?php echo $link; ?>" title="Посмотреть фоксбуст"  data-postid="<?php echo $post_id; ?>">
                <?php echo $title; ?>
            </a>
        </h3>
    </div>
    <div class="card-foxboost__content">
        <div class="card-foxboost__description">
            <?php echo $description; ?>
        </div>
        <div class="card-foxboost__rating">
            <?php echo kk_star_ratings(); ?>
        </div>
        <div class="button card-foxboost__button button_subscribe" data-product="<?php echo $title; ?>">
            Оставить заявку
        </div>
    </div>
    <?php $featured_class = !($special === 'no') ? 'card-foxboost__special_' .$special : ''; ?>
    <div class="card-foxboost__special <?php echo $featured_class; ?>"></div>
</div>