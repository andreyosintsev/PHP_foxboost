<?php
/**
 * forms/form-register2.php
 *
 * The partial for displaying the second registration form.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
    $site_url = site_url();
    $template_uri = get_template_directory_uri();
    $totalCertificates = round (wp_count_posts()->publish,-2, PHP_ROUND_HALF_DOWN);

    $price = 0;

    if (isset($_SESSION['price'])) {
        $price = $_SESSION['price'];
    } else {
        $price = getPriceCurrent();
        $_SESSION['price'] = $price;
    }
    $price_old = getPriceOld($price);

?>
<!--Форма регистрации 2-->
<div class="modal modal-reg2">
    <div class="modal__header">
        <div class="modal__title">
            Регистрация
        </div>
        <div class="modal__subtitle">
            Создайте новую учётную запись, чтобы скачивать сертификаты соответствия
        </div>
    </div>
    <div class="modal__content">
        <ul class="modal__benefits">
            <li class="modal__benefit">Неограниченное количество скачиваний</li>
            <li class="modal__benefit">Более <?php echo $totalCertificates; ?> сертификатов и деклараций</li>
            <li class="modal__benefit">Изображения документов высокого качества</li>
            <li class="modal__benefit">Регулярное пополнение базы документов</li>
        </ul>
        <div class="modal__line"></div>
        <div class="modal__group">
            <div class="modal__textline modal__textline_bold">
                Стоимость регистрации
            </div>
            <div class="modal__proposal">
                <div class="modal__price">
                    <?php echo $price; ?> р.
                </div>
                <div>
                    Неограниченный срок
                </div>
            </div>
        </div>
        <div class="modal__line"></div>
        <div class="modal__group">
            <div class="modal__textline modal__textline_light">
                Для регистрации необходимо выполнить оплату
                <p class="modal__paragraph">
                    <span class="modal__textline modal__textline_bold">Назначение:</span> Регистрация на сайте rostest-certify.ru
                </p>
                <p class="modal__paragraph">
                    <span class="modal__textline modal__textline_bold">Сумма платежа:</span> <?php echo $price; ?> рублей
                </p>
            </div>
        </div>
        <div class="modal__group">
            <ul class="modal__payment-options">
                <li class="modal__payment-option modal__payment-option_card"
                    onclick="$('form[name=yandexCardRefillForm]').submit();"
                    title="Банковская карта">
                    <form name="yandexCardRefillForm" id="yandexCardRefillForm" method="post" action="https://yoomoney.ru/quickpay/confirm.xml">
                        <input type="hidden" name="receiver" value="41001587087146">
                        <input type="hidden" name="quickpay-form" value="shop">
                        <input type="hidden" name="targets" value="Регистрация на сайте rostest-certify.ru (ID = ERROR)">
                        <input type="hidden" name="paymentType" value="AC">
                        <input type="hidden" name="sum" value="<?php echo $price;?>">
                        <input type="hidden" name="formcomment" value="Регистрация на сайте rostest-certify.ru">
                        <input type="hidden" name="short-dest" value="Регистрация на сайте rostest-certify.ru">
                        <input type="hidden" name="label" value="ERROR">
                        <input type="hidden" name="successURL" value="<?php echo get_permalink();?>">
                    </form>
                </li>
                <li class="modal__payment-option modal__payment-option_yad"
                    onclick="$('form[name=yandexYadRefillForm]').submit();"
                    title="Yoomoney">
                    <form name="yandexYadRefillForm" id="yandexYadRefillForm" method="post" action="https://yoomoney.ru/quickpay/confirm.xml">
                        <input type="hidden" name="receiver" value="41001587087146">
                        <input type="hidden" name="quickpay-form" value="shop">
                        <input type="hidden" name="targets" value="Регистрация на сайте rostest-certify.ru (ID = ERROR)">
                        <input type="hidden" name="paymentType" value="PC">
                        <input type="hidden" name="sum" value="<?php echo $price;?>">
                        <input type="hidden" name="formcomment" value="Регистрация на сайте rostest-certify.ru">
                        <input type="hidden" name="short-dest" value="Регистрация на сайте rostest-certify.ru">
                        <input type="hidden" name="label" value="ERROR">
                        <input type="hidden" name="successURL" value="<?php echo get_permalink();?>">
                    </form>
                </li>
                <li class="modal__payment-option modal__payment-option_mobile"
                    onclick="$('form[name=yandexMobileRefillForm]').submit();"
                    title="Баланс мобильного телефона">
                    <form name="yandexMobileRefillForm" id="yandexMobileRefillForm" method="post" action="https://yoomoney.ru/quickpay/confirm.xml">
                        <input type="hidden" name="receiver" value="41001587087146">
                        <input type="hidden" name="quickpay-form" value="shop">
                        <input type="hidden" name="targets" value="Регистрация на сайте rostest-certify.ru (ID = ERROR)">
                        <input type="hidden" name="paymentType" value="MC">
                        <input type="hidden" name="sum" value="<?php echo $price;?>">
                        <input type="hidden" name="formcomment" value="Регистрация на сайте rostest-certify.ru">
                        <input type="hidden" name="short-dest" value="Регистрация на сайте rostest-certify.ru">
                        <input type="hidden" name="label" value="ERROR">
                        <input type="hidden" name="successURL" value="<?php echo get_permalink();?>">
                    </form>
                </li>
            </ul>
        </div>
        <div class="modal__subcontent">
            Оплачивая, вы даёте <a class="modal__subcontent-link" href="<?php echo $site_url ;?>/policy" title="Нажмите, для просмотра " target="_blank">согласие на обработку персональных данных</a>
        </div>
    </div>
    <div class="modal__close" title="Закрыть"></div>
</div>