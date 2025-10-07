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
    $agency = getCleanName(getCertAgency($postId));
    $site_url = site_url();

?>
<div class="agencies-data">
    <div class="agencies-data__title">
        <?php echo $agency; ?>
    </div>
    <div class="manufacturers-data__description">
        Орган по сертификации: <?php echo getCertAgency($postId); ?>
    </div>

    <?php
    $coords = getAgencyCoords($agency);

    if ($coords != '') {
        $shortcode = '[yamap container="yamap'. $yamapContainer .'" center="'.$coords.'" height="250px" zoom="13" type="yandex#map" controls="typeSelector;zoomControl"][yaplacemark coord="'.$coords.'" icon="islands#blueHomeCircleIcon" color="#1e98ff" name="'.$agency.'"][/yamap]';
        ?>

        <div class="manufacturers-data__map" id="yamap<?php echo $yamapContainer; ?>"></div>

        <?php echo do_shortcode($shortcode);
    } ?>
</div>