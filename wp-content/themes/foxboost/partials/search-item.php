<?php
/**
 * search-item.php
 *
 * The partial for displaying the page search form.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $title              = $args['title'];
    $placeholder        = $args['placeholder'];
    $placeholderDefault = $args['placeholderDefault'];
    $action             = $args['action'];
    $param              = $args['param'];
?>
<div class="search-item">
    <div class="search-item__title">
        <?php echo $title; ?>
    </div>
    <form class="search-item__form" action="<?php echo $action; ?>" method="get">
        <div class="search-item__magnifier-input">
            <div class="search-item__magnifier"></div>
            <input
                class="search-item__input"
                name="<?php echo $param; ?>"
                placeholder="<?php echo $placeholder ?: $placeholderDefault; ?>"
            >
        </div>
        <button class="button search-item__button" type="submit">Поиск</button>
    </form>
</div>