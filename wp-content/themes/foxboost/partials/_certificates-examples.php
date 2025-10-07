<?php
/**
 * certificates-examples.php
 *
 * The partial for displaying the certificates examples.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024-2025 asosintsev@yandex.ru
 */

    $template_url        = get_template_directory_uri();
?>
<ul class="examples__items">
    <li class="examples__item">
        <img class="examples__image"
             data-id="1"
             src="<?php echo $template_url; ?>/images/about/gost_o.jpg"
             alt="Сертификат соответствия ГОСТ Р — обязательная сертификация"
             title="Сертификат соответствия ГОСТ Р — обязательная сертификация">
    </li>
    <li class="examples__item">
        <img class="examples__image"
             data-id="2"
             src="<?php echo $template_url; ?>/images/about/gost_d.jpg"
             alt="Сертификат соответствия ГОСТ Р — добровольная сертификация"
             title="Сертификат соответствия ГОСТ Р — добровольная сертификация">
    </li>
    <li class="examples__item">
        <img class="examples__image"
             data-id="3"
             src="<?php echo $template_url; ?>/images/about/ss.jpg"
             alt="Сертификат соответствия Таможенного союза"
             title="Сертификат соответствия Таможенного союза">
    </li>
    <li class="examples__item">
        <img class="examples__image"
             data-id="4"
             src="<?php echo $template_url; ?>/images/about/ds.jpg"
             alt="Декларация соответствия Таможенного союза"
             title="Декларация соответствия Таможенного союза">
    </li>
</ul>