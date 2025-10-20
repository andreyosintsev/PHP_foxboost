<?php
/*
* Template Name: How It Works
*
* template-how-it-works.php
*
* Template file for policy personal data.
* /about
*
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2025 asosintsev@yandex.ru
*/
?>
<?php get_header(); ?>
<?php
    $site_url            = site_url();
    $nice_url            = parse_url($site_url, PHP_URL_HOST);
    $page_url            = get_page_uri();
?>
<main class="main">
    <div class="wrapper wrapper_how-it-works">
        <section class="section">
            <?php the_content(); ?>
        </section>
    </div>
</main>
<?php get_footer(); ?>