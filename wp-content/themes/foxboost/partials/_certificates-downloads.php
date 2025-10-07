<?php
/**
 * certificates-downloads.php
 *
 * The partial for displaying the download buttons for the certificate and appendix.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $postId = $args['postId'];
    if (!$postId) exit;

    $position = $args['position'];
    $addClass = $position == 'bottom' ? 'specs__downloads_bottom' : '';

    $link =     getCertDownloadLink($postId);
    $link2 =    getCertDownloadLink2($postId);
    $title =    get_the_title($postId);
?>
<div class="specs__downloads">
    <?php if ($link !== '') { ?>
        <button class="button specs__download specs__download_certify <?php echo $addClass; ?>"
                data-link="certificate"
                type="button"
                title="Скачать сертификат на <?php echo replaceQuotes($title); ?>"
                data-id="<?php echo $postId; ?>"
                onclick="ym(32820367, 'reachGoal', 'download-click')">
            Скачать сертификат
            <span class="specs__download-details"><?php echo getImageResolution($link); ?> px</span>
        </button>
    <?php } ?>
    <?php if ($link2 !== '') { ?>
        <button class="button specs__download button_outlined specs__download_appendix"
                data-link="appendix"
                type="button"
                title="Скачать приложение к сертификату на <?php echo replaceQuotes($title); ?>"
                data-id="<?php echo $postId; ?>"
                onclick="ym(32820367, 'reachGoal', 'appendix-click')">
            Скачать приложение
        </button>
    <?php } ?>
</div>