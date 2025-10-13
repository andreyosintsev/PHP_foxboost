<?php
/**
 * footer.php
 *
 * The template for displaying the footer. Contains footer
 * content and the closing of the html elements.
 *
 * @link        http://foxboost.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php
    $site_url       = site_url();
    $template_url   = get_template_directory_uri();

    $categories = get_categories( array(
        'taxonomy'     => 'category',
        'hide_empty'   => false,
        'parent'       => 0,
        'orderby'      => 'name',
        'order'        => 'ASC',
    ) );
?>
<footer class="footer">
    <div class="wrapper footer__wrapper">
        <div class="footer__content">
            <div class="logo footer__logo">
                <a class="logo__link" href="index.html" tabindex="-1">
                    <img src="<?php echo $template_url; ?>/images/logo-text.webp" alt="Компания" class="logo__image" title="На главную страницу" />
                </a>
            </div>
            <div class="footer__menu">
                <div class="footer__menu-column">
                    <div class="footer__menu-title">Фоксбусты</div>

                    <?php
                        if ( ! empty( $categories ) ) {
                        ?>
                        <ul class="footer__menu-items">
                            <?php foreach($categories as $category) {
                                if ($category->term_id === 1) continue;
                                $link = get_category_link($category->term_id);

                                echo '<li class="footer__menu-item">
                                <a class="link link_light"
                                    href="' .esc_url( $link ). '" 
                                    title="' . esc_html( $category->name ) . '" 
                                    aria-label="' . esc_html( $category->name ) . '">' .
                                    esc_html( $category->name ).'
                                </a>
                         </li>';
                        }?>
                        </ul>
                    <?php } ?>
                </div>
                <div class="footer__menu-column">
                    <div class="footer__menu-title">Поддержка</div>
                    <ul class="footer__menu-items">
                        <li class="footer__menu-item">
                            <a class="link link_light" href="#" title="О сайте Foxboost.ru">Как это работает</a>
                        </li>
                        <li class="footer__menu-item">
                            <a class="link link_light" href="mailto:foxboost@mail.ru" title="Написать нам e-mail">
                                foxboost@mail.ru
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__legal">
            <div class="footer__copyright">&copy; ООО &ldquo;ФОКСГЕЙМЕР&rdquo;, 2025</div>
            <div class="footer__disclamer">
                Посещая сайт foxboost.ru, вы предоставляете согласие на обработку данных о посещении вами сайта foxboost.ru, сбор
                которых автоматически осуществляется на условиях 
                <a class="link footer__link link_light" href="#" title="Ознакомиться с политикой конфиденциальности">
                    Политика конфиденциальности
                </a>
                .
            </div>
        </div>
    </div>
</footer>
<div class="loader hidden"></div>
<div class="popup hidden" id="popup-order">
    <h2 class="title popup__title">Оставить заявку</h2>
    <p class="popup__product">Кресло FoxGear model X</p>
    <p class="popup__text">
        Оставьте заявку на этот фоксбуст.
        <br />
        Вы получите уведомление на указанный e-mail о начале продаж.
    </p>
    <form class="form popup__form">
        <input class="input popup__input" name="name" placeholder="Ваше имя" />
        <input class="input popup__input" name="email" placeholder="E-mail" />
        <input class="input popup__input" name="tel" placeholder="Телефон" />
        <input class="input popup__input" name="promocode" placeholder="Промокод (при наличии)" />
        <input type="hidden" name="product" />
        <input class="button popup__button" type="submit" value="Создать заявку" />
        <div class="popup__offer">
            Нажимая кнопку Отправить вы соглашаетесь с условиями
            <a class="link popup__link" href="#" title="Текст публичной оферты" target="_blank">Пользовательского соглашения</a>
            и даёте разрешение направлять вам информационную рассылку на указанный выше e-mail. Вы всегда сможете от нее отписаться.
        </div>
    </form>
    <div class="popup__close"></div>
</div>
<div class="popup hidden" id="popup-success">
    <h2 class="title popup__title">Заявка оформлена</h2>
    <p class="popup__text">
        Поздравляем!
        <br />
        <br />
        Вы подписались на информационную рассылку. При поступлении в продажу данного товара вы получите уведомление на указанный
        вами e-mail.
        <br />
        <br />
        Благодарим за проявленный интерес!
    </p>
    <input class="button popup__button button_close" type="button" value="Закрыть" />
    <div class="popup__close"></div>
</div>
<div class="popup hidden" id="popup-failed">
    <h2 class="title popup__title">Заявка не отправлена</h2>
    <p class="popup__text">
        К сожалению, вашу заявку отправить не удалось.
        <br />
        <br />
        Но мы знаем о проблеме, и совсем скоро её устраним. Попробуйте ещё раз отправить обращение позже.
        <br />
        <br />
        Просим прощения за доставленные неудобства.
    </p>
    <input class="button popup__button button_close" type="button" value="Закрыть" />
    <div class="popup__close"></div>
</div>
<div class="popup hidden" id="popup-unsubscribe">
    <h2 class="title popup__title">Отписка от рассылки</h2>
    <p class="popup__text">
        Вы успешно отписались от информационной рассылки.Теперь вы не будете получать уведомления о новых товарах, поступивших в
        продажу.
        <br />
        <br />
        Чтобы вновь получать уведомления создайте заявку на заинтересовавший вас товар.
    </p>
    <input class="button popup__button button_close" type="button" value="Закрыть" />
    <div class="popup__close"></div>
</div>
<div class="popup hidden" id="popup-feedback">
    <h2 class="title popup__title">Успешно отправлено</h2>
    <p class="popup__text">
        Ваш вопрос или предложение успешно отправлено.
        <br />
        <br />
        После ознакомления при необходимости администратор проекта свяжется с вами по указанным вами контактным данным.
        <br />
        <br />
        Благодарим за проявленный интерес!
    </p>
    <input class="button popup__button button_close" type="button" value="Закрыть" />
    <div class="popup__close"></div>
</div>
<div class="overlay hidden"></div>
<?php wp_footer(); ?>
</body>
</html>