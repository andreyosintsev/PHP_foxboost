<?php
/**
 * forms/form-reset-password.php
 *
 * The partial for displaying the password reset form.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<!--Форма сброса пароля-->
<div class="modal modal-reset-password">
    <div class="modal__header">
        <div class="modal__title">
            Забыли пароль?
        </div>
        <div class="modal__subtitle">
            Мы вышлем новый пароль на e-mail, указанный при регистрации
        </div>
    </div>
    <div class="modal__content">
        <form name="restore"
              id="restore-ajax"
              class="restore-form"
              action="<?php echo get_permalink();?>"
              method="post">
            <div class="modal__line"></div>
            <div class="modal__group">
                <label class="modal__label">E-mail:</label>
                <input class="modal__text"
                       type="text"
                       name="restore"
                       size="10"
                       maxlength="100"
                       placeholder="Введите E-mail"
                >
            </div>
            <button class="button modal__button"
                    id="restore-proceed"
                    type="button"
                    name="submit"
                    title="Нажмите, чтобы получить новый пароль на указанный e-mail">
                Получить пароль на E-mail
            </button>
        </form>
        <div class="modal__subcontent">
            <div class="modal__subcontent-link" id="restore-cancel" title="Нажмите, чтобы отменить сброс пароля">Отмена</div>
        </div>
    </div>
    <div class="modal__close" title="Закрыть"></div>
</div>