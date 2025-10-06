<?php
/**
 * certificates-item.php
 *
 * The partial for displaying the certificate in list of certificates.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $postId = $args['postId'];
    if (!$postId) exit;

    $post =     get_post($postId);
    $title =    get_the_title();
    $titleUp =  mb_ucfirst($title);
    $titleClean = replaceQuotes($title);
    $number =   get_post_meta(get_the_ID(), "param1_number", $single = true);
    $link =     get_permalink();
    $thumb =    getThumbnail(220, 315, $post->ID);
    $manufacturerFull = getCertManufacturer($post->ID);
    $manufacturer = getCleanName($manufacturerFull);
    $manufacturerLink = getManufacturerLink($manufacturer);
    $flag = getCountryFlag($number);
?>
<div class="certificates-item">
    <div class="certificates-item__link-thumb">
        <a class="certificates-item__link"
           href="<?php echo $link; ?>"
           title="Сертификат на <?php echo $titleClean; ?>">
            <img class="certificates-item__thumb"
                 src="<?php echo $thumb; ?>"
                 alt="<?php echo $titleClean; ?>">;
            <div class="certificates-item__gradient"></div>
        </a>
    </div>
    <div class="certificates-item__description">
        <div class="certificates-item__title">
            <a href="<?php echo $link; ?>"
               title="Сертификат на <?php echo $titleClean; ?>">
                <?php echo $titleUp; ?>
            </a>
        </div>
        <div class="certificates-item__manufacturer">
            <a href="<?php echo $manufacturerLink; ?>"
               title="Сертификаты изготовителя <?php echo $titleClean; ?>"
            >
                <?php echo $manufacturer; ?>
            </a>
        </div>
        <div class="certificates-item__number">
            <span class="flag certificates-item__flag">
                <?php echo $flag; ?>
            </span>
            № <?php echo $number; ?>
        </div>
    </div>
    <div class="certificates-item__category-more">
        <?php echo getCategoryTree(null, $post->ID); ?>
        <div class="certificates-item__more">
            <a href="<?php echo $link; ?>" title="Просмотреть и скачать сертификат на <?php echo $titleClean; ?>">
                Скачать
            </a>
        </div>
    </div>
</div>