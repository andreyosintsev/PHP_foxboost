<?php
/*
Template Name: Manufacturers
*
* template-manufacturers.php
*
* Template file for searching by manufacturers and results.
* /kompanii/
*
* @link        http://rostest-certify.ru/
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2024 asosintsev@yandex.ru
*/
?>
<?php get_header(); ?>
<?php
    $site_url            = site_url();
    $page_url            = get_page_uri();
    $base_url            = $site_url. '/' .$page_url;

    if (isset($_GET['param'])) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ". $base_url .'/?manufacturer='. $_GET['param']);
        exit();
    }

    $manufacturerSearchString = $_GET['manufacturer'];
    $isAuth              = isset($_SESSION['auth']);
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php
                $breadcrumbs = [];
                if (!empty($manufacturerSearchString)) {
                    $breadcrumbs[] = [
                        "href" => $page_url,
                        "title" => "Поиск по изготовителю",
                        "content" => "Поиск по изготовителю"
                    ];
                } else {
                    $breadcrumbs[] = [
                        "content" => "Поиск по изготовителю",
                    ];
                }

                if (!empty($manufacturerSearchString)) {
                    $breadcrumbs[] = [
                        "content" => $manufacturerSearchString
                    ];
                };

                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => $breadcrumbs]);
            ?>
            <h1 class="hero__title">
                <?php
                    if (empty($manufacturerSearchString)) { ?>
                        Поиск сертификата по изготовителю
                <?php } else { ?>
                        Сертификаты <?php echo $manufacturerSearchString; ?>
                <?php } ?>
            </h1>
            <?php get_template_part(
                'partials/search-item',
                null, [
                    'title'                => 'Поиск сертификата по изготовителю:',
                    'placeholder'          => $manufacturerSearchString,
                    'placeholderDefault'   => 'Например, ТехноНИКОЛЬ',
                    'action'               => $site_url. '/' . get_page_uri(),
                    'param'                => 'manufacturer'
                    ]
                );
            ?>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <?php if ($manufacturerSearchString == '') { ?>
                <?php if (!$isAuth) { ?>
                    <div class="content__ad">
                    </div>
                <?php } ?>
                <section class="manufacturers">
                    <h2 class="title-section manufacturers__title">
                        Алфавитный указатель
                    </h2>
                    <p>Организации-изготовители, для которых на данном сайте представлено наибольшее количество сертификатов и деклараций.</p>
                    <p>Для поиска организации-изготовителя, не представленной в этом перечне, воспользуйтесь поиском.</p>
                    <?php
                        $manufacturers = getAllManufacturers(300);

                        $currLetter = '';
                        $isOpened = false;

                        foreach ($manufacturers as $manufacturer => $freq) {
                            $firstLetter = mb_substr($manufacturer, 0, 1);
                            if ($firstLetter != $currLetter) {
                                if ($isOpened) echo '</div>'; else $isOpened = true;
                    ?>
                                <div class="manufacturers__chapter"><?php echo $firstLetter; ?></div>
                                <div class="manufacturers__content">
                    <?php
                                $currLetter = $firstLetter;
                            }

                            $logo = getManufacturerLogo($manufacturer);
                            if ($logo !== '') { ?>
                                <div class="manufacturers-item">
                                    <a class="manufacturers-item__link"
                                       href="<?php echo getManufacturerLink($manufacturer); ?>"
                                       title="Сертификаты <?php echo replaceQuotes($manufacturer); ?>"
                                    >
                                        <div class="manufacturers-item__thumb-title">
                                            <div class="manufacturers-item__thumb">
                                                <img src="<?php echo $site_url; ?>/logos/<?php echo $logo; ?>"
                                                     alt="Сертификаты <?php echo replaceQuotes($manufacturer); ?>">
                                            </div>
                                            <div class="manufacturers-item__title">
                                                <?php echo $manufacturer; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                        }
                    ?>
                    </div>
                </section>
            <?php } else {
                $args = array(
                    'posts_per_page' => 10,
                    'post_status' => 'publish',
                    'paged' => get_query_var('paged'),
                    'meta_query' => array(
                        'manufacturer' => array(
                            'key' => 'param6_manufacturer',
                            'value' => $manufacturerSearchString,
                            'compare' => 'LIKE'
                        )
                    ),
                    'orderby' => 'manufacturer',
                    'order' => 'ASC'
                );

                global $wp_query;
                $wp_query = new WP_Query($args);
                $postCount = $wp_query->found_posts;

                if ($postCount > 0) {
            ?>
                <section class="certificates">
                    <h2 class="title-section certificates__title ">
                        <?php
                            echo declination($postCount, ["Найден", "Найдено", "Найдено"])
                                . ' ' . $postCount
                                . ' ' . declination($postCount, ["результат", "результата", "результатов"]);
                        ?>
                    </h2>
                    <?php
                        $num = 0;
                        $manufacturerPrev = '';
                        $isOpened = false;

                        while ( $wp_query->have_posts() ) {
                            $wp_query->the_post();

                            $manufacturer =  mb_strtolower(getCleanName(getCertManufacturer(get_the_ID())));
                            if ($manufacturer != $manufacturerPrev) {
                                if ($isOpened) echo '</div>'; else $isOpened = true;

                                get_template_part( 'partials/manufacturer-data', null, ['postId' => get_the_ID()] );
                                $manufacturerPrev = $manufacturer;

                                echo '<div class="certificates__content">';
                            }

                            get_template_part( 'partials/certificates-item', null, ['postId' => get_the_ID()] );

                            if (++$num == 2 && !$isAuth) { ?>
                                <div class="content__ad">
                                    <?php echo getAdContent('horizontal.ad'); ?>
                                </div>
                            <?php }
                        }
                    ?>
                    </div>
                    <?php if (function_exists ('wp_page_numbers')) wp_page_numbers(); ?>
                </section>
            <?php } else { ?>
                <section class="certificates">
                    <h2 class="title-section certificates__title ">
                        <?php
                            $wp_query->set_404();
                            status_header( 404 );
                        ?>
                        Не удалось найти сертификаты изготовителя <?php echo $manufacturerSearchString; ?>
                    </h2>
                </section>
            <?php } ?>
        <?php } ?>
        </div>
        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </main>
</div>
<?php get_footer(); ?>