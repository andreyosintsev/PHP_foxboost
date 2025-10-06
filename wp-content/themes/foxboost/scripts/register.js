const base_url = 'http://localhost/wordpress.local';

let d_id = '';    //id записи, сертификат или приложение из которой пользователь пытается скачать
let d_link = '';  //1 - попытка скачивания сертфииката, 2 - приложения

$(function () {
    console.log('jQuery runs!');
    /* Нажатие кнопки ВОЙТИ И СКАЧАТЬ */
    $("#log-proceed").click(function(event){
        $error = false;
        if ($('input[name="log-login"]').val() == '') {
            $('input[name="log-login"]').addClass('modal__text_error');
            $('input[name="log-login"]').val('Необходимо указать e-mail');
            $error = true;
        }

        const pattern = /.+@.+\..+/i;
        if (!pattern.test($('input[name="log-login"]').val())) {
            $('input[name="log-login"]').addClass('modal__text_error');
            $('input[name="log-login"]').val('Неверный адрес e-mail');
            $error = true;
        }

        if ($('input[name="log-pass"]').val() == '') {
            $('input[name="log-pass"]').addClass('modal__text_error');
            $('input[name="log-pass"]').val('Необходимо ввести пароль');
            $error = true;
        }

        if (!$error) {
            doAjaxLogin('log-ajax', `${base_url}/api/login.php`, d_link, d_id);
        }
    });

    /*Нажатие кнопки ЗАРЕГИСТРИРОВАТЬСЯ*/
    $("#reg-proceed").click(function(event){
        $error = false;
        if ($('input[name="reg-login"]').val() == '') {
            $('input[name="reg-login"]').addClass('modal__text_error');
            $('input[name="reg-login"]').val('Необходимо указать e-mail');

            $error = true;
        }

        const pattern = /.+@.+\..+/i;
        if (!pattern.test($('input[name="reg-login"]').val())) {
            $('input[name="reg-login"]').addClass('modal__text_error');
            $('input[name="reg-login"]').val('Неверный адрес e-mail');

            $error = true;
        }

        if ($('input[name="reg-pass"]').val() == '') {
            $('input[name="reg-pass"]').addClass('modal__text_error');
            $('input[name="reg-pass"]').val('Необходимо ввести пароль');
          
            $error = true;
        }

        if ($('input[name="reg-pass-confirm"]').val() == '') {
            $('input[name="reg-pass-confirm"]').addClass('modal__text_error');
            $('input[name="reg-pass-confirm"]').val('Необходимо еще раз ввести пароль');
          
            $error = true;
        }

        if ($('input[name="reg-pass-confirm"]').val() != $('input[name="reg-pass"]').val()) {
            $('input[name="reg-pass-confirm"]').addClass('modal__text_error');
            $('input[name="reg-pass-confirm"]').val('Введенные пароли не совпадают');
          
            $error = true;
        }
        
        if (!$error) {
            doAjaxRegister('reg-ajax',`${base_url}/api/register.php`);
        }
    });

    /*Нажатие кнопки СКАЧАТЬ СЕРТИФИКАТ или СКАЧАТЬ ПРИЛОЖЕНИЕ*/
    $('.specs__download_certify').click(function(event) {
        /*Проверка, залогинен ли пользователь*/
        d_link = '1'; //П
        d_id = event.target.dataset.id;
       	checkAjaxLogin(`${base_url}/api/check-login.php`, '1', d_id);
    });
    $('.specs__download_appendix').click(function(event) {
        /*Проверка, залогинен ли пользователь*/
        d_link = '2';
        d_id = event.target.dataset.id;
       	checkAjaxLogin(`${base_url}/api/check-login.php`, '2', d_id);
    });

    /*Сброс ошибок формы входа*/
    $('input[name="log-login"]').focus(function(){
        $('input[name="log-login"]').val('');
        $('input[name="log-login"]').removeClass('modal__text_error');
    });
    $('input[name="log-pass"]').focus(function(){
        $('input[name="log-pass"]').val('');
        $('input[name="log-pass"]').removeClass('modal__text_error');
    });

    /*Сброс ошибок формы сброса пароля*/
    $('input[name="restore"]').focus(function(){
        $('input[name="restore"]').val('');
        $('input[name="restore"]').removeClass('modal__text_error');
    });

    /*Сброс ошибок формы регистрации*/
    $('input[name="reg-login"]').focus(function(){
        $('input[name="reg-login"]').val('');
        $('input[name="reg-login"]').removeClass('modal__text_error');
    });
    $('input[name="reg-pass"]').focus(function(){
        $('input[name="reg-pass"]').val('');
        $('input[name="reg-pass"]').removeClass('modal__text_error');
    });
    $('input[name="reg-pass-confirm"]').focus(function(){
        $('input[name="reg-pass-confirm"]').val('')
        $('input[name="reg-pass-confirm"]').removeClass('modal__text_error');
    });

    /*Нажатие ссылки ЗАБЫЛИ ПАРОЛЬ?*/
    $("#log-restore-email").click(function(){
        hideLogin();
        showReset();
    })

    /*Нажатие кнопки ПОЛУЧИТЬ ПАРОЛЬ НА E-MAIL*/
    $("#restore-proceed").click(function(event){
        if ($('input[name="restore"]').val() == '') {
            $('input[name="restore"]').addClass('modal__text_error');
            $('input[name="restore"]').val('Необходимо указать e-mail');

            return;
        }

        const pattern = /.+@.+\..+/i;
        if (!pattern.test($('input[name="restore"]').val())) {
            $('input[name="restore"]').addClass('modal__text_error');
            $('input[name="restore"]').val('Неверный адрес e-mail');

            return;
        }

        restoreAjaxPass('restore-ajax', `${base_url}/api/restore.php`);
    })

    /*Нажатие кнопки ОТМЕНА окна забыли пароль*/
    $("#restore-cancel").click(function(){
        hideReset();
    })

    /*Нажатие кнопки ЗАРЕГИСТРИРОВАТЬ НОВУЮ УЧЕТНУЮ ЗАПИСЬ*/
    $("#log-register").click(function(event){
        hideLogin();
        showRegister();
    });

    /*Нажатие кнопки УЖЕ ЕСТЬ УЧЁТНАЯ ЗАПИСЬ ВОЙДИТЕ окна регистрации*/
    $("#register-cancel").click(function(){
        hideRegister();
        showLogin();
    })
});
/**
 * Функция отправляет запрос файлу check-login.php
 * для проверки залогиненности пользователя
 *
 * @param url - url файла check-login.php
 * @param link - 1 - сертификат, 2 - приложение
 * @param id - postId записи с сертификатом
 */
