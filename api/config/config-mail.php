<?php
/**
 * Файл настройки почтовой рассылки, адресов администратора и пр.
 */

define('SITE_NAME',                     'foxboost.ru');              //Наименование сайта для уведомлений
define('SITE_LINK',                     'https://bestweb.site/demo/foxboost');    //Ссылка на сайт
define('SITE_EMAIL_FROM',               'info@bestweb.site');        //E-mail для поля "от"
define('SITE_EMAIL_ADMIN',              'asosintsev@yandex.ru');     //E-mail для уведомлений администратора

/*
 * Шаблоны писем с уведомлениями для пользователя
 */
define('TEMPLATE_EMAIL_DIR',  dirname(__DIR__, 2). '/templates/emails/');                 //Каталог с шаблонами писем
define('TEMPLATE_EMAIL_LOGO', dirname(__DIR__, 2). '/templates/emails/images/logo.jpg');  //Логотип шапки письма

define('TEMPLATE_EMAIL_REGISTRATION',   'registration.html');   //"Вы зарегистрировались на сайте"
define('TEMPLATE_EMAIL_ACTIVATION',     'activation.html');     //"Учетная запись активирована"
define('TEMPLATE_EMAIL_DEACTIVATION',   'deactivation.html');   //"Учетная запись деактивирована"
define('TEMPLATE_EMAIL_SUBSCRIBE',      'subscribe.html');      //"Вы подписались на фоксбуст"
define('TEMPLATE_EMAIL_UNSUBSCRIBE',    'unsubscribe.html');    //"Вы отподписались от фоксбуста"
define('TEMPLATE_EMAIL_ORDER',          'order.html');          //"Товар доступен для заказа"

