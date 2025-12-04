<?php
    error_reporting(0);
    ini_set('display_errors', 0);

    require_once __DIR__ . '/includes/init.php';

    mb_internal_encoding("UTF-8");
    date_default_timezone_set('Europe/Samara');

    $logDir = ABSPATH . 'logs/api';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $logFileName = $logDir . '/'.date("Y_m_d_H-i-s").'-subscribe.txt';
    $logFile = fopen($logFileName, "w");

    //Создание лог-файла поиска
    writeLog('===========API SUBSCRIBE==========', $logFile);
    writeLog('CHECKING POST DATA', $logFile);

    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $tel        = $_POST['tel'] ?? '';
    $product    = $_POST['product'];
    $foxboost_id   = $_POST['foxboost_id'];
    $promocode  = empty($_POST['promocode']) ? 'без промокода' : $_POST['promocode'];
    $token      = mb_substr(md5($name.$email), 0, 8);

    writeLog('POST name: '. $name, $logFile);
    writeLog('POST tel: '. $tel, $logFile);
    writeLog('POST email: '. $email, $logFile);
    writeLog('POST product: '. $product, $logFile);
    writeLog('POST foxboost_id: '. $foxboost_id, $logFile);
    writeLog('POST promocode: '. $promocode, $logFile);

    if (empty($name) || empty($email) || empty($product)) {
        writeLog('POST ERROR: not all data supplied', $logFile);
        sendJsonErrorAndExit('Ошибка! Не все данные переданы', $logFile);
    };

    writeLog('CHECKING USER EXISTENCE: '. $email, $logFile);

    if (!sqlIsSubscriberExistsByEmail('subscribers', $email)) {
        writeLog('NO USER EXISTED, TRYING TO REGISTER', $logFile);

        $subscriberParams = [
            'name' => $name,
            'email' => $email,
            'tel' => $tel,
            'promocode' => $promocode,
            'token' => $token
        ];

        $res = sqlSubscriberRegister('subscribers', $subscriberParams);
        logResult($res,
            'USER REGISTERED SUCCESSFULLY',
            'USER REGISTRATION FAILED',
            $logFile
        );

        if (!$res) sendJsonErrorAndExit('Ошибка! Не удалось зарегистрировать пользователя', $logFile);

        $res = mailSendRegistration($name, $email, $token, $foxboost_id);

        logResult($res,
            'REGISTRATION EMAIL SUCCESSFULLY SENT',
            'FAILED TO SEND REGISTRATION EMAIL',
            $logFile
        );

        if (!$res) sendJsonErrorAndExit('Ошибка! Не удалось отправить e-mail с подтверждением', $logFile);

        sendJsonSuccess('Пользователь зарегистрирован, e-mail с подтверждением отправлен', 'registration', $logFile);
        exit();
    }

    writeLog('USER EXISTS', $logFile);
    writelog('TRYING TO SUBSCRIBE email: '. $email. ' ON foxboost '.$foxboost_id, $logFile);

    $id = sqlGetSubscriberIdByEmail($email);
    logResult((bool)$id,
        'SUBSCRIBER email '. $email .' has ID: '. $id,
        'FAILED TO GET SUBSCRIBER email '. $email .' ID: ',
        $logFile
    );

    if (!$id) {
        sendJsonErrorAndExit('Ошибка! Не удалось получить ID пользователя по его e-mail', $logFile);
    }

    $isActive = sqlIsSubscriberActive($id);
    logResult((bool)$isActive,
        'SUBSCRIBER ID '. $id .' IS ACTIVE',
        'SUBSCRIBER ID '. $id .' IS NOT ACTIVE',
        $logFile
    );

    if (!$isActive) {
        $token = sqlGetSubscriberTokenById($id);
        logResult($token,
            'TOKEN SUCCESSFULLY GOT '. $token,
            'FAILED TO GET TOKEN FOR USER ID '. $id,
            $logFile
        );

        if (!$token) sendJsonErrorAndExit('Ошибка! Не удалось отправить e-mail с подтверждением', $logFile);

        $res = mailSendRegistration($name, $email, $token, $foxboost_id);
        logResult($res,
            'REGISTRATION EMAIL SUCCESSFULLY SENT',
            'FAILED TO SEND REGISTRATION EMAIL',
            $logFile
        );

        if (!$res) sendJsonErrorAndExit('Ошибка! Не удалось отправить e-mail с подтверждением', $logFile);

        sendJsonSuccess('Пользователь зарегистрирован, e-mail с подтверждением отправлен', 'registration', $logFile);
        exit();
    }

    $res = sqlSubscribe($id, $foxboost_id);
    logResult($res,
        'SUBSCRIBER email '. $email .' SUCCESSFULLY SUBSCRIBED ON FOXBOOST ID: '. $foxboost_id,
        'FAILED TO SUBSCRIBE email '. $email .' ON FOXBOOST ID: '. $foxboost_id,
        $logFile
    );

    if ($res) {
        $res = mailSendSubscribe($name, $email, $token, $foxboost_id);
        logResult($res,
            'SUBSCRIPTION EMAIL SUCCESSFULLY SENT',
            'FAILED TO SEND SUBSCRIPTION EMAIL',
            $logFile
        );

        sendJsonSuccess('Успешно подписан на фоксбуст', 'subscribe', $logFile);
    } else {
        sendJsonErrorAndExit('Ошибка! Не удалось подписать на фоксбуст', $logFile);
    }