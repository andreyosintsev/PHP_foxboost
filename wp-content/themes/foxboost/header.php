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

    $search_name = $_GET['search'] ?? '';

    $categories = get_categories( array(
        'taxonomy'     => 'category',
        'hide_empty'   => false,
        'parent'       => 0,
        'orderby'      => 'name',
        'order'        => 'ASC',
    ) );

    $current_cat_id = get_queried_object_id();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--OpenGraph-->
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:logo" content="<?php echo $template_url; ?>/images/logo.svg" />

    <!--OpenGraph для single пока не используется. НАСТРОИТЬ ПОЗЖЕ!
	<?php if (is_single() && false) {?>
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


    <!--Foxboost - будь в числе первых обладателей новинок-->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

    <!--Favicons-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $site_url; ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $site_url; ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $site_url; ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $site_url; ?>/site.webmanifest">

    <!--Общие стили-->
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/common/normalize.css">
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/common/consts.css">
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/common/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/common/owl.theme.default.min.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/wrapper.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/logo.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/input.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/input-search.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/link.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/button-menu-mobile.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/menu-main.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/header.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/menu-mobile.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/motto.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/card-stats.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/panel-stats.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/section-logo.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/slider-hero.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/button.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/card-foxboost.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/section-foxboost.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/title.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/card-ambassador.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/section-ambassador.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/textarea.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/contacts.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/back-to-top.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/footer.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/overlay.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/loader.css" />
    <link rel="stylesheet" href="<?php echo $template_url;?>/css/blocks/popup.css" />

    <!--Постраничные стили-->
    <?php if (is_home()) { ?>
        <link rel="stylesheet" href="<?php echo $template_url;?>/css/pages/index.css" />
    <?php } ?>


    <?php if (false): ?>
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
    <?php endif; ?>

    <!--Cтили и скрипты шаблона-->
	<?php wp_head(); ?>
    <!--/Cтили и скрипты шаблона-->

    <!--Общие скрипты-->
    <script src="<?php echo $template_url; ?>/scripts/util/jquery-3.7.1.min.js"></script>
    <script src="<?php echo $template_url; ?>/scripts/util/owl.carousel.min.js"></script>
    <script src="<?php echo $template_url; ?>/scripts/menu-mobile.js"></script>
    <script src="<?php echo $template_url; ?>/scripts/back-to-top.js"></script>
    <script src="<?php echo $template_url; ?>/scripts/popup.js" type="module"></script>
    <script src="<?php echo $template_url; ?>/scripts/popup-subscribe.js" type="module"></script>

    <!--Постраничные скрипты-->
    <?php if (is_home()) { ?>
        <script src="<?php echo $template_url; ?>/scripts/slider-hero.js"></script>
        <script src="<?php echo $template_url; ?>/scripts/section-foxboost.js"></script>
        <script src="<?php echo $template_url; ?>/scripts/section-ambassador.js"></script>
    <?php } ?>
    
</head>
<body>
<div class="hero">
    <header class="header">
        <div class="header__top">
            <div class="logo header__logo">
                <a class="logo__link" href="<?php echo $site_url; ?>" title="<?php bloginfo('name');?>">
                    <picture>
                        <source srcset="<?php echo $template_url; ?>/images/logo-mobile.svg" media="(max-width: 768px)" />
                        <img class="logo__image" src="<?php echo $template_url; ?>/images/logo.svg" alt="На главную страницу" />
                    </picture>
                </a>
            </div>
            <?php
            $search_string = empty($search_name)
                ? "Поиск по названию"
                : $search_name;
            echo '<!-- SEARCH STRING: ' .$search_string. '-->';
            ?>
            <div class="input-search header__search">
                <form class="input-search__form" action="<?php echo $site_url; ?>/search" method="get">
                    <input class="input input-search__input" type="text" placeholder="<?php echo $search_string; ?>" />
                </form>
                <svg class="input-search__icon" viewBox="0 0 25 24">
                    <path
                            d="M22.7521 2.22438C21.3175 0.789641 19.4109 0 17.3819 0C15.3534 0 13.4461 0.789832 12.0116 2.22438C9.40658 4.82919 9.09461 8.87102 11.0726 11.8219L10.9319 11.9623C10.5389 12.3559 10.4361 12.9313 10.6232 13.4214L9.20121 14.8432L9.0376 14.68C8.96571 14.6081 8.85072 14.6062 8.77636 14.676L1.37917 21.6334C0.837803 22.175 0.837803 23.056 1.37917 23.5973C1.64175 23.8597 1.98994 24.0044 2.36121 24.0044C2.73172 24.0044 3.0803 23.8597 3.34669 23.5933L10.3007 16.2001C10.3699 16.1261 10.3682 16.0104 10.2967 15.9389L10.1329 15.7753L11.5551 14.3537C11.7126 14.4136 11.8789 14.445 12.0449 14.445C12.396 14.445 12.7471 14.3119 13.014 14.0446L13.153 13.9054C14.3937 14.7406 15.853 15.1897 17.3819 15.1897C19.4109 15.1897 21.3176 14.3995 22.7521 12.9651C25.7135 10.0037 25.7135 5.18539 22.7521 2.22438ZM21.4282 11.6406C20.3473 12.7208 18.9103 13.3163 17.3819 13.3163C15.8534 13.3163 14.4163 12.7208 13.3359 11.6406C11.1049 9.4099 11.1049 5.77958 13.3359 3.54852C14.4163 2.46751 15.8534 1.87275 17.3823 1.87275C18.9107 1.87275 20.3477 2.46751 21.4282 3.54814C23.6594 5.77881 23.6594 9.40914 21.4282 11.6406Z"
                            fill="#666666"
                    />
                </svg>
            </div>
            <a href="#" class="link header__about link_special">Как это работает</a>
            <div class="button-menu-mobile">
                <svg aria-hidden="true" focusable="false" role="presentation" class="button-menu-mobile__icon" viewBox="0 0 25 25">
                    <path class="button-menu-mobile__icon-line1" d="M0 4h28">.</path>
                    <path class="button-menu-mobile__icon-line2" d="M0 14h28">.</path>
                    <path class="button-menu-mobile__icon-line3" d="M0 24h28">.</path>
                </svg>
            </div>
        </div>
        <nav class="menu-main header__menu-main" aria-label="Главное меню">
            <?php
                if ( ! empty( $categories ) ) {
            ?>
            <ul class="menu-main__items">
                <?php foreach($categories as $category) {
                    $link = get_category_link($category->term_id);
                    $class_current = ($category->term_id === $current_cat_id) ? ' menu-main__item_current' : '';

                    echo '<li class="menu-main__item"' . $class_current. '>
                                <a class="menu-main__link" 
                                    href="' .esc_url( $link ). '" 
                                    title="' . esc_html( $category->name ) . '" 
                                    aria-label="' . esc_html( $category->name ) . '">' .
                                    esc_html( $category->name ).'
                                </a>
                         </li>';
                }?>
            </ul>
            <?php } ?>
        </nav>
    </header>
    <div class="menu-mobile invisible">
        <div class="menu-mobile__title">
            <div class="logo menu-mobile__logo">
                <a class="logo__link" href="<?php echo $site_url; ?>" title="<?php bloginfo('name');?>">
                    <img class="logo__image" src="<?php echo $template_url; ?>/images/logo.svg" alt="FoxGear Logo" />
                </a>
            </div>
        </div>
        <ul class="menu-mobile__items">
            <?php
            if ( ! empty( $categories ) ) {
                 foreach($categories as $category) {
                        $link = get_category_link($category->term_id);
                        $class_current = ($category->term_id === $current_cat_id) ? ' menu-mobile__link_strong' : '';

                        echo '<li class="menu-mobile__item"' . $class_current. '>
                                    <a class="link menu-mobile__link"' . $class_current. '
                                        href="' .esc_url( $link ). '" 
                                        title="' . esc_html( $category->name ) . '" 
                                        aria-label="' . esc_html( $category->name ) . '">' .
                                        esc_html( $category->name ).'
                                    </a>
                             </li>';
                    }
            } ?>
            <li class="menu-mobile__item">
                <a class="link menu-mobile__link menu-mobile__link_strong" href="#" title="О Фоксбусте">Как это работает</a>
            </li>
            <li class="menu-mobile__item">
                <a class="link menu-mobile__link" href="#" title="Контакты">Контакты</a>
            </li>
            <li class="menu-mobile__item">
                <a class="link menu-mobile__link" href="#" title="Написать сообщение">Обратная связь</a>
            </li>
        </ul>
    </div>
</div>