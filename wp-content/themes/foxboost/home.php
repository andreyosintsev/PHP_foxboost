<?php
/**
 * home.php
 *
 * The home template file.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php
    $site_url       = site_url();
    $template_url   = get_template_directory_uri();

    $search_name = $_GET['search'] ?? '';
    $isAuth         = isset($_SESSION['auth']);
?>
<?php get_header(); ?>
<div class="wrapper">
    <div class="motto">Будь в числе первых обладателей новинок</div>
    <div class="panel-stats">
        <div class="panel-stats_card card-stats">
            <?php
                $count_foxboosts = wp_count_posts('foxboost');
                $foxboosts_published = $count_foxboosts->publish;
            ?>
            <div class="card-stats__value card-stats__value_blue"><?php echo $foxboosts_published; ?></div>
            <div class="card-stats__description"><?php echo declination($foxboosts_published, ['Фоксбуст', 'Фоксбуста', 'Фоксбустов']);?> уже на сайте</div>
        </div>
        <div class="panel-stats_card card-stats">
            <?php
                $count_brands = wp_count_posts('brand');
                $brands_published = $count_brands->publish;
            ?>
            <div class="card-stats__value card-stats__value_purple"><?php echo $brands_published; ?></div>
            <div class="card-stats__description"><?php echo declination($brands_published, ['Бренд ждёт', 'Бренда ждут', 'Брендов ждут']);?> вас</div>
        </div>
        <div class="panel-stats_card card-stats">
            <div class="card-stats__value card-stats__value_red">&gt;50</div>
            <div class="card-stats__description">Довольных покупателей</div>
        </div>
    </div>
    <div class="section-logo">
        <?php

            $brands = get_posts([
                'post_type'      => 'brand',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ]);

            if ( ! empty( $brands ) ) {
                ?>
                <ul class="section-logo__items">
                    <?php foreach($brands as $brand) {
                        $name = get_the_title($brand->ID);
                        $image = get_field('image', $brand->ID, false);
                        $image_url = wp_get_attachment_url($image);

                        echo '<li class="logo section-logo__item">
                                <a class="logo__link" href="archive.html">
                                    <img class="logo__image" src="'. $image_url .'" alt="Компания '. $name .'" title="Фоксбусты '. $name .'"/>
                                </a>
                              </li>';
                    }?>
                </ul>
            <?php } ?>
    </div>
    <div class="slider-hero">
        <?php echo do_shortcode('[metaslider id="59"]'); ?>
    </div>
</div>
<main class="main">
    <div class="wrapper">
        <section class="section">
            <h2 class="title">Популярные фоксбусты</h2>
            <div class="section-foxboost">
                <?php
                    $args = array(
                        'post_type'      => 'foxboost',
                        'posts_per_page' => 4,
                        'meta_key'       => 'views',
                        'orderby'        => array(
                            'meta_value_num' => 'DESC',
                            'date' => 'DESC'
                        )
                    );

                    $query = new WP_Query($args);

                    while ($query->have_posts()) : $query->the_post();
                        get_template_part('partials/card-foxboost', null, ['post_id' => get_the_ID()]);
                    endwhile;
                    wp_reset_postdata();
                ?>
            </div>
        </section>
        <section class="section">
            <h2 class="title">Новые фоксбусты</h2>
            <div class="section-foxboost">
                <?php
                $args = array(
                    'post_type'      => 'foxboost',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );

                $query = new WP_Query($args);

                while ($query->have_posts()) : $query->the_post();
                    get_template_part('partials/card-foxboost', null, ['post_id' => get_the_ID()]);
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <section class="section">
            <h2 class="title">Скоро завершатся</h2>
            <div class="section-foxboost">
                <?php
                $args = array(
                    'post_type'      => 'foxboost',
                    'posts_per_page' => 4,
                    'meta_key'       => 'datetogo',
                    'meta_value'     => date('Y-m-d'),
                    'meta_compare'   => '>=',
                    'orderby'        => 'meta_value',
                    'order'          => 'ASC',
                    'meta_type'      => 'DATE'
                );

                $query = new WP_Query($args);

                while ($query->have_posts()) : $query->the_post();
                    get_template_part('partials/card-foxboost', null, ['post_id' => get_the_ID()]);
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <section class="section">
            <h2 class="title">Амбассадоры и инфлюенсеры</h2>
            <div class="section-ambassador">
                <?php
                $args = array(
                    'post_type'      => 'ambassador',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'ASC'
                );

                $query = new WP_Query($args);
                $first = true;

                while ($query->have_posts()) : $query->the_post();
                    get_template_part('partials/card-ambassador', null, ['post_id' => get_the_ID(), 'double' => $first]);
                    $first = false;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </section>
        <section class="section">
            <h2 class="title">Контакты</h2>
            <div class="contacts">
                <div class="contacts__address">
                    <p class="contacts__p">г. Москва, Волгоградскиий проспект, 47</p>
                    <p class="contacts__p">foxboost.ru</p>
                    <p class="contacts__p">info@foxboost.ru</p>
                    <p class="contacts__p">+7 (495) 259-58-78</p>
                    <p class="contacts__p">+7 (495) 259-58-13</p>
                </div>
                <div class="contacts__span"></div>
                <div class="contacts__feedback">
                    <p class="contacts__p">
                        Если у вас есть вопросы или предложения, мы будем рады их обсудить. Оставьте свои контакты, и мы свяжемся с
                        вами!
                    </p>
                    <?php echo do_shortcode('[contact-form-7 id="1c4a8fe" title="Обратная связь в контактах"]'); ?>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>