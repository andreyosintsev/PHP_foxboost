<!--rostest-->
<?php
/**
 * header.php
 *
 * This file controls the HTML <head> and top graphical markup (including
 * Navigation) for each page in your theme. Displays all of the <head> 
 * section and everything up till <div class="wrapper">
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php
    if (is_single() || is_archive() || is_category() || is_home() || is_page() || is_search()) session_start();


    $site_url       = site_url();
    $template_url   = get_template_directory_uri();

    $search_num = $_GET['param'] ?? '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name='yandex-verification' content='5034b468f638d5d4'>
	<meta name="yandex-verification" content="b0dd183a09ff4e68">

	<!--OpenGraph-->
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:logo" content="<?php echo $template_url; ?>/images/logo.svg" />

	<?php if (is_single()) {?>
	    <?php
	        $og_number        	= getCertNumber($post->ID);
	        $og_product      	= getCertProduct($post->ID);
	        $og_product    		= str_replace(array("\""), "", $og_product);
	        $og_product         = mb_substr($og_product, 0, 107 - mb_strlen($og_number));
	    ?>

	    <meta property="og:title" 		 content="Скачать сертификат на <?php echo get_the_title(); ?>">
	    <meta property="og:description"  content="Сертификат соответствия № <?php echo $og_number; ?> на <?php echo $og_product; ?>...">
	    <meta property="og:image" 		 content="<?php echo getThumbnail(367, 525, $post->ID) ?>">
	    <meta property="og:image:width"  content="367">
	    <meta property="og:image:height" content="525">
	    <meta property="og:type"		 content="article">
	    <meta property="og:url"			 content="<?php echo get_permalink(); ?>">
	    <meta property="og:locale"		 content="ru_RU">
	<?php } ?>
    <!--/OpenGraph-->


	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $site_url; ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $site_url; ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $site_url; ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $site_url; ?>/site.webmanifest">

    <!--Новые стили-->

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/common/normalize.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/common/consts.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/menu-main.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/menu-mobile.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/button.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/search-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/flag.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/sidebar-stats.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/sidebar-countries.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/sidebar-certificates.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/footer.css">

    <?php if (is_home()) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-more.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/manufacturers-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/agencies-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/norms-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/home.css">

    <?php } ?>
    <?php if (is_category() || is_tag()) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-more.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/manufacturers-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/agencies-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/norms-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/archive.css">

    <?php } ?>
    <?php if (is_page('naiti-sertifikat-po-nomeru')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/naiti-sertifikat-po-nomeru.css">

    <?php } ?>
    <?php if (is_page('naiti-sertifikat-po-vidu-produktsii')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/products-list.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/naiti-sertifikat-po-vidu-produktsii.css">

    <?php } ?>
    <?php if (is_page('kompanii')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/manufacturers-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/manufacturers-data.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/kompanii.css">

    <?php } ?>
    <?php if (is_page('reestr-sertifikatov')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-table.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/reestr-sertifikatov.css">

    <?php } ?>
    <?php if (is_page('organy-po-sertifikacii')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/agencies-table.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/agencies-data.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-table.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/organy-po-sertifikacii.css">

    <?php } ?>
    <?php if (is_page('gosty')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/norms-data.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/norms-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/gosty.css">

    <?php } ?>
    <?php if (is_page('o-sajte')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/norms-data.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/norms-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/o-sajte.css">

    <?php } ?>
    <?php if (is_page('debug')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/debug.css">

    <?php } ?>
    <?php if (is_page('policy')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/policy.css">

    <?php } ?>
    <?php if (is_page('panel')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-table.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/panel.css">

    <?php } ?>
    <?php if (is_page('task')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-table.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/task.css">

    <?php } ?>
    <?php if (is_page('add')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/add.css">

    <?php } ?>
    <?php if (is_page('certificate-added')) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/certificate-added.css">

    <?php } ?>
    <?php if (is_single()) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/specs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/tags.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-more.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/preloader.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/modal.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/single.css">

    <?php } ?>
    <?php if (is_search()) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/products-list.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/search.css">

    <?php } ?>
    <?php if (is_404()) { ?>

        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/breadcrumbs.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-section.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/certificates-item.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wp-page-numbers.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title-more.css">
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/404.css">

    <?php } ?>

    <!--/Новые стили-->

    <!--Cтили и скрипты шаблона-->
	<?php wp_head(); ?>
    <!--/Cтили и скрипты шаблона-->

    <!--Старые скрипты-->
	<?php if (is_page('addnew')) { ?>
		<script type="text/javascript" src="<?php echo $template_url; ?>/js/addswitch.js"></script>
		<script type="text/javascript" src="<?php echo $template_url; ?>/js/check.js"></script>
	    <script type="text/javascript" src="<?php echo $site_url ?>/tesseract/tesseract.js"></script>
	    <script type="text/javascript" src="<?php echo $template_url; ?>/js/ocr.js"></script>
	<?php } ?>

    <!--/Старые скрипты-->

    <!--Новые скрипты-->
    <script src="<?php echo $template_url; ?>/scripts/lib/jquery-3.6.0.min.js"></script>
    <script src="<?php echo $template_url; ?>/scripts/menu-mobile.js"></script>

    <?php if (is_page('naiti-sertifikat-po-vidu-produktsii')) { ?>
        <script type="text/javascript" src="<?php echo $template_url; ?>/scripts/products-list.js"></script>
    <?php } ?>
    <?php if (is_page('organy-po-sertifikacii')) { ?>
        <script type="text/javascript" src="<?php echo $template_url; ?>/scripts/agencies-table.js"></script>
    <?php } ?>
    <?php if (is_page('add')) { ?>
        <script type="text/javascript" src="<?php echo $template_url; ?>/scripts/add.js"></script>
        <script type="text/javascript" src="<?php echo $site_url;?>/tesseract/tesseract.js"></script>
        <script type="text/javascript" src="<?php echo $template_url; ?>/scripts/ocr.js"></script>
    <?php } ?>
    <?php if (is_single()) { ?>
        <script type="text/javascript" src="<?php echo $template_url; ?>/scripts/register.js"></script>
        <script type="text/javascript" src="<?php echo $template_url; ?>/scripts/modal.js"></script>
        <script type="text/javascript" src="<?php echo $template_url; ?>/scripts/disable-right-button.js"></script>
    <?php } ?>
    <!--/Новые скрипты-->

	<!--Yandex.RTB -->
    <script>window.yaContextCb=window.yaContextCb||[]</script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>
    <!--/Yandex.RTB -->
</head>
<body>
<div class="overlay"></div>
<div class="menu-mobile">
    <ul class="menu-mobile__items">
        <li class="menu-mobile__item">
            <a class="menu-mobile__link" href="<?php echo $site_url ?>/naiti-sertifikat-po-nomeru/" title="Найти сертификат по номеру">
                Поиск по номеру
            </a>
        </li>
        <li class="menu-mobile__item">
            <a class="menu-mobile__link" href="<?php echo $site_url ?>/naiti-sertifikat-po-vidu-produktsii/" title="Найти сертификат по виду продукции">
                Продукция
            </a>
        </li>
        <li class="menu-mobile__item">
            <a class="menu-mobile__link" href="<?php echo $site_url ?>/kompanii/" title="Найти сертификат по изготовителю">
                Изготовители
            </a>
        </li>
        <li class="menu-mobile__item">
            <a class="menu-mobile__link" href="<?php echo $site_url ?>/reestr-sertifikatov/" title="Реестр сертификатов и деклараций соответствия">
                Реестр сертификатов
            </a>
        </li>
        <li class="menu-mobile__item">
            <a class="menu-mobile__link" href="<?php echo $site_url ?>/organy-po-sertifikacii/" title="Органы по сертификации">
                Органы по сертификации
            </a>
        </li>
        <li class="menu-mobile__item">
            <a class="menu-mobile__link" href="<?php echo $site_url ?>/gosty/" title="ГОСТы и ТР на материалы, товары, продукцию и услуги">
                ГОСТы
            </a>
        </li>
        <li class="menu-mobile__item">
            <a class="menu-mobile__link" href="<?php echo $site_url ?>/o-sajte/" title="О сайте">
                О сайте
            </a>
        </li>
    </ul>
</div>
<header class="nav-top">
    <div class="logo">
        <a class="logo__link" href="<?php echo $site_url; ?>" title="<?php bloginfo('name');?>">
            <img class="logo__image" src="<?php echo $template_url; ?>/images/logo.svg" alt="<?php echo $site_url ?>">
        </a>
    </div>
    <?php
        $search_string = empty($search_num)
            ? "Поиск по номеру сертификата"
            : $search_num;
    ?>
    <form class="search search_collapseable" action="<?php echo $site_url; ?>/naiti-sertifikat-po-nomeru" method="get">
        <input class="search__input" name="param" placeholder="<?php echo $search_string; ?>">
        <button class="search__magnifier" type="submit"></button>
    </form>
    <nav class="menu-main menu-main_collapseable">
        <ul class="menu-main__items">
            <li class="menu-main__item">
                <a href="<?php echo $site_url ?>/naiti-sertifikat-po-nomeru/" title="Найти сертификат по номеру">
                    Поиск по номеру
                </a>
            </li>
            <li class="menu-main__item">
                <a href="<?php echo $site_url ?>/naiti-sertifikat-po-vidu-produktsii/" title="Найти сертификат по виду продукции">
                    Продукция
                </a>
            </li>
            <li class="menu-main__item">
                <a href="<?php echo $site_url ?>/kompanii/" title="Найти сертификат по изготовителю">
                    Изготовители
                </a>
            </li>
            <li class="menu-main__item">
                <a href="<?php echo $site_url ?>/reestr-sertifikatov/" title="Реестр сертификатов и деклараций соответствия">
                    Реестр сертификатов
                </a>
            </li>
            <li class="menu-main__item">
                <a href="<?php echo $site_url ?>/organy-po-sertifikacii/" title="Органы по сертификации">
                    Органы
                </a>
            </li>
            <li class="menu-main__item">
                <a href="<?php echo $site_url ?>/gosty/" title="ГОСТы на материалы, товары, продукцию и услуги">
                    ГОСТы
                </a>
            </li>
            <li class="menu-main__item">
                <a href="<?php echo $site_url ?>/o-sajte/" title="О сайте">
                    О сайте
                </a>
            </li>
        </ul>
        <div class="menu-mobile-search-button">
            <div class="menu-mobile-search-button__button"></div>
        </div>
    </nav>
</header>