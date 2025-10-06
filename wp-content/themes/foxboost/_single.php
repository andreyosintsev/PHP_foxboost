<?php
/**
 * single.php
 *
 * The Template for displaying all single posts.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php
    global $wpdb;

    $site_url   = site_url();
    $isAuth     = isset($_SESSION['auth']);

    //Если пользователь залогинен, инициируем запись истории скачивания за текущий день
    if ($isAuth) {
        date_default_timezone_set('Europe/Samara');

        $wpdb->insert('wp_userhistory',
            [ 'user' => $_SESSION['login'], 'post_id' => get_the_ID(), 'lasttime' => date('Y-m-d H:i:s'), 'downloaded' => 0 ],
            [ '%s', '%s', '%s', '%d' ]
        );
    }
?>
<?php get_header(); ?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <div class="breadcrumbs hero__breadcrumbs">
                <?php
                    $breadcrumbs = [[
                        "href" => "reestr-sertifikatov/",
                        "title" => "Реестр сертификатов",
                        "content" => "Реестр сертификатов"
                    ],
                    [
                        "content" => getCertNumber(get_the_ID())
                    ]];

                    get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => $breadcrumbs]);
                ?>

            </div>
            <h1 class="hero__title">
                Сертификат <?php echo the_title(); ?>
            </h1>
            <div class="hero__manufacturer">
                <?php echo getCleanName(getCertManufacturer(get_the_ID())); ?>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <?php if (!$isAuth) { ?>
                <div class="content__ad">
                    <?php echo getAdContent('horizontal.ad'); ?>
                </div>
            <?php } ?>
            <div class="certificate">
                <?php
                    $thumbnail = getThumbnail(454, 650, get_the_ID(), false);
                    $thumbnail2 = getThumbnail(454, 650, get_the_ID(), true);
                ?>
                <img class="certificate__image"
                     id="certify__image"
                     src="<?php echo $thumbnail;?>"
                     alt="Сертификат на <?php echo replaceQuotes(get_the_title()); ?>"
                     title="Скачать сертификат на <?php echo replaceQuotes(get_the_title()); ?>">
                <?php
                    if ($thumbnail2 !== '') { ?>
                        <img class="certificate__image"
                             id="appendix__image"
                             src="<?php echo $thumbnail2;?>"
                             alt="Приложение к сертификату на <?php echo replaceQuotes(get_the_title()); ?>"
                             title="Скачать приложение к сертификату на <?php echo replaceQuotes(get_the_title()); ?>">
                <?php } ?>
            </div>
            <div class="specs">
                <?php
                    get_template_part('partials/certificates-downloads',null, ['postId' => get_the_ID(), 'position' => 'up']);
                    get_template_part('partials/certificates-specs', null, ['postId' => get_the_ID()] );
                    get_template_part('partials/certificates-downloads',null, ['postId' => get_the_ID(), 'position' => 'bottom']);
                ?>
                <div class="tags specs__tags">
                    <?php
                        $tags = get_the_tags(get_the_ID());
                        foreach ($tags as $tag) { ?>
                            <div class="tags__tag">
                                <a class="tags__link"
                                   href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                    title="Сертификаты на <?php echo replaceQuotes(esc_html($tag->name)); ?>">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (/* !$isAuth*/ false) { ?>
                <div class="content__ad">
                    <?php echo getAdContent(''); ?>
                </div>
            <?php } ?>
            <?php related_posts(); ?>
        </div>
        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </main>
</div>

<div class="preloader" id="wait"></div>
<div class="modal-overlay"></div>

<?php
    get_template_part( 'partials/forms/form-login', null, null );
    get_template_part( 'partials/forms/form-password-reset', null, null );
    get_template_part( 'partials/forms/form-register', null, null );
    get_template_part( 'partials/forms/form-register2', null, null );
?>
<?php get_footer(); ?>