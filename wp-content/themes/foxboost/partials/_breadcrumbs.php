<?php
/**
 * breadcrumbs.php
 *
 * The partial for displaying the breadcrumbs.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024-2025 asosintsev@yandex.ru
 */

    $site_url = site_url();
    $breadcrumbs = $args['breadcrumbs'] ?? [];
?>
<div class="breadcrumbs hero__breadcrumbs">
    <a class="breadcrumbs__link"
       href="<?php echo $site_url; ?>"
       title="На главную">
        Главная
    </a>
    <?php foreach ($breadcrumbs as $breadcrumb): ?>
        /
            <?php if (!empty($breadcrumb['href'])) { ?>
                <a class="breadcrumbs__link"
                   href="<?php echo $site_url. '/' .$breadcrumb['href'] ?? ''; ?>"
                   title="<?php echo $breadcrumb['title'] ?? ''; ?>">
                    <?php echo $breadcrumb['content'] ?? ''; ?>
                </a>
            <?php } else {
                echo $breadcrumb['content'];
            }
    endforeach;
    ?>
</div>