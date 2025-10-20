<?php
/**
 * archive.php
 *
 * Template file for categories, tags e.t.c.
 *
 * @link        https://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php
    $site_url       = site_url();
    $template_url   = get_template_directory_uri();

    $isAuth         = isset($_SESSION['auth']);

    $currentCategoryName = '';
    if (is_category()) {
       $currentCategoryName = mb_strtolower(single_cat_title('',false));
    }
?>
<?php get_header(); ?>
<main class="main">
        <div class="wrapper">
            <section class="section">
                <h2 class="title">Фоксбусты на <?php echo $currentCategoryName; ?></h2>
                <div class="section-foxboost">
                    <?php
                    $term = get_queried_object();

                    $args = [
                        'post_type' => 'foxboost',
                        'posts_per_page' => -1,
                        'tax_query' => [
                            [
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $term->term_id,
                            ],
                        ],
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ];

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            get_template_part('partials/card-foxboost', null, ['post_id' => get_the_ID()]);
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>Фоксбустов в этой рубрике нет.</p>';
                    endif;
                    ?>
                </div>
            </section>
        </div>
    </main>
<?php get_footer(); ?>