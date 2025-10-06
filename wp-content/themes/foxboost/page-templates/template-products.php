<?php
/*
Template Name: Products
*
* template-products.php
*
* Template file for category selection.
* /naiti-sertifikat-po-vidu-produktsii/
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
    $classificator    = in_array($_GET['classificator'] ?? '', ['okp', 'tnvedts']) ? $_GET['classificator'] : 'okp';
    $isAuth           = isset($_SESSION['auth']);
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php
                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => [
                    ['content' => 'Поиск по виду продукции']
                ]]);
            ?>
            <h1 class="hero__title">
                Поиск сертификатов соответствия по виду продукции
            </h1>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <?php if (!$isAuth) { ?>
                <div class="content__ad">
                    <?php echo getAdContent('horizontal.ad'); ?>
                </div>
            <?php } ?>
            <div class="products-list">
                <div class="products-list__classificators">
                    <a class="button products-list__classificator <?php echo $classificator != 'okp' ? 'button_not_active' : ''; ?>"
                       href="?classificator=okp"
                       title="Найти сертификаты по коду ОКП">
                       ОКП (ОК 005)
                    </a>
                    <a class="button products-list__classificator <?php echo $classificator != 'tnvedts' ? 'button_not_active' : ''; ?>"
                       href="?classificator=tnvedts"
                       title="Найти сертификаты по коду ТН ВЭД ТС">
                       ТН ВЭД ТС
                    </a>
                </div>

                <?php
                    if ($classificator == 'tnvedts') {
                        $parent = 38;
                    ?>
                        <p class="products-list__article">
                            Представлены сертификаты соответствия на продукцию по коду ТН ВЭД ТС - Единой Товарной номенклатуры внешнеэкономической деятельности Евразийского экономического союза.
                        </p>
                        <p class="products-list__article">
                            Сертификаты отсортированы по первым двум цифрам кода ТН ВЭД ТС.
                        </p>

                    <?php } else {
                        $parent = 37;
                    ?>
                        <p class="products-list__article">
                            Представлены сертификаты соответствия на продукцию по коду ОКП (ОК 005) - общероссийского классификатора продукции.
                        </p>
                        <p class="products-list__article">
                            Сертификаты отсортированы по первым двум цифрам кода ОКП.
                        </p>
                    <?php }

                        $args = array(
                            'parent'					=> $parent,
                            'child_of'					=> 0,
                            'hide_empty'				=> 0,
                            'number'					=> 0,
                            'taxonomy'					=> 'category',
                            'pad_counts'				=> true,
                            'exclude'					=> 1
                        );

                        $categories = get_categories($args);

                        foreach ($categories as $category) {
                            [$catNumber, $catName] = splitStringByDash($category->cat_name);
                        ?>
                            <div class="product-list__item product-item">
                                <div class="product-item__title">
                                    <?php if (!empty($catNumber)) { ?>
                                        <div class="product-item__group">
                                            <?php echo $catNumber; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="product-item__description">
                                        <?php echo $catName; ?>
                                    </div>
                                </div>
                                <?php
                                    $args = array(
                                        'parent'					=> $category->cat_ID,
                                        'child_of'					=> 0,
                                        'hide_empty'				=> 0,
                                        'number'					=> 0,
                                        'taxonomy'					=> 'category',
                                        'pad_counts'				=> true,
                                        'exclude'					=> 1
                                    );

                                    $categories2 = get_categories($args);

                                    if (count($categories2) > 0) {
                                ?>
                                        <ul class="product-item__content">
                                            <?php
                                                foreach ($categories2 as $category2) {
                                                    [$catNumber2, $catName2] = splitStringByDash($category2->cat_name);
                                                ?>
                                                    <li class="product-item__content-item product-content-item">
                                                        <a class="product-content-item__link"
                                                           href="<?php echo get_category_link($category2->term_id); ?>"
                                                           title="Сертификаты из рубрики <?php echo replaceQuotes($catName2); ?>">
                                                            <?php if (!empty($catNumber2)) { ?>
                                                                <div class="product-content-item__code">
                                                                    <?php echo $catNumber2; ?>
                                                                </div>
                                                            <?php } ?>

                                                            <div class="product-content-item__description">
                                                                <?php echo $catName2; ?>
                                                            </div>
                                                        </a>
                                                    </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                            </div>
                    <?php } ?>

            </div>
            <?php if (!$isAuth) { ?>
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