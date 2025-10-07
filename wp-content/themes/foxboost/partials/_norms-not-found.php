<?php
/**
 * norms-not-found.php
 *
 * The partial for displaying the norms page if no norm found.
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

    $normSearchString    = $_GET['norm'];
    $isAuth              = isset($_SESSION['auth']);
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <div class="breadcrumbs hero__breadcrumbs">
                <a class="breadcrumbs__link"
                   href="<?php echo $site_url; ?>"
                   title="На главную">
                    Главная
                </a>
                /
                <a class="breadcrumbs__link"
                   href="<?php echo $site_url. '/' .$page_url; ?>"
                   title="Поиск ГОСТа по номеру">
                    Поиск ГОСТа по номеру
                </a>
                </a>
                / <?php echo $normSearchString; ?>
            </div>
            <h1 class="hero__title">
                ГОСТы на материалы, товары, продукцию и услуги
            </h1>
            <?php get_template_part(
                'partials/search-item',
                null, [
                    'title'                => 'Поиск ГОСТа по номеру:',
                    'placeholder'          => $normSearchString,
                    'placeholderDefault'   => 'Например, ГОСТ 30547-97',
                    'action'               => $site_url. '/' . get_page_uri(),
                    'param'                => 'norm'
                ]
            );
            ?>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <section class="certificates">
                <h2 class="title-section certificates__title ">
                    <?php
                    $wp_query->set_404();
                    status_header( 404 );
                    ?>
                    Не удалось найти нормативные документы <?php echo $normSearchString; ?>
                </h2>
            </section>
