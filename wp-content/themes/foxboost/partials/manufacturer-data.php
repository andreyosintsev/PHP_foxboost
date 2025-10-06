<?php
/**
 * manufacturer-data.php
 *
 * The partial for displaying the header with manufacturer info
 * in certificates list.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $postId = $args['postId'];
    if (!$postId) exit;

    $yamapContainer = rand(0, 1000);
    $manufacturer = getCleanName(getCertManufacturer($postId));
    $site_url = site_url();

?>
<div class="manufacturers-data">
    <a class="manufacturers-data__link"

       href="<?php echo getManufacturerLink($manufacturer); ?>"
       title="Сертификаты <?php echo replaceQuotes($manufacturer); ?>">
        <div class="manufacturers-data__thumb-title">
            <?php
            $logo = getManufacturerLogo($manufacturer);

            if ($logo) { ?>
                <div class="manufacturers-data__thumb">
                    <img src="<?php echo $site_url; ?>/logos/<?php echo $logo; ?>"
                         alt="Сертификаты <?php echo replaceQuotes($manufacturer); ?>">
                </div>
            <?php  } ?>
            <div class="manufacturers-data__title">
                <?php echo $manufacturer; ?>
            </div>
        </div>
    </a>
    <div class="manufacturers-data__description">
        Изготовитель: <?php echo getCertManufacturer($postId); ?>
    </div>

    <?php
    $coords = getManufacturerCoords($manufacturer);

    if ($coords != '') {
        $shortcode = '[yamap container="yamap'. $yamapContainer .'" center="'.$coords.'" height="250px" zoom="13" type="yandex#map" controls="typeSelector;zoomControl"][yaplacemark coord="'.$coords.'" icon="islands#blueHomeCircleIcon" color="#1e98ff" name="'.$manufacturer.'"][/yamap]';
        ?>

        <div class="manufacturers-data__map" id="yamap<?php echo $yamapContainer; ?>"></div>

        <?php echo do_shortcode($shortcode);
    } ?>
</div>