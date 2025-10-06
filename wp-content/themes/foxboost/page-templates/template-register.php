<?php
/*
Template Name: Register
*
* template-register.php
*
* Template file for register of certificates.
* /reestr-sertifikatov/
*
* @link        http://rostest-certify.ru/
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2024 asosintsev@yandex.ru
*/
?>
<?php get_header(); ?>
<?php
    $site_url         = site_url();
    $page_url         = get_page_uri();
    $base_url         = $site_url. '/' .$page_url;
    $template_url     = get_template_directory_uri();
    $isAuth           = isset($_SESSION['auth']);

    $validOrderby = ["title", "number"];
    $validOrder = ["asc", "desc"];

    $orderby = isset($_GET["orderby"]) && in_array(mb_strtolower($_GET["orderby"]), $validOrderby) ? mb_strtolower($_GET["orderby"]) : "title";
    $order = isset($_GET["order"]) && in_array(mb_strtolower($_GET["order"]), $validOrder) ? mb_strtolower($_GET["order"]) : "asc";
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php
                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => [
                    ['content' => 'Реестр сертификатов и деклараций соответствия']
                ]]);
            ?>
            <h1 class="hero__title">
                Реестр сертификатов и деклараций соответствия
            </h1>
            <?php get_template_part(
                'partials/search-item',
                null, [
                    'title'                => 'Поиск сертификата по номеру:',
                    'placeholder'          => 'Например, RU.СЩ04.B02830',
                    'placeholderDefault'   => 'Например, RU.СЩ04.B02830',
                    'action'               => $site_url. '/naiti-sertifikat-po-nomeru/',
                    'param'                => 'param'
                ]
            );
            ?>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <?php if (!$isAuth) { ?>
                <div class="content__ad">
                    <?php echo getAdContent('horizontal.ad'); ?>
                </div>
            <?php } ?>
            <div class="content__foreword">
                <p>Представлен реестр сертификатов ГОСТ Р, Таможенного союза, и Деклараций соответствия Таможенного союза, автоматически создаваемый на основе документов, представленных на данном сайте.</p>

                <p>При помощи этого реестра можно выполнить проверку сертификатов на подлинность онлайн, путем сравнения реквизитов сертификата с его графическим изображением. Сертификаты также доступны для посмотра и скачивания.</p>
            </div>
            <div class="certificates">
                <?php
                    $current_page = (get_query_var('paged') > 0) ? get_query_var('paged') : 1;

                    $params = array(
                        'posts_per_page'    => 20, // количество постов на странице
                        'post_type'         => 'post', // тип постов
                        'paged'             => $current_page, // текущая страница
                        'order'             => $order
                    );

                    if ($orderby == "title") {
                        $params['orderby'] = 'title';
                    } elseif ($orderby == "number") {
                        $params['orderby'] = 'meta_value';
                        $params['meta_key'] = 'param1_number';
                    }

                    query_posts($params);
                    $wp_query->is_archive = true;
			        $wp_query->is_home = false;

                    $numberLink = $base_url .'?orderby=number&order=desc';
                    $numberStyle = '';
                    $productLink = $base_url. '?orderby=title&order=asc';
                    $productStyle = '';

                    if (($orderby=="number") && ($order == "asc")) {
                        $numberLink = $base_url. '?orderby=number&order=desc';
                        $numberStyle = 'certificates-table__scroll_down';
                        $productLink = $base_url. '?orderby=title&order=asc';
                        $productStyle = '';
                    }

                    if (($orderby=="number") && ($order == "desc")) {
                        $numberLink = $base_url. '?orderby=number&order=asc';
                        $numberStyle = 'certificates-table__scroll_up';
                        $productLink = $base_url. '?orderby=title&order=asc';
                        $productStyle = '';
                    }

                    if (($orderby=="title") && ($order == "asc")) {
                        $numberLink = $base_url. '?orderby=number&order=asc';
                        $numberStyle = '';
                        $productLink = $base_url. '?orderby=title&order=desc';
                        $productStyle = ' certificates-table__scroll_down';
                    }

                    if (($orderby=="title") && ($order == "desc")) {
                        $numberLink = $base_url. '?orderby=number&order=asc';
                        $numberStyle = '';
                        $productLink = $base_url. '?orderby=title&order=asc';
                        $productStyle = ' certificates-table__scroll_up';
                    }
                ?>
                <div class="certificates-table">
                    <div class="certificates-table__cell certificates-table__cell_header">
                        <a class="certificates-table__link"
                           href="<?php echo $numberLink; ?>"
                           title="Сортировать по номеру сертификата">
                           № сертификата
                           <span class="certificates-table__scroll <?php echo $numberStyle; ?>"></span>
                        </a>
                    </div>
                    <div class="certificates-table__cell certificates-table__cell_header">
                        <a class="certificates-table__link"
                           href="<?php echo $productLink; ?>"
                           title="Сортировать по наименованию продукции">
                           Продукция
                            <span class="certificates-table__scroll <?php echo $productStyle; ?>"></span>
                        </a>
                    </div>
                    <div class="certificates-table__cell certificates-table__cell_header">
                        Срок действия
                    </div>
                    <?php
			            while(have_posts()): the_post();
                        $manufacturer = getCleanName(getCertManufacturer(get_the_ID()));
                    ?>
                        <div class="certificates-table__cell">
                            <div class="certificates-table__flag-number">
                                <span class="flag certificates-table__flag">
                                    <?php echo getCountryFlag(getCertNumber(get_the_ID())); ?>
                                </span>
                                <?php echo getCertNumber(get_the_ID()); ?>
                            </div>
                        </div>
                        <div class="certificates-table__cell">
                            <a class="certificates-table__link"
                               href="<?php the_permalink()?>"
                               title="Сертификат на <?php echo replaceQuotes(get_the_title()); ?>">
                                <?php echo mb_ucfirst(get_the_title()) ?>
                            </a>
                            <a class="certificates-table__link certificates-table__link_manufacturer"
                               href="<?php echo getManufacturerLink($manufacturer); ?>"
                               title="Другие сертификаты <?php echo replaceQuotes($manufacturer); ?>">
                                <?php echo $manufacturer; ?>
                            </a>
                        </div>
                        <div class="certificates-table__cell">
                            <?php echo getCertValidity(get_the_ID()); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php if (function_exists ('wp_page_numbers')) wp_page_numbers(); ?>
            </div>
            <?php if (/* !$isAuth */ false) { ?>
                <div class="content__ad">
                    <?php echo getAdContent(''); ?>
                </div>
            <?php } ?>
        </div>
        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </main>
</div>
<?php get_footer(); ?>