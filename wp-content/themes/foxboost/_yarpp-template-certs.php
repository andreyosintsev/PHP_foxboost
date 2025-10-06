<?php /*
/**
 * yarpp-template-certs.php
 *
 * The Template for displaying related posts in styles of site.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php if ($related_query->have_posts()):?>
    <section class="certificates">
        <div class="title-more certificates__title">
            <a href="#" class="title-more__link" title="Сертификаты на продукцию">
                <h2 class="title-more__title">
                    Сертификаты на похожую продукцию
                </h2>
                <div class="title-more__more">
                    См.&nbsp;все
                </div>
            </a>
        </div>
        <div class="certificates__content">
            <?php
                while ($related_query->have_posts()) {
                    $related_query->the_post();
                    get_template_part('partials/certificates-item', null, ['postId' => get_the_ID()]);
            } ?>
        </div>
    </section>
<?php endif; ?>




