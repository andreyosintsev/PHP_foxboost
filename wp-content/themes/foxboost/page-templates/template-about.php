<?php
/*
Template Name: About
*
* template-about.php
*
* Template file for about page".
* /o-sajte/
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
    $template_url        = get_template_directory_uri();

    $isAuth              = isset($_SESSION['auth']);
?><div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php
                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => [
                    ['content' => 'О сайте']
                ]]);
            ?>
            <h1 class="hero__title">
                О сайте
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
            <section class="about">
                <h3 class="title-section about__title">
                    О сайте
                </h3>
                <div class="about__content">
                    <p>
                        <strong>rostest-certify.ru</strong> — это сервис, предлагающий своим пользователям скачать сертификаты соответствия ГОСТ Р и Таможенного союза, а также декларации соответствия. Многие сертификаты и декларации представлены вместе с приложениями. Сертификаты, представленные на страницах сайта, постоянно пополняются. Представленные документы могут быть скачаны для ознакомительных целей.
                    </p>
                    <p>
                        На сайте можно найти следующие виды сертификатов:
                    </p>
                    <ul>
                        <li>Сертификат соответствия ГОСТ Р — обязательная сертификация</li>
                        <li>Сертификат соответствия ГОСТ Р — добровольная сертификация</li>
                        <li>Сертификат соответствия Таможенного союза</li>
                        <li>Декларация соответствия Таможенного союза</li>
                    </ul>
                    <?php echo get_template_part('partials/certificates-examples'); ?>
                    <p>
                        Сертификаты представлены в виде графических изображений отсканированных оригинальных документов и их копий, в том числе полученных из различных источников в сети Интернет. Также на страницах сайта вместе с изображениями представлена текстовая информация, содержащаяся в сертификатах.
                    </p>
                </div>
            </section>
            <section class="disclamer">
                <h2 class="title-section disclamer__title">
                    Отказ от ответственности
                </h2>
                <div class="disclamer__content">
                    <p>
                        Данный ресурс в сети Интернет никоим образом не относится и не связан с Росреестром, Росаккредитацией, Росстандартом и Ростестом и другими официальными органами Российской Федерации. Источником всех текстовых и графических материалов является сеть Интернет. Информация представлена для ознакомления. Коллектив сайта не несет ответственности за возможный прямой или косвенный ущерб, связанный с использованием информации, изложенной на данном сайте.
                    </p>
                </div>
            </section>
            <section class="feedback" id="feedback">
                <h2 class="title-section feedback__title">
                    Обратная связь
                </h2>
                <div class="feedback__content">
                    <p class="feedback__preface">
                        Для связи с администрацией сайта воспользуйтесь следующей формой
                    </p>
                    <?php
                        echo do_shortcode('[contact-form-7 id="5397" title="Contact form 1"]');
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