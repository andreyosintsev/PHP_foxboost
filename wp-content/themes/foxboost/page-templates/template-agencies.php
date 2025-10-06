<?php
/*
Template Name: Agencies
*
* template-agencies.php
*
* Template file for searching by certification agencies and results.
* /organy-po-sertifikacii/
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
    $agencySearchString  = $_GET['agency'];
    $isAuth              = isset($_SESSION['auth']);

    if (isset($_GET['param'])) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ". $base_url .'/?agency='. $_GET['param']);
        exit();
    }

    $agenciesNums = getAllAgenciesNum();

    $validOrderby = ["title", "number", "city"];
    $validOrder   = ["asc", "desc"];

    $orderby = isset($_GET["orderby"]) && in_array(mb_strtolower($_GET["orderby"]), $validOrderby) ? mb_strtolower($_GET["orderby"]) : "number";
    $order   = isset($_GET["order"]) && in_array(mb_strtolower($_GET["order"]), $validOrder) ? mb_strtolower($_GET["order"]) : "asc";
    $st      = isset($_GET["st"]) && is_numeric($_GET["st"]) && $_GET["st"] >= 0 && $_GET["st"] < count($agenciesNums) ? (int)$_GET["st"] : 0;
    $len     = isset($_GET["len"]) && is_numeric($_GET["len"]) && $_GET["len"] >= 0 ? (int)$_GET["len"] : 20;
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php 
                $breadcrumbs = [];
                if (!empty($agencySearchString)) {
                    $breadcrumbs[] = [
                      "href" => $page_url,
                      "title" => "Поиск по органу по сертификации",
                      "content" => "Реестр органов по сертификации"
                    ];
                } else {
                    $breadcrumbs[] = [
                      "content" => "Реестр органов по сертификации",
                    ];
                }

                if (!empty($agencySearchString)) {
                    $breadcrumbs[] = [
                        "content" => $agencySearchString
                    ];
                };

                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => $breadcrumbs]);
            ?>
            <h1 class="hero__title">
                <?php
                if (empty($agencySearchString)) { ?>
                    Реестр органов по сертификации
                <?php } else { ?>
                    Сертификаты выданные <?php echo $agencySearchString; ?>
                <?php } ?>
            </h1>
            <?php get_template_part(
                'partials/search-item',
                null, [
                    'title'                => 'Поиск органа по сертификации по названию:',
                    'placeholder'          => $agencySearchString,
                    'placeholderDefault'   => 'Например, РОСТЕСТ-Москва',
                    'action'               => $site_url. '/' . get_page_uri(),
                    'param'                => 'agency'
                ]
            );
            ?>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <?php if ($agencySearchString == '') { ?>
                <?php if (!$isAuth) { ?>
                    <div class="content__ad">
                        <?php echo getAdContent('horizontal.ad'); ?>
                    </div>
                <?php } ?>
                <div class="content__foreword">
                    <p>Представлен реестр органов по сертификации и испытательных лабораторий (центров) Таможенного союза, осуществляющих оценку соответствия продукции, включенной в Единый перечень продукции и требованиям Технических регламентов Таможенного союза.</p>
                </div>
                <div class="agencies">
                    <?php
                        $numberLink = $base_url .'?orderby=number&order=desc';
                        $numberStyle = '';
                        $titleLink = $base_url .'?orderby=title&order=asc';
                        $titleStyle = '';
                        $cityLink = $base_url. '?orderby=city&order=asc';
                        $cityStyle = '';

                        if (($orderby=="number") && ($order == "asc")) {
                            $numberLink = $base_url .'?orderby=number&order=desc';
                            $numberStyle = ' certificates-table__scroll_down';
                            $titleLink = $base_url .'?orderby=title&order=asc';
                            $titleStyle = '';
                            $cityLink = $base_url. '?orderby=city&order=asc';
                            $cityStyle = '';
                        }

                        if (($orderby=="number") && ($order == "desc")) {
                            $numberLink = $base_url .'?orderby=number&order=asc';
                            $numberStyle = ' certificates-table__scroll_up';
                            $titleLink = $base_url .'?orderby=title&order=asc';
                            $titleStyle = '';
                            $cityLink = $base_url. '?orderby=city&order=asc';
                            $cityStyle = '';
                        }

                        if (($orderby=="title") && ($order == "asc")) {
                            $numberLink = $base_url .'?orderby=number&order=asc';
                            $numberStyle = '';
                            $titleLink = $base_url .'?orderby=title&order=desc';
                            $titleStyle = ' certificates-table__scroll_down';
                            $cityLink = $base_url. '?orderby=city&order=asc';
                            $cityStyle = '';
                        }

                        if (($orderby=="title") && ($order == "desc")) {
                            $numberLink = $base_url .'?orderby=number&order=asc';
                            $numberStyle = '';
                            $titleLink = $base_url .'?orderby=title&order=asc';
                            $titleStyle = ' certificates-table__scroll_up';
                            $cityLink = $base_url. '?orderby=city&order=asc';
                            $cityStyle = '';
                        }

                        if (($orderby=="city") && ($order == "asc")) {
                            $numberLink = $base_url .'?orderby=number&order=asc';
                            $numberStyle = '';
                            $titleLink = $base_url .'?orderby=title&order=asc';
                            $titleStyle = '';
                            $cityLink = $base_url. '?orderby=city&order=desc';
                            $cityStyle = ' certificates-table__scroll_down';
                        }

                        if (($orderby=="city") && ($order == "desc")) {
                            $numberLink = $base_url .'?orderby=number&order=asc';
                            $numberStyle = '';
                            $titleLink = $base_url .'?orderby=title&order=asc';
                            $titleStyle = '';
                            $cityLink = $base_url. '?orderby=city&order=asc';
                            $cityStyle = ' certificates-table__scroll_up';
                        }
                    ?>
                    <div class="agencies-table">
                        <div class="agencies-table__cell agencies-table__cell_header">
                            <a class="agencies-table__link"
                               href="<?php echo $numberLink; ?>"
                               title="Сортировать по регистрационному номеру органа по сертификации">
                               Рег. №
                               <span class="agencies-table__scroll <?php echo $numberStyle; ?>"></span>
                            </a>
                        </div>
                        <div class="agencies-table__cell agencies-table__cell_header">
                            <a class="agencies-table__link"
                               href="<?php echo $titleLink; ?>"
                               title="Сортировать по наименованию органа по сертификации">
                               Наименование органа
                               <span class="agencies-table__scroll <?php echo $titleStyle; ?>"></span>
                            </a>
                        </div>
                        <div class="agencies-table__cell agencies-table__cell_header agencies-table__cell_city">
                            <a class="agencies-table__link"
                               href="<?php echo $cityLink; ?>"
                               title="Сортировать по городу органа по сертификации">
                               Город
                               <span class="agencies-table__scroll <?php echo $cityStyle; ?>"></span>
                            </a>
                        </div>

                        <?php
                            $agenciesNums = getAllAgenciesNum();
                            $agenciesNames = getAllAgenciesNames();
                            $agenciesCities = getAllAgenciesCities();
                            $agenciesLinks = getAllAgenciesLinks();

                            if ($orderby == "number") {
                                if ($order == "asc") {
                                    ksort($agenciesNums);
                                } elseif ($order == "desc") {
                                    krsort($agenciesNums);
                                }
                            }

                            if ($orderby == "title") {
                                if ($order == "asc") {
                                    asort($agenciesNames);
                                } elseif ($order == "desc") {
                                    arsort($agenciesNames);
                                }
                            }

                            if ($orderby == "city") {
                                if ($order == "asc") {
                                    asort($agenciesCities);
                                } elseif ($order == "desc") {
                                    arsort($agenciesCities);
                                }
                            }

                            $num = 0;

                            if ($orderby == "number") {
                                foreach ($agenciesNums as $regnum => $agency) {
                                    if ($agenciesNames[$regnum] == '') continue;
                                    if ($num < $st) {
                                        ++$num;
                                        continue;
                                    }
                                    if ($num >= $st + $len) break;

                                    get_template_part( 'partials/agencies-row', null,
                                        [
                                            'regnum' => $regnum,
                                            'name' => $agenciesNames[$regnum],
                                            'link' => getAgencyLink($agenciesNames[$regnum]),
                                            'city' => $agenciesCities[$regnum],
                                            'info' => getAgencyInfoByReg($regnum),
                                            'url' => $agenciesLinks[$regnum]
                                        ]
                                    );

                                    ++$num;
                                }
                            }

                            if ($orderby == "title") {
                                foreach ($agenciesNames as $regnum => $agencyName) {
                                    if (!$agencyName) continue;
                                    if ($num < $st) {
                                        ++$num;
                                        continue;
                                    }
                                    if ($num >= $st + $len) break;

                                    get_template_part( 'partials/agencies-row', null,
                                        [
                                            'regnum' => $regnum,
                                            'name' => $agenciesNames[$regnum],
                                            'link' => getAgencyLink($agenciesNames[$regnum]),
                                            'city' => $agenciesCities[$regnum],
                                            'info' => getAgencyInfoByReg($regnum),
                                            'url' => $agenciesLinks[$regnum]
                                        ]
                                    );

                                    ++$num;
                                }
                            }

                            if ($orderby == "city") {
                                foreach ($agenciesCities as $regnum => $cityName) {
                                    if ($num < $st) {
                                        ++$num;
                                        continue;
                                    }
                                    if ($num >= $st + $len) break;

                                    get_template_part( 'partials/agencies-row', null,
                                        [
                                            'regnum' => $regnum,
                                            'name' => $agenciesNames[$regnum],
                                            'link' => getAgencyLink($agenciesNames[$regnum]),
                                            'city' => $agenciesCities[$regnum],
                                            'info' => getAgencyInfoByReg($regnum),
                                            'url' => $agenciesLinks[$regnum]
                                        ]
                                    );

                                    ++$num;
                                }
                            }
                        ?>
                    </div>
                    <div class="certificates__nav" id='wp_page_numbers'>
                        <?php
                            $pagination = calculatePagination(count($agenciesNums), $st, $len);
                        ?>
                        <ul>
                            <li class="page_info">Стр. 1 из <?php echo $pagination['totalPages']; ?></li>
                            <?php
                                if ($pagination['currentPage'] > 1) { ?>
                                    <li>
                                        <a href="<?php echo $base_url; ?>?orderby=<?php echo $orderby; ?>&order=<?php echo $order; ?>&st=<?php echo ($pagination['currentPage'] - 2) * $len; ?>"><</a>
                                    </li>
                            <?php }
                                for ($page = $pagination['pages'][0]; $page <= $pagination['pages'][2]; $page++) {
                            ?>
                                <li <?php echo $page == $pagination['currentPage'] ? 'class="active_page"' : '' ?>>
                                    <a href="<?php echo $base_url; ?>?orderby=<?php echo $orderby; ?>&order=<?php echo $order; ?>&st=<?php echo ($page - 1) * $len; ?>"><?php echo $page; ?></a>
                                </li>
                            <?php }
                            if ($pagination['currentPage'] < $pagination['totalPages']) { ?>
                            <li>
                                <a href="<?php echo $base_url; ?>?orderby=<?php echo $orderby; ?>&order=<?php echo $order; ?>&st=<?php echo $pagination['currentPage'] * $len; ?>">></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } else {

                $args = array(
					'posts_per_page' => 10,
					'post_status' => 'publish',
					'paged' =>get_query_var('paged'),
					'meta_query' => array(
						'agency' => array(
			            	'key' => 'param3_certification_agency',
			            	'value' => $agencySearchString,
			            	'compare' => 'LIKE'
			            )
			        ),
			        'orderby' => array( 'agency' => 'ASC',  'title' => 'ASC' )
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
                $agencyPrev = '';
                $isOpened = false;

                while ( $wp_query->have_posts() ) {
                    $wp_query->the_post();

                    $agency =  mb_strtolower(getCleanName(getCertAgency(get_the_ID())));
                    if ($agency != $agencyPrev) {
                        if ($isOpened) echo '</div>'; else $isOpened = true;

                        get_template_part( 'partials/agency-data', null, ['postId' => get_the_ID()] );
                        $agencyPrev = $agency;

                        echo '<div class="certificates__content">';
                    }

                    get_template_part( 'partials/certificates-item', null, ['postId' => get_the_ID()] );

                    if (++$num == 2 && !$isAuth) { ?>
                        <div class="content__ad"></div>
                    <?php }
                }
                ?>
                </div>
                <?php if (function_exists ('wp_page_numbers')) wp_page_numbers(); ?>
            </section>
            <?php if (/* !$isAuth */ false) { ?>
                <div class="content__ad"></div>
            <?php } ?>
                <?php } else { ?>
                    <section class="certificates">
                        <h2 class="title-section certificates__title ">
                            <?php
                                $wp_query->set_404();
                                status_header( 404 );
                            ?>
                            Не удалось найти сертификаты выданные <?php echo $agencySearchString; ?>
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
