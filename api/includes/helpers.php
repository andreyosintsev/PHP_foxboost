<?php
/**
 * Хелпер для логирования результата $res при помощи двух возможных сообщений
 * использует метод writeLog().
 *
 * @param $res
 * @param $successMsg
 * @param $failMsg
 * @param $logFile
 * @return void
 */
function logResult($res, $successMsg, $failMsg, $logFile) {
    writeLog($res ? $successMsg : $failMsg, $logFile);
}
?>
<?php
/**
 * Функция отправляет ошибку JSON, закрывает файл лога и завершает скрипт
 *
 * @param $message - строка сообщения об ошибке для JSON
 * @param $logFile - лог-файл
 * @return void
 */
function sendJsonErrorAndExit($message, $logFile) {
    echo json_encode([
        'status' => 'failed',
        'message' => $message
    ]);
    fclose($logFile);
    exit();
}
?>
<?php
/**
 * Функция отправляет успешный JSON и закрывает файл лога, НО СКРИПТ НЕ ЗАВЕРШАЕТ
 *
 * @param $message - строка сообщения успешного JSON
 * @param $type - тип сообщения:
 *      registration - сообщение о регистрации
 *      activation - сообщение об активации учетной записи
 *      subscribe - сообщение о подписке на фоксбуст
 *      unsubscribe - сообщение об отписке от фоксбуста
 * @return void
 */
function sendJsonSuccess($message, $type, $logFile) {
    echo json_encode([
        'status'    => 'success',
        'type'      => $type,
        'message'   => $message
    ]);
    fclose($logFile);
}
