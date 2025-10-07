<?php
/**
 * agencies-row.php
 *
 * The partial for displaying the row of the table of agencies.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $regnum = $args['regnum'];
    $name   = $args['name'];
    $link   = $args['link'];
    $city   = $args['city'];
    $info   = $args['info'];
    $url    = isset($args['url']) ?? '';
    $urlDisplayable = $url !== '' ? parse_url($url, PHP_URL_HOST) : '';
?>
<div class="agencies-table__cell">
    <div class="agencies-table__link agencies-table__expandinfo"
         data-reg="<?php echo $regnum; ?>"
         title="Просмотреть сведения об органе <?php echo replaceQuotes($name); ?>">
        <?php echo $regnum; ?>
    </div>
</div>
<div class="agencies-table__cell agencies-table__cell_name">
    <a class="agencies-table__link"
       href="<?php echo $link; ?>"
       title="Сертификаты выданные <?php echo replaceQuotes($name); ?>">
        <?php echo $name; ?>
    </a>
    <?php if ($url !== '') { ?>
        <a class="agencies-table__link agencies-table__link_website"
           href="<?php echo $url; ?>"
           title="Перейти на официальный сайт <?php echo replaceQuotes($name); ?>">
            <?php echo $urlDisplayable; ?>
        </a>
    <?php } ?>
</div>
<div class="agencies-table__cell agencies-table__cell_city">
    <?php echo $city; ?>
</div>
<div class="agencies-table__cell agencies-table__cell_info agencies-table__cell_hidden" data-reg="<?php echo $regnum; ?>">
    <?php echo $info; ?>
</div>