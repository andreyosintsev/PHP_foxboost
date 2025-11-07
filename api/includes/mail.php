<?php
if (!defined('ABSPATH')) {
    require_once dirname(__DIR__, 2) . '/wp-load.php';
    require_once dirname(__DIR__, 1) . '/config/config-mail.php';
}
/**
 * Функция отправки письма с подтверждением e-mail с регистрации
 *
 * @param string $name - имя подписчика
 * @param string $email - электронная почта для письма
 * @param string $token - токен авторизации
 * @param int $foxboost_id - ID записи фоксбуста, на который сразу же нужно подписаться после регистрации
 *
 * @return bool - успех отправки e-mail
 */
function mailSendConfirmation($name, $email, $token, $foxboost_id) {
    mb_internal_encoding("UTF-8");
    date_default_timezone_set('Europe/Samara');

    $logDir = ABSPATH . 'logs/mail';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $logFileName = $logDir . '/'.date("Y_m_d_H-i-s").'-mail.txt';
    $logFile = fopen($logFileName, "w");

    //Создание лог-файла поиска
    writeLog('===========MAIL==========', $logFile);
    writeLog('MailSendConfirmation', $logFile);
    writeLog('Checking input data', $logFile);
    writeLog('Name: '. $name, $logFile);
    writeLog('Email: '. $email, $logFile);
    writeLog('Token: '. $token, $logFile);

    if (empty($name) || empty($email) || empty($token)) {
        writeLog('ERROR: empty mail, email or token, exiting', $logFile);
        fclose($logFile);

        return false;
    }

    writeLog('Loading template file: '. TEMPLATE_EMAIL_REGISTRATION, $logFile);

    $template = @file_get_contents(TEMPLATE_EMAIL_DIR . TEMPLATE_EMAIL_REGISTRATION);
    if ($template === false) {
        writeLog('ERROR: cannot read template file, exiting', $logFile);
        fclose($logFile);

        return false;
    }

    $activateUrl = SITE_LINK . '/activate?token=' . rawurlencode($token) . '&foxboost_id=' . rawurlencode($foxboost_id);
    $unregisterUrl = SITE_LINK . '/unregister?token=' . rawurlencode($token);

    $args = [
        'site_name' => SITE_NAME,
        'subscriber_name' => $name,
        'link_activate'   => '<a href="' . htmlspecialchars($activateUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">'
            . htmlspecialchars($activateUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</a>',
        'link_unregister' => '<a href="' . htmlspecialchars($unregisterUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">Отменить регистрацию</a>'
    ];

    $templateHydrated = mailHydrate($template, $args);
    if (empty($templateHydrated)) {
        writeLog('WARNING: cannot hydrate email template, using raw template, continue...', $logFile);
        $templateHydrated = $template;
    }

    $plainText = strip_tags(str_replace(["\r","\n"], ' ', $templateHydrated));
    $plainText = html_entity_decode($plainText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    $eol = "\r\n";
    $boundaryRelated = "=_rel_" . md5(uniqid((string)microtime(true), true));
    $boundaryAlt = "=_alt_" . md5(uniqid((string)microtime(true), true));

    $subject_text = "Регистрация на сайте " . SITE_NAME;
    if (function_exists('mb_encode_mimeheader')) {
        $subject = mb_encode_mimeheader($subject_text, 'UTF-8', 'B', $eol);
    } else {
        $subject = "=?UTF-8?B?" . base64_encode($subject_text) . "?=";
    }

    writeLog('SUBJECT: '. $subject_text, $logFile);
    writeLog('SUBJECT ENCODED: '. $subject, $logFile);

    $fileLogo = TEMPLATE_EMAIL_LOGO; // предполагается путь или пусто
    $hasLogo = false;
    $logoContentEncoded = '';
    $logoFilename = '';
    $logoMime = '';

    if (!empty($fileLogo) && file_exists($fileLogo) && is_readable($fileLogo)) {
        $logoFilename = basename($fileLogo);
        $fileData = @file_get_contents($fileLogo);
        if ($fileData !== false) {
            // определяем mime-type
            if (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $logoMime = finfo_buffer($finfo, $fileData);
                finfo_close($finfo);
            } else if (function_exists('mime_content_type')) {
                $logoMime = mime_content_type($fileLogo);
            } else {
                // fallback по расширению
                $ext = strtolower(pathinfo($logoFilename, PATHINFO_EXTENSION));
                $map = ['png'=>'image/png','jpg'=>'image/jpeg','jpeg'=>'image/jpeg','gif'=>'image/gif'];
                $logoMime = $map[$ext] ?? 'application/octet-stream';
            }

            // допускаем только image/* для inline
            if (strpos($logoMime, 'image/') === 0) {
                $logoContentEncoded = chunk_split(base64_encode($fileData));
                $hasLogo = true;

                writeLog('LOGO: logo successfully added', $logFile);
            } else {
                writeLog(__METHOD__ . ": WARNING, logo mime not image/*: $logoMime", $logFile);
            }
        } else {
            writeLog(__METHOD__ . ": WARNING, cannot read logo file data: $fileLogo", $logFile);
        }
    } else {
        if (!empty($fileLogo)) writeLog('WARNING: cannot load logo, continue...', $logFile);
    }

    $fromAddress = SITE_EMAIL_FROM;
    $fromHeader = 'From: ' . $fromAddress;
    // если есть имя отправителя в SITE (опционально), можно кодировать его:
    if (defined('SITE_EMAIL_NAME') && SITE_EMAIL_NAME !== '') {
        $nameEncoded = (function($s) use ($eol) {
            return (function_exists('mb_encode_mimeheader'))
                ? mb_encode_mimeheader($s, 'UTF-8', 'B', $eol)
                : "=?UTF-8?B?" . base64_encode($s) . "?=";
        })(SITE_EMAIL_NAME);
        $fromHeader = 'From: ' . $nameEncoded . ' <' . $fromAddress . '>';
    }

    $headers = $fromHeader . $eol;
    $headers .= "Reply-To: " . $fromAddress . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= 'Content-Type: multipart/related; boundary="' . $boundaryRelated . '"' . $eol;

    $body = "--" . $boundaryRelated . $eol;
    $body .= 'Content-Type: multipart/alternative; boundary="' . $boundaryAlt . '"' . $eol . $eol;

    $body .= "--" . $boundaryAlt . $eol;
    $body .= "Content-Type: text/plain; charset=UTF-8" . $eol;
    $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
    $body .= $plainText . $eol . $eol;

    $body .= "--" . $boundaryAlt . $eol;
    $body .= "Content-Type: text/html; charset=UTF-8" . $eol;
    $body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;

    $body .= $templateHydrated . $eol . $eol;
    $body .= "--" . $boundaryAlt . "--" . $eol . $eol;

    if ($hasLogo) {
        $body .= "--" . $boundaryRelated . $eol;
        $body .= "Content-Type: " . $logoMime . '; name="' . $logoFilename . '"' . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-ID: <logo_cid>" . $eol;
        $body .= "Content-Disposition: inline; filename=\"" . $logoFilename . "\"" . $eol . $eol;
        $body .= $logoContentEncoded . $eol . $eol;
    }

    $body .= "--" . $boundaryRelated . "--" . $eol;

    // дополнительный параметр -f для корректного envelope sender (если поддерживается)
    $params = '';
    if (!empty($fromAddress) && strpos(PHP_OS, 'WIN') === false) { // -f не всегда работает на Windows
        $params = '-f' . escapeshellarg($fromAddress);
    }

    $sent = mail($email, $subject, $body, $headers, $params ?: null);
    if ($sent === false) {
        writeLog('ERROR: mail() returned false, exiting...', $logFile);
        fclose($logFile);

        return false;
    }

    writeLog('SUCCESS: mail() returned true.', $logFile);
    fclose($logFile);

    return true;
}
?>
<?php
/**
 * Функция замены тегов в почтовом сообщении фактическими данными.
 *
 * @param string $template - шаблон почтового сообщения
 * @param $args - ассоциативный массив тегов и значений
 *  site_name - наименование сайта foxboost.ru
 *  link_activate - html-ссылка для активации учетной записи
 *  link_unregister - html-ссылка для отмены регистрации учетной записи
 *
 * @return string - насыщенное сообщение
 */
function mailHydrate(string $template, $args): string {
    foreach ($args as $key => $value) {
        // Поддержка пробелов внутри скобок, например {{ site_name }}
        $pattern = '/{{\s*' . preg_quote($key, '/') . '\s*}}/u';
        $template = preg_replace($pattern, $value, $template);
    }

    $template = preg_replace('/{{\s*[\w\-]+\s*}}/', '', $template);

    return $template;
}
