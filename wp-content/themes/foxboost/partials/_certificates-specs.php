<?php
/**
 * certificates-specs.php
 *
 * The partial for displaying the specs of the certificate.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $postId = $args['postId'];
    if (!$postId) exit;

    $site_url =     site_url();

    $number =       getCertNumber($postId);
    $validity =     getCertValidity($postId);
    $agency =       getCertAgency($postId);
    $declarant =    getCertDeclarant($postId);
    $product =      getCertProduct($postId);
    $compliesWith = getCertCompliesWith($postId);
    $okp = 			get_the_category($postId);
    $manufacturer = getCertManufacturer($postId);
    $issued =       getCertIssued($postId);
    $onTheBasis =   getCertOnTheBasis($postId);
    $addInfo =      getCertAddInfo($postId);
?>
<div class="specs__content">
    <div class="specs__items">

        <?php if ($number !== '') { ?>
            <div class="specs__key">
                № сертификата
            </div>
            <div class="specs__value">
                <div class="specs__flag-number">
                    <div class="flag specs__flag">
                        <?php echo getCountryFlag($number); ?>
                    </div>
                    <div class="specs__number">
                        <span itemprop="productID"><?php echo $number; ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($validity !== '') { ?>
            <div class="specs__key">
                Срок действия
            </div>
            <div class="specs__value">
                <div class="specs__validity-validated">
                    <div class="specs__validity">
                        <?php echo $validity; ?>
                    </div>
                    <?php if (isActualDates($validity)) { ?>
                        <div class="specs__validated specs__validated_true">
                            Действующий
                        </div>
                    <?php } else { ?>
                        <div class="specs__validated specs__validated_false">
                            Срок истёк
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if ($agency !== '') {
            $agencyClean = getCleanName($agency);
            $agencyNum = getAgencyNum($agency);
            $agencyUrl = getAgencyUrl($agencyNum);
            $agencyUrlDisplayable = $agencyUrl !== '' ? parse_url($agencyUrl, PHP_URL_HOST) : ''
        ?>
            <div class="specs__key">
                Орган по сертификации
            </div>
            <div class="specs__value">
                <div class="specs__agency">
                    <div class="specs__agency-title">
                        <?php echo $agencyClean; ?>
                    </div>
                    <div class="specs__agency-reg">
                        <?php echo $agencyNum; ?>
                    </div>
                    <?php if ($agencyUrl !== '') { ?>
                        <div class="specs__agency-website">
                            <a class="specs__agency-website-link"
                               href="<?php echo $agencyUrl; ?>"
                               title="Официальный сайт <?php echo replaceQuotes($agencyClean); ?>"
                               target="_blank"
                               rel="nofollow">
                                <?php echo $agencyUrlDisplayable; ?>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="specs__agency-info">
                        <?php echo $agency; ?>
                    </div>
                    <div class="specs__agency-more">
                        <a class="specs__agency-more-link"
                           href="<?php echo getAgencyLink($agencyClean); ?>"
                           title="Сертификаты, выданные <?php echo replaceQuotes($agencyClean); ?>">
                            Другие сертификаты, выданные органом
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($declarant !== '') { ?>
            <div class="specs__key">
                Заявитель/декларант
            </div>
            <div class="specs__value">
                <?php echo $declarant; ?>
            </div>
        <?php } ?>

        <?php if ($product !== '') { ?>
            <div class="specs__key">
                Продукция (услуга, работа)
            </div>
            <div class="specs__value">
                <div class="specs__product">
                    <?php echo $product; ?>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($okp)) { ?>
            <div class="specs__key">
                Код <?php echo getCategoryType($postId); ?>
            </div>
            <div class="specs__value">
                <?php echo getCategoryTree(null, $postId); ?>
            </div>
        <?php } ?>

        <?php if ($compliesWith !== '') { ?>
            <div class="specs__key">
                Соответствует требованиям
            </div>
            <div class="specs__value">
                <div class="specs__complies">
                    <div class="specs__complies-raw">
                        <?php echo $compliesWith; ?>
                    </div>
                    <?php echo getNormLinks($compliesWith); ?>
                </div>
            </div>
        <?php } ?>

        <?php if ($manufacturer !== '') {
            $manufacturerClean = getCleanName($manufacturer);
            ?>
        <div class="specs__key">
            Изготовитель
        </div>
        <div class="specs__value">
            <div class="specs__manufacturer">
                <div class="specs__manufacturer-logo-title">
                    <?php
                        $logo = getManufacturerLogo($manufacturerClean);
                        if ($logo) { ?>
                            <div class="specs__manufacturer-logo">
                                <img class="specs__manufacturer-logo-image"
                                     src="<?php echo $site_url; ?>/logos/<?php echo $logo; ?>"
                                     alt="<?php echo replaceQuotes($manufacturerClean); ?>"
                                >
                            </div>
                        <?php } ?>
                    <div class="specs__manufacturer-title">
                        <?php echo $manufacturerClean; ?>
                    </div>
                </div>
                <div class="specs__manufacturer-info">
                    <?php echo $manufacturer; ?>
                </div>
                <div class="specs__manufacturer-more">
                    <a class="specs__agency-more-link"
                       href="<?php echo getManufacturerLink($manufacturerClean); ?>"
                       title="Другие сертификаты <?php echo $manufacturerClean; ?>">
                        Другая продукция этого изготовителя
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if ($issued !== '') { ?>
            <div class="specs__key">
                Сертификат выдан
            </div>
            <div class="specs__value">
                <?php echo $issued; ?>
            </div>
        <?php } ?>


        <?php if ($onTheBasis !== '') { ?>
            <div class="specs__key">
                На основании
            </div>
            <div class="specs__value">
                <?php echo $onTheBasis; ?>
            </div>
        <?php } ?>

        <?php if ($addInfo !== '') { ?>
            <div class="specs__key">
                Дополнительная информация
            </div>
            <div class="specs__value">
                <?php echo $addInfo; ?>
            </div>
        <?php } ?>
    </div>
</div>