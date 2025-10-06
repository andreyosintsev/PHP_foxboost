<?php
/**
 * footer.php
 *
 * The template for displaying the footer. Contains footer
 * content and the closing of the html elements.
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

    $search_num = $_GET['param'] ?? '';
?>
<footer class="footer">
    <div class="nav-bottom">
        <div class="logo">
            <a class="logo__link" href="<?php echo $site_url; ?>" title="<?php bloginfo('name');?>">
                <img class="logo__image" src="<?php echo $template_url; ?>/images/logo.svg" alt="<?php echo $site_url ?>">
            </a>
        </div>
        <?php
        $search_string = empty($search_num)
            ? "Поиск по номеру сертификата"
            : $search_num;
        ?>
        <form class="search" action="<?php echo $site_url; ?>/naiti-sertifikat-po-nomeru" method="get">
            <input class="search__input" name="param" placeholder="<?php echo $search_string; ?>">
            <button class="search__magnifier" type="submit"></button>
        </form>
        <nav class="menu-main">
            <ul class="menu-main__items">
                <li class="menu-main__item">
                    <a href="<?php echo $site_url ?>/naiti-sertifikat-po-nomeru/" title="Найти сертификат по номеру">
                        Поиск по номеру
                    </a>
                </li>
                <li class="menu-main__item">
                    <a href="<?php echo $site_url ?>/naiti-sertifikat-po-vidu-produktsii/" title="Найти сертификат по виду продукции">
                        Продукция
                    </a>
                </li>
                <li class="menu-main__item">
                    <a href="<?php echo $site_url ?>/kompanii/" title="Найти сертификат по изготовителю">
                        Изготовители
                    </a>
                </li>
                <li class="menu-main__item">
                    <a href="<?php echo $site_url ?>/reestr-sertifikatov/" title="Реестр сертификатов и деклараций соответствия">
                        Реестр сертификатов
                    </a>
                </li>
                <li class="menu-main__item">
                    <a href="<?php echo $site_url ?>/organy-po-sertifikacii/" title="Органы по сертификации">
                        Органы
                    </a>
                </li>
                <li class="menu-main__item">
                    <a href="<?php echo $site_url ?>/gosty/" title="ГОСТы на материалы, товары, продукцию и услуги">
                        ГОСТы
                    </a>
                </li>
                <li class="menu-main__item">
                    <a href="<?php echo $site_url ?>/o-sajte/" title="О сайте">
                        О сайте
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="footer__disclamer-counter">
        <div class="footer__disclamer">
            <p>На сайте представлены сертификаты соответствия ГОСТ Р и Таможенного союза, а также Декларации соответствия Таможенного союза на различные материалы, товары, продукцию и услуги.</p>
            <p>Скачать сертификаты соответствия на продукцию и декларации можно в высоком разрешении. Информация представлена в виде изображений оригинальных документов и их копий. Вместе с изображениями представлена текстовая информация, содержащаяся в сертификатах.</p>
            <p>Сертификаты соответствия &copy; 2013-<?php echo date('Y'); ?>. Информация представлена только для ознакомительного использования.</p>
        </div>
        <div class="footer__counter">
            <!-- Yandex.Metrika informer -->
            <a href="https://metrika.yandex.ru/stat/?id=32820367&amp;from=informer"
               target="_blank" rel="nofollow">
                <img src="https://informer.yandex.ru/informer/32820367/3_0_FFFFFFFF_F2F2F2FF_0_pageviews"
                     style="width:88px; height:31px; border:0;"
                     alt="Яндекс.Метрика"
                     title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                     class="ym-advanced-informer"
                     data-cid="32820367"
                     data-lang="ru">
            </a>
            <!-- /Yandex.Metrika informer -->

            <!-- Yandex.Metrika counter -->
            <script type="text/javascript" >
                (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                ym(32820367, "init", {
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            </script>
            <noscript><div><img src="https://mc.yandex.ru/watch/32820367" style="position:absolute; left:-9999px;" alt=""></div></noscript>
            <!-- /Yandex.Metrika counter -->
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>