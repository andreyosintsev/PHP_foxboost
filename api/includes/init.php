<?php
if (php_sapi_name() !== 'cli' && basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    http_response_code(403);
}

if (!defined('ABSPATH')) {
    require_once dirname(__DIR__, 2) . '/wp-load.php';
    require_once dirname(__DIR__, 1). '/config/config-mail.php';
    require_once __DIR__. '/helpers.php';
    require_once __DIR__. '/db.php';
    require_once __DIR__. '/mail.php';
}

mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Samara');

$logDir = ABSPATH . 'logs/api';
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

$logFileName = $logDir . '/'.date("Y_m_d_H-i-s").'-init.txt';
$logFile = fopen($logFileName, "w");
if (!$logFile) {
    error_log('Cannot open log file: '. $logFileName);
    die('Cannot create log file');
}

//Создание лог-файла поиска
writeLog('===========API INIT==========', $logFile);

global $wpdb;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tableNames = [
    'subscribers' => 'sqlSubscribersCreateTable',
    'subscriptions' => 'sqlSubscriptionsCreateTable'
];

$successfulCreated = true;

writeLog('CHECKING TABLES', $logFile);

foreach ($tableNames as $tableName => $createFunc) {
    writeLog('CHECKING TABLE: '. $tableName, $logFile);

    $exists = sqlIsTableExists($tableName);
    writeLog('IS TABLE EXISTS: ' . ($exists ? 'yes' : 'no'), $logFile);

    if ($exists) continue;

    writeLog('TABLE '. $tableName .' NOT EXISTS, trying to create', $logFile);
    $res = call_user_func($createFunc, $tableName);
    logResult($res,
        'TABLE '. $tableName .' CREATED SUCCESSFULLY',
        'FAILED TO CREATE TABLE '. $tableName .' , exiting',
    $logFile);

    if (!$res) {
        $successfulCreated = false;
        break;
    }
}

logResult($successfulCreated,
    'ALL TABLES ARE EXISTS OR CREATED', $logFile,
    'ERROR IN TABLES',
    $logFile);

if (!$successfulCreated) sendJsonErrorAndExit('Ошибка! Не удалось создать таблицы БД', $logFile);

fclose($logFile);