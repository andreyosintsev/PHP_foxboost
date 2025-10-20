<?php
/**
 * archive.php
 *
 * Template file for categories, tags e.t.c.
 *
 * @link        http://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php
    $site_url       = site_url();
    $template_url   = get_template_directory_uri();

    $isAuth         = isset($_SESSION['auth']);

    $brand = get_queried_object();
    $brand_slug = $brand->post_name;

    $image          = get_field('image', $brand->ID, false);    //Изображение фоксбуста
    $image_url      = wp_get_attachment_url($image);

?>
<?php get_header(); ?>
    <main class="main">
        <div class="wrapper">
            <div class="section-logo">
                <?php get_template_part('partials/panel-brands', null); ?>
            </div>
            <section class="section">
                <div class="title-wrapper">
                    <div class="logo title__logo">
                        <img class="logo__image" src="<?php echo $image_url; ?>" alt="Компания <?php echo esc_html(get_the_title()); ?>" />
                    </div>
                    <h2 class="title">Фоксбусты от <?php echo esc_html(get_the_title()); ?></h2>
                </div>
                <div class="section-foxboost">
                    <?php
                        $args = [
                            'post_type' => 'foxboost',
                            'posts_per_page' => -1,
                            'meta_query' => [
                                [
                                    'key' => 'brand',
                                    'value' => $brand->ID,
                                    'compare' => '=',
                                ]
                            ]
                        ];

                        $query = new WP_Query($args);

                        while ($query->have_posts()) : $query->the_post();
                            get_template_part('partials/card-foxboost', null, ['post_id' => get_the_ID()]);
                        endwhile;

                        wp_reset_postdata();
                    ?>
                </div>
            </section>
        </div>
    </main>
<?php get_footer(); ?>