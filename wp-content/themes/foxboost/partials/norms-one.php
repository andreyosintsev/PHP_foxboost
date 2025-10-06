<?php
/**
 * norms-one.php
 *
 * The partial for displaying the norms page if only norm is found.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php
    $site_url            = site_url();
    $page_url            = get_page_uri();
    $norms               = $args;

    $normSearchString    = $_GET['norm'];
    $isAuth              = isset($_SESSION['auth']);
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php
                $breadcrumbs = [[
                    "href" => $page_url,
                    "title" => "Поиск ГОСТа по номеру",
                    "content" => "Поиск ГОСТа по номеру"
                ],
                [
                    "content" => $normSearchString
                ]];

                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => $breadcrumbs]);
            ?>
            <h1 class="hero__title">
                <?php echo $normSearchString; ?>
            </h1>
            <div class="hero__subtitle">
                <?php echo $norms[0]->name_full; ?>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <section class="certificates">
                <div class="norms-data certificates__norm">
                    <div class="norm">
                        <div class="norm__file">
                            <?php
                                $scode = '[pdf-embedder url="'. $site_url .'/norms/'. $norms[0]->file.'"]';

                            echo apply_filters('the_content', $scode);
                            ?>
                        </div>
                    </div>
                    <div class="norms-data__actions">
                        <a class="button norms-data__action"
                           href="<?php echo $site_url; ?>/api/download-norm-count.php?id=<?php echo $norms[0]->ID ?>"
                           title="Скачать <?php echo $norms[0]->name; ?> - <?php echo replaceQuotes($norms[0]->name_full); ?>"
                           target="_blank"
                           onclick="ym(32820367,'reachGoal','norm-click'); return true;"
                        >
                            Скачать <?php echo $norms[0]->name;?>
                        </a>
                    </div>
                </div>
                <?php
                    $args = array(
                        'posts_per_page' => 10,
                        'paged' => get_query_var('paged'),
                        'post_status' => 'publish',
                        'meta_query' => array(
                            'norms' => array(
                                'key' => 'param5_complies_with',
                                'value' => $norms[0]->name,
                                'compare' => 'LIKE'
                            )
                        ),
                        'orderby' => 'title',
                        'order' => 'ASC'
                    );

                    global $wp_query;
                    $wp_query = new WP_Query($args);
                    $postCount = $wp_query->found_posts;
                ?>
                <h2 class="title-section certificates__title ">
                    <?php
                        echo declination($postCount, ["Найден ", "Найдено ", "Найдено "]) .
                        $postCount . declination($postCount, [
                            " сертификат, соответствующий нормативу",
                            " сертификата, соответствующих нормативу",
                            " сертификатов, соответствующих нормативу"])
                    ?>
                </h2>
                <div class="certificates__content">
                    <?php
                        while ( $wp_query->have_posts() ) {
                            $wp_query->the_post();
                            get_template_part( 'partials/certificates-item', null, ['postId' => get_the_ID()] );
                        }

                        if (function_exists('wp_page_numbers')) wp_page_numbers();
                    ?>
                </div>
            </section>
