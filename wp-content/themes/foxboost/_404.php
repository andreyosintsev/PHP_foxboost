<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Page Not Found).
 *
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $site_url            = site_url();
    $page_url            = get_page_uri();

    $isAuth              = isset($_SESSION['auth']);
?>
<?php get_header(); ?>
    <div class="wrapper">
        <div class="hero">
            <div class="hero__content">
                <?php
                    get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => [
                        ['content' => 'Ошибка 404 - страница не найдена']
                    ]]);
                ?>
                <h1 class="hero__title">
                    Ошибка 404 - страница не найдена
                </h1>
                <div class="search-item">
                    <div class="search-item__title">
                        Поиск сертификата по названию продукции:
                    </div>
                    <form class="search-item__form" method="get" action="">
                        <div class="search-item__magnifier-input">
                            <div class="search-item__magnifier"></div>
                            <input class="search-item__input" type="text" name="s" placeholder="Например, средства индивидуальной защиты">
                        </div>
                        <button class="button search-item__button" type="submit">Поиск</button>
                    </form>
                </div>
            </div>
        </div>
        <main class="main">
            <div class="content">
                <?php if (!$isAuth) { ?>
                    <div class="content__ad">
                        <?php echo getAdContent('horizontal.ad'); ?>
                    </div>
                <?php } ?>
                <section class="certificates">
                    <p>К сожалению, страница не найдена.</p>
                    <p>
                        Вы можете воспользоваться поиском по наименованию изделия
                        или вернуться на <a class="breadcrumbs__link" href="<?php echo $site_url; ?>" title="На главную">главную страницу</a> сайта.
                    </p>
                    <h2 class="title-section certificates__title ">
                        Последние добавленные сертификаты
                    </h2>
                    <div class="certificates__content">
                        <?php
                            $posts = get_posts('numberposts=5');
                            foreach($posts as $post) {
                                get_template_part( 'partials/certificates-item', null, ['postId' => $post->ID]);
                            }
                        ?>

                    </div>
                </section>
            </div>
            <aside class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </main>
    </div>
<?php get_footer(); ?>