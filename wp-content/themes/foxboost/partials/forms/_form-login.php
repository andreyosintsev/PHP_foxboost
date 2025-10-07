<?php
/**
 * forms/form-login.php
 *
 * The partial for displaying the login form.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<!--Форма входа-->
<div class="modal modal-login">
    <div class="modal__header">
        <div class="modal__title">
            Скачивание сертификата
        </div>
        <div class="modal__subtitle">
            Чтобы скачать сертификат необходимо войти или зарегистрироваться
        </div>
    </div>
    <div class="modal__content">
        <form name="log"
              id="log-ajax"
              class="log-form"
              action="<?php echo get_permalink();?>"
              method="post">
            <div class="modal__line"></div>
            <div class="modal__group">
                <label class="modal__label">E-mail:</label>
                <input class="modal__text"
                       type="text"
                       name="log-login"
                       size="10"
                       maxlength="100"
                       placeholder="Введите E-mail"
                >
            </div>
            <div class="modal__group">
                <label class="modal__label">Пароль:</label>
                <input class="modal__text"
                       type="text"
                       name="log-pass"
                       size="10"
                       maxlength="100"
                       placeholder="Введите пароль"
                >
                <p class="modal__link modal__link_right" id="log-restore-email">Забыли пароль?</p>
            </div>
            <button class="button modal__button"
                    id="log-proceed"
                    type="button"
                    name="submit"
                    title="Нажмите, чтобы войти на сайт и скачать сертификат или приложение"
                    autofocus>
                Войти и скачать
            </button>
        </form>
        <div class="modal__subcontent">
            Ещё нет учётной записи? <span class="modal__subcontent-link" id="log-register">Зарегистрируйтесь!</span>
        </div>
    </div>
    <div class="modal__close" title="Закрыть"></div>
</div>