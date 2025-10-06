<?php
/**
 * search.php
 *
 * The template for displaying Search Results pages.
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
    $template_url     = get_template_directory_uri();
    $searchQuery      = get_search_query();
    $isAuth           = isset($_SESSION['auth']);

    //Если вместо наименования продукта ввели номер сертификата
    //перейти на страницу поиска по номеру сертификата
    $searchLen = mb_strlen($searchQuery);
    if ($searchLen >= 5) {
        $searchStr = mb_substr($searchQuery, $searchLen - 5);
        $searchStr2 = mb_substr($searchQuery, $searchLen - 8, 5);

        if (is_numeric($searchStr) || is_numeric($searchStr2)) {
            header('Location: '.$site_url.'/naiti-sertifikat-po-nomeru/?param='.$searchQuery);
            exit();
        }
    }
?>
    <div class="wrapper">
        <div class="hero">
            <div class="hero__content">
                <?php
                    $breadcrumbs = [[
                        "content" => "Поиск по названию продукции"
                    ],
                    [
                        "content" => mb_ucfirst($searchQuery)
                    ]];

                    get_template_part('partials/breadcrumbs', null, ['breadcrumbs' => $breadcrumbs]);
                ?>
                <h1 class="hero__title">
                    Поиск по названию продукции
                </h1>
                <div class="search-item">
                    <div class="search-item__title">
                        Поиск сертификата по названию продукции:
                    </div>
                    <form class="search-item__form" method="get" id="searchform">
                        <div class="search-item__magnifier-input">
                            <div class="search-item__magnifier"></div>
                            <input class="search-item__input"
                                   type="text"
                                   name="s"
                                   placeholder="Например, средства индивидуальной защиты"
                                   value="<?php echo $searchQuery; ?>">
                        </div>
                        <button class="button search-item__button" type="submit">Поиск</button>
                    </form>
                </div>
            </div>
        </div>
        <main class="main">
            <div class="content">
                    <section class="certificates">
                    <?php
                        $postIds = searchByTitle(get_search_query());
                        $postIds = sortActual($postIds);
                        $postCount = count($postIds);
                        if ($postCount > 0) {
                    ?>
                        <h2 class="title-section certificates__title ">
                            <?php
                            echo declination($postCount, ["Найден", "Найдено", "Найдено"])
                                . ' ' . $postCount
                                . ' ' . declination($postCount, ["результат", "результата", "результатов"]);
                            ?>
                        </h2>
                        <div class="certificates__content">
                            <?php
                            $num = 0;
                            foreach($postIds as $postId) {
                                get_template_part( 'partials/certificates-item', null, ['postId' => $postId] );
                                if (++$num > 1) { ?>
                                    <?php if (!$isAuth) { ?>
                                        <div class="content__ad">
                                            <?php echo getAdContent('horizontal.ad'); ?>
                                        </div>
                                    <?php } ?>
                                <?php }
                            }
                            ?>
                        </div>

                        <?php if (function_exists ('wp_page_numbers')) wp_page_numbers();
                            if (!$isAuth) { ?>
                            <div class="content__ad">
                                <?php echo getAdContent(''); ?>
                            </div>
                            <?php }
                        } else { ?>
                            <h2 class="title-section certificates__title ">
                                Не удалось найти сертификаты на <?php echo $searchQuery;?>
                            </h2>
                        <?php } ?>
                </section>
            </div>
            <aside class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </main>
    </div>
<?php get_footer(); ?>