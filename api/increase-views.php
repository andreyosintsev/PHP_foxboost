<?php
    require_once __DIR__ . '/../wp-load.php';

    $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
    $field   = isset($_GET['field']) ? sanitize_text_field($_GET['field']) : 'views';

    if (!$post_id) {
        echo json_encode(['success' => false, 'message' => 'Неверный ID записи']);
        exit;
    }

    $current_value = (int) get_field($field, $post_id, true);
    $new_value = $current_value + 1;

    $updated = update_field($field, $new_value, $post_id) ? $new_value : -1;

    echo json_encode([
        'success' => (bool) $updated,
        'post_id' => $post_id,
        'field'   => $field,
        'new_value' => $updated ? $new_value : $current_value
    ]);