<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Page Not Found).
 *
 * @link        https://foxboost.ru
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
    $site_url       = site_url();
    $template_url   = get_template_directory_uri();
?>
<?php get_header(); ?>
<div class="page404">
    <div class="page404__content">
        <a href="<?php echo $site_url; ?>">
            <img class="page404__logo" src="<?php echo $template_url; ?>/images/logo.svg" />
        </a>
        <h2 class="title page404__title">Страница не найдена. Ошибка 404</h2>
        <p class="page404__text">Страница, на которую вы пытались перейти, не найдена или никогда не существовала.</p>
        <a class="link page404__link" href="<?php echo $site_url; ?>" title="На главную">Вернуться на главную страницу</a>
    </div>
</div>