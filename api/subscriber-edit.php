<?php
error_reporting(0);
ini_set('display_errors', 0);

require_once __DIR__ . '/includes/init.php';

$subscriber_id      = isset($_GET['subscriber_id']) ? intval($_GET['subscriber_id']) : 0;
$name               = isset($_GET['name']) ? sanitize_text_field($_GET['name']) : '';
$email              = isset($_GET['email']) ? sanitize_text_field($_GET['email']) : '';
$tel                = isset($_GET['tel']) ? sanitize_text_field($_GET['tel']) : '';
$promocode          = isset($_GET['promocode']) ? sanitize_text_field($_GET['promocode']) : 'без промокода';

if (empty($subscriber_id) || empty($name) || empty($email)) {
    echo json_encode([
        'success' => false,
        'subscriber_id' => $subscriber_id,
        'message' => 'Не все данные переданы'
    ]);

    exit;
};

$res = sqlSetSubscriberInfo($subscriber_id, $name, $email, $tel, $promocode);

echo json_encode([
    'success' => (bool)$res,
    'subscriber_id' => $subscriber_id,
]);