<?php
require_once dirname(__DIR__) . '/wp-load.php';
require_once dirname(__DIR__, 1) . '/api/includes/db.php';

$subscriber_id = isset($_GET['subscriber_id']) ? intval($_GET['subscriber_id']) : 0;

if (!$subscriber_id) {
    echo json_encode([
        'success' => false,
        'post_id' => $subscriber_id,
        'message' => 'Неверный ID подписчика']
    );
    exit;
}

$res = sqlGetSubscriberInfo($subscriber_id);

echo json_encode([
    'success' => true,
    'subscriber_id' => $subscriber_id,
    'name' => $res->name,
    'email' => $res->email,
    'tel' => $res->tel,
    'promocode' => $res->promocode
]);