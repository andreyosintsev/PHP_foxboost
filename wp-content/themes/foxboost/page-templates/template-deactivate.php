<?php
/*
* Template Name: Deactivation
*
* template-deactivate.php
*
* Template file for subscriber account deactivation.
* /deactivate
*
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2025 asosintsev@yandex.ru
*/

require_once ABSPATH . 'api/config/config-mail.php';
require_once ABSPATH . 'api/includes/mail.php';

global $wpdb;

$token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';

if (!$token) {
    wp_redirect(home_url('/'));
    exit;
}

$user = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM subscribers WHERE token = %s", $token)
);

if ($user) {
    $wpdb->update(
        "subscribers",
        ['active' => 0],
        ['token' => $token]
    );

    $res = mailSendDeactivation($user->name, $user->email, $user->token);

    wp_redirect(home_url('/?deactivated=1'));
    exit;
}

wp_redirect(home_url());