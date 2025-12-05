<?php
require_once dirname(__DIR__) . '/wp-load.php';
require_once dirname(__DIR__, 1) . '/api/includes/db.php';

$foxboost_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if (!$foxboost_id) {
    echo json_encode([
        'success' => false,
        'post_id' => $foxboost_id,
        'message' => 'Неверный ID записи']
    );
    exit;
}

$res = sqlGetSubscriptionIdsByFoxboostId($foxboost_id);

echo json_encode([
    'success' => true,
    'post_id' => $foxboost_id,
    'subscription_ids' => $res
]);