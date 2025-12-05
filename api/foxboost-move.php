<?php
require_once dirname(__DIR__) . '/wp-load.php';

$direction = [
    'active' => 'publish',
    'completed' => 'pending',
    'archive' => 'draft'
];

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
$move_to = isset($_GET['move_to']) ? sanitize_text_field($_GET['move_to']) : '';
$date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : '';

if (!$post_id) {
    echo json_encode(['success' => false, 'message' => 'Неверный ID записи']);
    exit;
}

if (!array_key_exists($move_to, $direction)) {
    echo json_encode(['success' => false, 'message' => 'Недопустимый тип статуса']);
    exit;
}

if ($move_to === 'active') {

    if (!$date) {
        echo json_encode(['success' => false, 'message' => 'Не передана дата']);
        exit;
    }

    // Обновление ACF поля datetogo
    update_field('datetogo', $date, $post_id);
}

$updated = wp_update_post([
    'ID'          => $post_id,
    'post_status' => $direction[$move_to]
]);

echo json_encode([
    'success' => (bool) $updated,
    'post_id' => $post_id,
    'move_to' => $move_to,
    'date'    => $date ?? null
]);