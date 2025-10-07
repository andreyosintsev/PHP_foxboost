<?php
/**
 * norms-item.php
 *
 * The partial for displaying the norm in list of norms.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $norm = $args['norm'];
    if (!$norm) exit;
?>
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