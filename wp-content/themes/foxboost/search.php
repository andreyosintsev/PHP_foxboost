<?php
/**
 * search.php
 *
 * The template for displaying Search Results pages.
 *
 * @link        https://foxboost.ru
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php get_header(); ?>
<?php
    $site_url         = site_url();
    $page_url         = get_page_uri();
    $template_url     = get_template_directory_uri();
    $search_query     = get_search_query();

    $postIDs          = searchByTitle($search_query);
    $posts_count      = count($postIDs);
?>
<main class="main">
    <div class="wrapper">
        <section class="section">
            <div class="title-wrapper">
                <h2 class="title">Результаты поиска '<?php echo $search_query?>'</h2>
                <?php
                    if ($posts_count > 0) {
                        echo '<div class="subtitle">'. declination($posts_count, ['Найден', 'Найдено', 'Найдено']). ' ' .$posts_count. ' ' . declination($posts_count, ['фоксбуст', 'фоксбуста', 'фоксбустов']) .'</div>';
                    } else {
                        echo '<div class="subtitle">Фоксбусты не найдены. Возможно, вас заинтересуют другие фоксбусты</div>';
                    }
                ?>
            </div>
            <div class="section-foxboost">
                <?php
                    if ($posts_count > 0) {
                        foreach($postIDs as $postID) {
                            get_template_part( 'partials/card-foxboost', null, ['post_id' => $postID] );
                        }
                    } else {
                        //Если ни один фоксбуст не найден
                        $args = array(
                            'post_type'      => 'foxboost',
                            'posts_per_page' => 4,
                            'orderby'        => 'rand',
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()) {
                            while ($query->have_posts()) : $query->the_post();
                                get_template_part( 'partials/card-foxboost', null, ['post_id' => get_the_ID()] );
                            endwhile;

                            wp_reset_postdata();
                        }
                    }
                ?>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>