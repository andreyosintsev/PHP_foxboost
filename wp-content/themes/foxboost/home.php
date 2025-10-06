<?php
/**
 * home.php
 *
 * The home template file.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php
    $site_url       = site_url();
    $template_url   = get_template_directory_uri();

    $search_num = $_GET['param'] ?? '';
    $isAuth         = isset($_SESSION['auth']);
?>
<?php get_header(); ?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <h1 class="hero__title">
                Сертификаты соответствия
            </h1>
            <h2 class="hero__subtitle">
                Сертификаты ГОСТ Р, ТС и декларации соответствия
            </h2>
            <div class="search-item">
                <div class="search-item__title">
                    Поиск сертификата по названию продукции:
                </div>
                <form class="search-item__form" method="get">
                    <div class="search-item__magnifier-input">
                        <div class="search-item__magnifier"></div>
                        <input class="search-item__input" type="text" name="s" id="s" placeholder="Например, средства индивидуальной защиты">
                    </div>
                    <button class="button search-item__button" type="submit">Поиск</button>
                </form>
            </div>
        </div>
        <div class="hero__image">
            <img src="<?php echo $template_url;?>/images/header.png" alt="Сертификаты соответствия">
        </div>
    </div>
    <main class="main">
        <div class="content">
            <?php if (!$isAuth) { ?>
                <div class="content__ad">
                    <?php echo getAdContent('home.ad'); ?>
                </div>
            <?php } ?>
            <section class="certificates">
                <div class="title-more certificates__title">
                    <a href="<?php echo $site_url ?>/reestr-sertifikatov/" class="title-more__link" title="Реестр сертификатов и деклараций соответствия">
                        <h2 class="title-more__title">
                            Сертификаты на продукцию
                        </h2>
                        <div class="title-more__more">
                            См.&nbsp;все
                        </div>
                    </a>
                </div>
                <div class="certificates__content">
                    <?php
                        global $query_string;
                        $posts_list = get_posts($query_string.'&numberposts=3&order=DSC&orderby=date');

                        foreach ($posts_list as $post) {
                            setup_postdata($post);
                            get_template_part('partials/certificates-item', null, ['postId' => $post->ID]);
                        }
                    ?>
                </div>
            </section>
            <section class="manufacturers">
                <div class="title-more manufacturers__title">
                    <a href="<?php echo $site_url ?>/kompanii/" class="title-more__link" title="Поиск по изготовителю">
                        <h2 class="title-more__title">
                            Изготовители
                        </h2>
                        <div class="title-more__more">
                            См.&nbsp;все
                        </div>
                    </a>
                </div>
                <div class="manufacturers__content">
                    <?php
                        $manufacturers = getAllManufacturers(6);
                        foreach ($manufacturers as $manufacturer => $freq) {
                            $manufacturerLink = getManufacturerLink($manufacturer);
                            $manufacturerLogo = getManufacturerLogo($manufacturer);
                            $manufacturerDesc = getManufacturerFull($manufacturer);
                    ?>
                        <div class="manufacturers-item">
                            <a class="manufacturers-item__link" href="<?php echo $manufacturerLink; ?>" title="Сертификаты <?php echo replaceQuotes($manufacturer); ?>">
                                <div class="manufacturers-item__thumb-title">
                                    <div class="manufacturers-item__thumb">
                                        <img src="<?php echo $site_url; ?>/logos/<?php echo $manufacturerLogo; ?>" alt="Сертификаты <?php echo replaceQuotes($manufacturer); ?>">
                                    </div>
                                    <div class="manufacturers-item__title">
                                        <?php echo $manufacturer; ?>
                                    </div>
                                </div>
                            </a>
                            <div class="manufacturers-item__description">
                                Изготовитель: <?php echo $manufacturerDesc; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <section class="agencies">
                <div class="title-more agencies__title">
                    <a href="<?php echo $site_url ?>/organy-po-sertifikacii/" class="title-more__link" title="Органы по сертификации">
                        <h2 class="title-more__title">
                            Органы по сертификации
                        </h2>
                        <div class="title-more__more">
                            См.&nbsp;все
                        </div>
                    </a>
                </div>
                <div class="agencies__content">
                    <?php
                    $agencies = getAllAgencies(4);
                    foreach ($agencies as $agency => $freq) {
                        $agencyLink = getAgencyLink($agency);
                        $agencyDesc = getAgencyFull($agency);
                    ?>
                        <div class="agencies-item">
                            <a class="agencies-item__link" href="<?php echo $agencyLink; ?>" title="Ceртификаты, выданные <?php echo replaceQuotes($agency); ?>">
                                <div class="agencies-item__title">
                                    <?php echo $agency; ?>
                                </div>
                            </a>
                            <div class="agencies-item__description">
                                <?php echo $agencyDesc; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <section class="norms">
                <div class="title-more norms__title">
                    <a href="<?php echo $site_url ?>/gosty/" class="title-more__link" title="ГОСТы и ТР на материалы, товары, продукцию и услуги">
                        <h2 class="title-more__title">
                            ГОСТы и ТР
                        </h2>
                        <div class="title-more__more">
                            См.&nbsp;все
                        </div>
                    </a>
                </div>
                <div class="norms__content">
                    <?php
                        $norms = getAllNorms(4);
                        foreach ($norms as $norm) {
                            get_template_part( 'partials/norms-item', null, ['norm' => $norm] );
                        }
                    ?>
                </div>
            </section>
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