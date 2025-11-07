<?php
/**
  * Скрипт запускается раз в сутки и проверяет истечение сроков сбора заявок по фоксбустам.
 *  Если время сбора истекло, то переводит запись в состояние pending (сбор завершен)
 */

if (!defined('ABSPATH')) {
    require_once dirname(__DIR__, 1) . '/wp-load.php';
}

mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Samara');

$logDir = ABSPATH . 'logs/cron';
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

$logFileName = $logDir . '/'.date("Y_m_d_H-i-s").'-init.txt';
$logFile = fopen($logFileName, "w");
if (!$logFile) {
    error_log('Cannot open log file: '. $logFileName);
    die('Cannot create log file');
}

writeLog('=========== CRON EXPIRED ==========', $logFile);

$today = current_time('Ymd');

writeLog("Current time: ". $today, $logFile);

$args = [
    'post_type'      => 'foxboost',
    'post_status'    => 'publish',
    'fields'         => 'ids',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => 'datetogo',
            'compare' => 'EXISTS',
        ],
    ],
];

$query = new WP_Query($args);

if ($query->have_posts()) {
    writeLog("Total published foxboosts: ". count($query->posts), $logFile);

    foreach ($query->posts as $post_id) {
        $post_title = get_the_title($post_id);

        writeLog("Foxboost № {$post_id} ({$post_title})", $logFile);

        $datetogo = get_field('datetogo', $post_id, false);
        writeLog("Foxboost datetogo: ". $datetogo, $logFile);

        if (!$datetogo) continue;

        // Приводим дату к формату Y-m-d для корректного сравнения
        if (preg_match('/^\d{8}$/', $datetogo)) {
            $datetogo_formatted = $datetogo;
        } else {
            // иначе пробуем привести к формату Ymd
            $datetogo_formatted = date('Ymd', strtotime($datetogo));
        }

        writeLog("Foxboost datetogo formatted: ". $datetogo_formatted, $logFile);

        // Если дата в будущем — ставим статус pending
        if ($today > $datetogo_formatted) {
            wp_update_post([
                'ID'          => $post_id,
                'post_status' => 'pending',
            ]);

            writeLog("EXPIRED: Foxboost № {$post_id} ({$post_title}) переведён в pending (сбор завершен).", $logFile);
        } else {
            writeLog("NOT EXPIRED: Foxboost № {$post_id} ({$post_title}) оставлен в published (идет сбор заявок).", $logFile);
        }
    }
}

fclose($logFile);

wp_reset_postdata();