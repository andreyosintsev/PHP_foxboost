<?php
require_once dirname(__DIR__) . '/wp-load.php';
require_once dirname(__DIR__, 1) . '/api/includes/db.php';
require_once dirname(__DIR__, 1) . '/api/includes/mail.php';

$subscription_id = isset($_GET['subscription_id']) ? intval($_GET['subscription_id']) : 0;

if (!$subscription_id) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID подписки: '. $subscription_id]);
    exit;
}

$subscriber_id = sqlGetSubscriberIdBySubscriptionId($subscription_id);

if (!$subscription_id) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID подписчика: '. $subscriber_id]);
    exit;
}

$foxboost_id = sqlGetFoxboostIdBySubscriptionId($subscription_id);

if (!$foxboost_id) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID поста: '. $foxboost_id]);
    exit;
}

$name = sqlGetSubscriberNameById($subscriber_id);
$email = sqlGetSubscriberEmailById($subscriber_id);

if (!($name && $email)) {
    echo json_encode([
        'success' => false,
        'subscriber_id' => $subscriber_id,
        'post_id' => $foxboost_id,
        'message' => 'Отсутствует name или email подписчика'
    ]);

    exit;
}

$res = mailSendOrder($name, $email, $foxboost_id);

if ($res) {
    $res = sqlSetSubscriptionOrderSend($subscription_id);
}

echo json_encode([
    'success' => $res,
    'subscriber_id' => $subscriber_id,
    'post_id' => $foxboost_id,
]);