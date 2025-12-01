<?php
/*
* Template Name: Activation
*
* template-activate.php
*
* Template file for subscriber account activation and foxboost subscribing.
* /activate
*
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2025 asosintsev@yandex.ru
*/

require_once ABSPATH . 'api/config/config-mail.php';
require_once ABSPATH . 'api/includes/mail.php';

global $wpdb;

$token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';
$foxboost_id = isset($_GET['foxboost_id']) ? intval($_GET['foxboost_id']) : 0;

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
        ['active' => 1],
        ['token' => $token]
    );

    $res = mailSendActivation($user->name, $user->email, $user->token);

    if ($foxboost_id) {
        $exists = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*) FROM subscriptions WHERE subscriber_id = %d AND post_id = %d",
                $user->id,
                $foxboost_id
            )
        );

        if (!$exists) {
            $wpdb->insert(
                "subscriptions",
                [
                    'subscriber_id' => $user->id,
                    'post_id' => $foxboost_id,
                    'created_at' => current_time('mysql')
                ]
            );

            $res = mailSendSubscribe($user->name, $user->email, $user->token, $foxboost_id);
        }
    }

    wp_redirect(home_url('/?activated=1'));
    exit;
}

wp_redirect(home_url());