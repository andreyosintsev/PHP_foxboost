<?php
/*
* Template Name: Unscubscribe
*
* template-unsubscribe.php
*
* Template file for unsubscribe on foxboost.
* /unsubscribe
*
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2025 asosintsev@yandex.ru
*/

require_once ABSPATH . 'api/config/config-mail.php';
require_once ABSPATH . 'api/includes/db.php';
require_once ABSPATH . 'api/includes/mail.php';

global $wpdb;

$token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';
$foxboost_id = isset($_GET['foxboost_id']) ? sanitize_text_field($_GET['foxboost_id']) : '';

if (!$token || !$foxboost_id) {
    wp_redirect(home_url('/'));
    exit;
}

$user = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM subscribers WHERE token = %s", $token)
);

if ($user) {
    $res = sqlUnsubscribe($user->id, $foxboost_id);

    if (!$res) wp_redirect(home_url());

    $res = mailSendUnsubscribe($user->name, $user->email, $foxboost_id);

    wp_redirect(home_url('/?unsubscribed=1'));
    exit;
}

wp_redirect(home_url());