function checkAjaxLogin(url, link, id) {
    $('#wait').show();
    jQuery.ajax({
        url:      url, //url страницы (check-login.php)
        method:   "get", //метод отправки
        dataType: "html", //формат данных
        data: {
            p_id: id
        },
        cache: false,
        success: function(response) { //Данные отправлены успешно
            $('#wait').hide();
            let result = '';
            try {
                result = jQuery.parseJSON(response);
            } catch (error) {
                console.error('Неверный ответ от сервера: ', response);
                return;
            }
            if (result.auth) {
                //Отдать файл
                downloadFile(`${base_url}/api/download-count.php?id=${id}&link=${link}&direct=true`);
            } else {
                showLogin();
            }
        },
        error: function(xhr, status, error) { // Данные не отправлены
            $('#wait').hide();
        }
    });
}
/**
 * Функция отправляет запрос файлу login.php
 * для логина пользователя
 *
 * @param ajax_form - id формы с логином и паролем для входа
 * @param url - url файла login.php
 * @param link - 1 - сертификат, 2 - приложение
 * @param id - postId записи с сертификатом
 */
function doAjaxLogin(ajax_form, url, link, id) {
    $('#wait').show();
    jQuery.ajax({
        url:      url,      //url страницы (login.php)
        type:     "POST",   //метод отправки
        dataType: "html",   //формат данных
        data: jQuery("#"+ajax_form).serialize(),  // Сериализуем объект
        success: function(response) { //Данные отправлены успешно
            $('#wait').hide();
            let result = '';
            try {
                result = jQuery.parseJSON(response);
            } catch (error) {
                $('input[name="log-pass"]').val('Неверный ответ от сервера');
                $('input[name="log-pass"]').addClass('modal__text_error');
                console.error('Неверный ответ от сервера: ', response);
                return;
            }
            if (result.auth) {
                hideLogin();
                downloadFile(`${base_url}/api/download-count.php?id=${id}&link=${link}&direct=true`);
            } else {
                $('input[name="log-pass"]').val(result.msg);
                $('input[name="log-pass"]').addClass('modal__text_error');
            }
        },
        error: function(response) { // Данные не отправлены
            $('#wait').hide();
            $('input[name="log-pass"]').val('Ошибка соединения с сервером');
            $('input[name="log-pass"]').addClass('modal__text_error');
        }
    });
}

