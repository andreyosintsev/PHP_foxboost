<?php
/**
 * panel-brands.php
 *
 * The partial for displaying the brands panel.
 *
 * @link        https://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php

$brands = get_posts([
    'post_type'      => 'brand',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
]);

if ( ! empty( $brands ) ) {
    ?>
    <ul class="section-logo__items">
        <?php foreach($brands as $brand) {

            //Проверим, что существуют фоксбусты этого бренда
            $args = [
                'post_type'  => 'foxboost',
                'meta_query' => [
                    [
                        'key'   => 'brand',
                        'value' => $brand->ID,
                    ],
                ],
                'fields'     => 'ids',
                'posts_per_page' => 1,
            ];

            $query = new WP_Query($args);
            if (!$query->have_posts()) continue;

            $name = get_the_title($brand->ID);
            $image = get_field('image', $brand->ID, false);
            $image_url = wp_get_attachment_url($image);

            echo '<li class="logo section-logo__item">
                        <a class="logo__link" href="' .get_permalink($brand->ID). '">
                            <img class="logo__image" src="'. $image_url .'" alt="Компания '. $name .'" title="Фоксбусты от '. $name .'"/>
                        </a>
                  </li>';
        }?>
    </ul>
<?php } ?>