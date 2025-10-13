<?php
/**
 * card-ambassador.php
 *
 * The partial for displaying the ambassador card.
 *
 * @link        https://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
    $post_id = $args['post_id'];    //ID записи амбассадора
    if (empty($post_id)) return;

    $double = $args['double'];     //выводить ли карточку двойной ширины

    $title          = get_the_title($post_id);                  //Имя амбассадора
    $description    = strip_tags(get_the_content($post_id));    //Описание амбассадора

    $image          = get_field('image', $post_id, false);    //Изображение амбассадора
    $image_url      = wp_get_attachment_url($image);
    $link           = get_field('link', $post_id, false);     //Ссылка на статью

    $add_class     = $double ? 'card-ambassador_double' : '';
?>
<div class="card-ambassador section-ambassador__card <?php echo $add_class; ?>">
    <img class="card-ambassador__img" src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" />
    <div class="card-ambassador__content">
        <div class="card-ambassador__title"><?php echo $title; ?></div>
        <div class="card-ambassador__description">
            <?php echo $description; ?>
        </div>
    </div>
    <a class="card-ambassador__link" href="<?php echo $link; ?>" title="Прочитать статью" target="_blank"></a>
</div>