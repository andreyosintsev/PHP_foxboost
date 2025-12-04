<?php
require_once dirname(__DIR__) . '/wp-load.php';
require_once dirname(__DIR__, 1) . '/api/includes/db.php';

$subscriber_id = isset($_GET['subscriber_id']) ? intval($_GET['subscriber_id']) : 0;
$foxboost_id = isset($_GET['foxboost_id']) ? intval($_GET['foxboost_id']) : 0;

if (!$subscriber_id) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID подписчика']);
    exit;
}

if (!$foxboost_id) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID записи']);
    exit;
}

$res = sqlUnsubscribe($subscriber_id, $foxboost_id);

echo json_encode([
    'success' => $res,
    'subscriber_id' => $subscriber_id,
    'post_id' => $foxboost_id,
]);