/**
 * Функция отправляет запрос файлу register.php
 * для регистрации пользователя
 *
 * @param ajax_form - id формы регистрации с логином и паролями
 * @param url - url файла register.php
 */
function doAjaxRegister(ajax_form, url) {
    $('#wait').show();
    jQuery.ajax({
        url:      url, //url страницы (register.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: jQuery("#"+ajax_form).serialize(),  // Сериализуем объект
        success: function(response) { //Данные отправлены успешно
            $('#wait').hide();
            let result = '';
            try {
                result = jQuery.parseJSON(response);
            } catch (error) {
                $('input[name="reg-pass-confirm"]').addClass('modal__text_error');
                $('input[name="reg-pass-confirm"]').val('Неверный ответ от сервера');
                console.error('Неверный ответ от сервера: ', response);
                return;
            }
            if (result.auth) {
                //Регистрация прошла успешно, переходим к оплате
                hideRegister();
                showRegister2();
                doPayment(result.id);
            } else {
                //Регистрация не удалась
                $('input[name="reg-pass-confirm"]').addClass('modal__text_error');
                $('input[name="reg-pass-confirm"]').val(result.msg);
            }
        },
        error: function(response) { // Данные не отправлены
            $('#wait').hide();
            $('input[name="reg-pass-confirm"]').addClass('modal__text_error');
            $('input[name="reg-pass-confirm"]').val('Ошибка соединения с сервером');
        }
    });
}
/**
 * Функция отправляет запрос файлу restore.php
 * для восстановления пароля пользователя
 *
 * @param ajax_form - id формы с логином для восстановления
 * @param url - url файла restore.php
 */
