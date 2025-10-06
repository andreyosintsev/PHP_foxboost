<?php
/**
 * forms/form-register.php
 *
 * The partial for displaying the registration form.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $totalCertificates = round (wp_count_posts()->publish,-2, PHP_ROUND_HALF_DOWN);
?>
<!--Форма регистрации-->
<div class="modal modal-reg">
    <div class="modal__header">
        <div class="modal__title">
            Регистрация
        </div>
        <div class="modal__subtitle">
            Создайте новую учётную запись, чтобы скачивать сертификаты соответствия
        </div>
    </div>
    <div class="modal__content">
        <form name="reg"
              id="reg-ajax"
              class="reg-form"
              action="<?php echo get_permalink();?>"
              method="post">
            <ul class="modal__benefits">
                <li class="modal__benefit">Неограниченное количество скачиваний</li>
                <li class="modal__benefit">Более <?php echo $totalCertificates; ?> сертификатов и деклараций</li>
                <li class="modal__benefit">Изображения документов высокого качества</li>
                <li class="modal__benefit">Регулярное пополнение базы документов</li>
            </ul>
            <div class="modal__line"></div>
            <div class="modal__group">
                <label class="modal__label">E-mail для входа:</label>
                <input class="modal__text"
                       type="text"
                       name="reg-login"
                       size="10"
                       maxlength="100"
                       placeholder="Введите E-mail"
                >
            </div>
            <div class="modal__group">
                <label class="modal__label">Придумайте пароль:</label>
                <input class="modal__text"
                       type="text"
                       name="reg-pass"
                       size="10"
                       maxlength="100"
                       placeholder="Введите пароль"
                >
            </div>
            <div class="modal__group">
                <label class="modal__label">Повторите пароль:</label>
                <input class="modal__text"
                       type="text"
                       name="reg-pass-confirm"
                       size="10"
                       maxlength="100"
                       placeholder="Введите пароль"
                >
            </div>
            <div class="button modal__button" id="reg-proceed">
                Продолжить
            </div>
        </form>
        <div class="modal__subcontent">
            Уже есть учётная запись? <span class="modal__subcontent-link" id="register-cancel" title="Нажмите, чтобы войти">Войдите!</span>
        </div>
    </div>
    <div class="modal__close" title="Закрыть"></div>
</div>