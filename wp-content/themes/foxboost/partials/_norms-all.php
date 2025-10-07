<?php
/**
 * norms-all.php
 *
 * The partial for displaying the norms page if not norm specified.
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
            <?php
                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => [
                    ['content' => 'Поиск ГОСТа по номеру']
                ]]);
            ?>
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
            <?php if (!$isAuth) { ?>
                <div class="content__ad"></div>
            <?php } ?>
            <section class="norms">
                <h2 class="title-section norms__title">
                    Перечень ГОСТов и ТР
                </h2>
                <p>ГОСТы, технические регламенты и другие нормативные документы по популярности.</p>
                <p>Для поиска ГОСТа, не представленного в этом перечне, воспользуйтесь поиском.</p>
                <div class="norms__content">
                    <?php
                    $norms = getAllNorms(10);

                    foreach ($norms as $norm) { ?>
                        <div class="norms-item">
                            <a class="norms-item__link"
                               href="<?php echo getNormLink($norm->name); ?>"
                               title="Скачать <?php echo $norm->name; ?>">
                                <div class="norms-item__title">
                                    <?php echo $norm->name; ?>
                                </div>
                            </a>
                            <div class="norms-item__description">
                                <?php echo $norm->name_full; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