function restoreAjaxPass(ajax_form, url) {
    $('#wait').show();
    jQuery.ajax({
        url:      url, //url страницы (restore.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: jQuery("#"+ajax_form).serialize(),  // Сериализуем объект
        success: function(response) { //Данные отправлены успешно
            $('#wait').hide();
            let result = '';
            try {
                result = jQuery.parseJSON(response);
            } catch (error) {
                $('input[name="restore"]').addClass('modal__text_error');
                $('input[name="restore"]').val('Неверный ответ от сервера');
                console.error('Неверный ответ от сервера: ', response);
                return;
            }
            if (result.success) {
                $('input[name="restore"]').val('Новый пароль отправлен на указанный E-mail');
            } else {
                $('input[name="restore"]').addClass('modal__text_error');
                $('input[name="restore"]').val('E-mail не зарегистрирован на сайте');
            }
        },
        error: function(response) { // Данные не отправлены
            $('#wait').hide();
            $('input[name="restore"]').addClass('modal__text_error');
            $('input[name="restore"]').val('Ошибка соединения с сервером');
        }
    });
}
function clearErrors() {
    //Очистка ошибок формы логина
    $('input[name="log-login"]').val('');
    $('input[name="log-login"]').removeClass('modal__text_error');

    $('input[name="log-pass"]').val('');
    $('input[name="log-pass"]').removeClass('modal__text_error');

    //Скрытие окна логина
    $('.modal-login').removeClass('modal_visible');

    //Очистка ошибок формы восстановления пароля
    $('input[name="restore"]').val('');
    $('input[name="restore"]').removeClass('modal__text_error');

    //Скрытие окна восстановления пароля
    $('.modal-reset-password').removeClass('modal_visible');

    //Очистка ошибок формы регистрации
    $('input[name="reg-login"]').val('');
    $('input[name="reg-login"]').removeClass('modal__text_error');

    $('input[name="reg-pass"]').val('');
    $('input[name="reg-pass"]').removeClass('modal__text_error');

    $('input[name="reg-pass-confirm"]').val('');
    $('input[name="reg-pass-confirm"]').removeClass('modal__text_error');
}
function showLogin() {
	//Вывести окно регистрации
    clearErrors();

    $('.modal-login').addClass('modal_visible');
    $('.modal-overlay').addClass('modal-overlay_visible');
    $(document.body).addClass('no-scroll');
}
function hideLogin() {
    //Скрыть окно регистрации

    $('.modal-login').removeClass('modal_visible');
    $('.modal-overlay').removeClass('modal-overlay_visible');
    $(document.body).removeClass('no-scroll');
}
function showReset() {
    //Вывести окно сброса пароля
    clearErrors();

    $('.modal-reset-password').addClass('modal_visible');
    $('.modal-overlay').addClass('modal-overlay_visible');
    $(document.body).addClass('no-scroll');
}
function hideReset() {
    //Скрыть окно сброса пароля

    $('.modal-reset-password').removeClass('modal_visible');
    $('.modal-overlay').removeClass('modal-overlay_visible');
    $(document.body).removeClass('no-scroll');
}
function showRegister() {
    //Вывести окно регистрации
    clearErrors();

    $('.modal-reg').addClass('modal_visible');
    $('.modal-overlay').addClass('modal-overlay_visible');
    $(document.body).addClass('no-scroll');
}
function hideRegister() {
    //Вывести окно регистрации
    clearErrors();

    $('.modal-reg').removeClass('modal_visible');
    $('.modal-overlay').removeClass('modal-overlay_visible');
    $(document.body).removeClass('no-scroll');
}
function showRegister2() {
    //Вывести окно регистрации
    clearErrors();

    $('.modal-reg2').addClass('modal_visible');
    $('.modal-overlay').addClass('modal-overlay_visible');
    $(document.body).addClass('no-scroll');
}
function hideRegister2() {
    //Вывести окно регистрации
    clearErrors();

    $('.modal-reg2').removeClass('modal_visible');
    $('.modal-overlay').removeClass('modal-overlay_visible');
    $(document.body).removeClass('no-scroll');
}
function downloadFile(url) {
    document.location.href = url;
}
function doPayment(id) {
    $("#yandexCardRefillForm input[name=targets]:hidden").val('Регистрация на сайте rostest-certify.ru (ID = ' + id + ')');
    $("#yandexCardRefillForm input[name=label]:hidden").val(id);
    $("#yandexYadRefillForm input[name=targets]:hidden").val('Регистрация на сайте rostest-certify.ru (ID = ' + id + ')');
    $("#yandexYadRefillForm input[name=label]:hidden").val(id);
    $("#yandexMobileRefillForm input[name=targets]:hidden").val('Регистрация на сайте rostest-certify.ru (ID = ' + id + ')');
    $("#yandexMobileRefillForm input[name=label]:hidden").val(id);
}