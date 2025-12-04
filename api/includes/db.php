<?php
/**
 * Функция проверки существования таблицы SQL
 * @param string $tableName - наименование таблицы
 *
 * @return string|bool - имя таблицы, если она существует, false - таблица отсутствует
 */
function sqlIsTableExists(string $tableName = '') {
    global $wpdb;

    $query = $wpdb->prepare(
        "SHOW TABLES LIKE %s",
        $tableName
    );

    return (bool)$wpdb->get_var($query);
}
?>
<?php
/**
 * Функция регистрации подписчика
 *
 * @param string $tableName - наименование таблицы
 * @param array{
 *   name: string,
 *   email: string,
 *   tel: string,
 *   promocode?: string
 * } $subscriberParams - параметры подписчика
 *   - name      — имя подписчика
 *   - email     — e-mail подписчика
 *   - tel       — телефон подписчика
 *   - promocode — промокод подписчика (необязательный)
 *   - token     - токен подтверждения операций
 *
 * @return bool - true - успешно зарегистрирован, false - неуспешно
 */
function sqlSubscriberRegister(string $tableName = '', array $subscriberParams = []): bool {
    global $wpdb;

    $name = $subscriberParams['name'];
    $email = $subscriberParams['email'];
    $tel = $subscriberParams['tel'];
    $promocode = $subscriberParams['promocode'] ?? null;
    $token = $subscriberParams['token'];

    if ((empty($name) || empty($email))) return false;

    $result = $wpdb->insert(
        $tableName,
        [
            'name'       => $name,
            'email'      => $email,
            'tel'        => $tel,
            'promocode'  => $promocode,
            'created_at' => current_time('mysql'),
            'token'      => $token,
            'active'     => 0
        ],
        [
            '%s', // имя
            '%s', // e-mail
            '%s', // телефон
            '%s', // промокод
            '%s', // дата создания
            '%s', // токен подтверждения email
            '%d', // активирован ли подписчик
        ]
    );

    return $result !== false;
}
?>
<?php
/**
 * Функция создания таблицы mySQL подписок
 * @param string $tableName - наименование таблицы, по умолчанию 'subscriptions'
 *
 * @return bool - true - успешно, false - неуспешно
 */
function sqlSubscriptionsCreateTable(string $tableName = 'subscriptions'): bool {
    global $wpdb;

    if (empty($tableName)) return false;

    // SQL для создания таблицы
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $tableName (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        subscriber_id bigint(20) UNSIGNED NOT NULL,
        post_id bigint(20) UNSIGNED NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        order_sent datetime DEFAULT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY subscriber_post_unique (subscriber_id,post_id),
        FOREIGN KEY (subscriber_id) REFERENCES subscribers(id) ON DELETE CASCADE,
        FOREIGN KEY (post_id) REFERENCES wp_posts(ID) ON DELETE CASCADE
    ) $charset_collate;";

    // Подключаем функцию dbDelta для создания таблиц
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    return sqlIsTableExists($tableName);
}
?>
<?php
/**
 * Функция создания таблицы mySQL подписчиков
 * @param string $tableName - наименование таблицы
 *
 * @return bool - true - успешно, false - неуспешно
 */
function sqlSubscribersCreateTable(string $tableName = 'subscribers'): bool {
    global $wpdb;

    if (empty($tableName)) return false;

    // SQL для создания таблицы
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $tableName (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        tel varchar(255) DEFAULT NULL,
        promocode varchar(255) DEFAULT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        token varchar(255) NOT NULL,
        active tinyint DEFAULT 0,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";

    // Подключаем функцию dbDelta для создания таблиц
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    return sqlIsTableExists($tableName);
}
?>
<?php
/**
 * Функция проверки наличия подписчика по e-mail
 * @param string $tableName - наименование таблицы подписчиков ('subscribers')
 * @param string $email - e-mail для регистрации
 *
 * @return bool - true - существует, false - не существует
 */
function sqlIsSubscriberExistsByEmail(string $tableName = 'subscribers', string $email = ''): bool {
    if (empty($tableName) || empty($email)) return false;

    global $wpdb;

    $email = trim($email);

    $query = $wpdb->prepare("SELECT COUNT(*) FROM `$tableName` WHERE `email` = %s", $email);
    $count = $wpdb->get_var($query);

    return ($count > 0);
}
?>
<?php
/**
 * Функция проверки, активирован ли подписчик по письму активации
 * @param int $id - ID подписчика
 *
 * @return bool - true - активирован, false - не активирован
 */
function sqlIsSubscriberActive($id) {
    if (empty($id)) return false;

    global $wpdb;

    $tableName = 'subscribers';

    $query = $wpdb->prepare("SELECT active FROM `$tableName` WHERE `id` = %d LIMIT 1", $id);
    $active = $wpdb->get_var($query);

    return (bool)$active;
}
?>
<?php
/**
 * Функция подписки подписчика на фоксбуст
 * @param int $subscriberId - ID подписчика
 * @param int $foxboostId - ID фоксбуста, на который надо подписаться
 * @return bool - true - подписка успешно выполнена, false - подписаться не удалось
 *
 */
function sqlSubscribe($subscriberId, $foxboostId) {
    if (empty($subscriberId) || empty($foxboostId)) return false;

    global $wpdb;

    $tableName = 'subscriptions';

    //Проверим, может быть пользователь уже подписан на этот фоксбуст
    $exists = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT 1 FROM {$tableName} WHERE subscriber_id = %d AND post_id = %d LIMIT 1",
                $subscriberId,
                $foxboostId
        )
    );

    if ($exists) return true;

    $inserted = $wpdb->insert(
        $tableName,
        [
            'subscriber_id' => $subscriberId,
            'post_id'       => $foxboostId,
            'created_at'    => current_time('mysql')
        ],
        ['%d', '%d', '%s']
    );

    return (bool)$inserted;
}
?>
<?php
/**
 * Функция отписки подписчика от фоксбуста
 *
 * @param int $subscriberId - ID подписчика
 * @param int $foxboostId - ID фоксбуста, от которого нужно отписаться
 * @return bool - true, если отписка успешно выполнена, false в противном случае
 */
function sqlUnsubscribe($subscriberId, $foxboostId) {
    if (empty($subscriberId) || empty($foxboostId)) return false;

    global $wpdb;

    // Имя таблицы (с префиксом WordPress)
    $tableName = 'subscriptions';

    // Проверяем, есть ли подписка
    $exists = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT 1 FROM {$tableName} WHERE subscriber_id = %d AND post_id = %d LIMIT 1",
            $subscriberId,
            $foxboostId
        )
    );

    if (!$exists) {
        return true;
    }

    // Удаляем подписку
    $deleted = $wpdb->delete(
        $tableName,
        [
            'subscriber_id' => $subscriberId,
            'post_id'       => $foxboostId
        ],
        ['%d', '%d']
    );

    return (bool)$deleted;
}
?>
<?php
/**
 * Функция получает id подписчика по его email
 *
 * @param $email
 * @return int|false - id подписчика или false, если подписчика с таким email нет
 */
function sqlGetSubscriberIdByEmail($email = '') {
    if (empty($email)) return false;

    global $wpdb;

    $id = $wpdb->get_var(
        $wpdb->prepare("SELECT id FROM subscribers WHERE email = %s LIMIT 1", $email)
    );

    if ($id === null) return false;

    return (int)$id;
}
?>
<?php
/**
 * Функция получает name подписчика по его id
 *
 * @param $id - id подписчика
 * @return string|false - name подписчика или false, если подписчика с таким id нет
 */
function sqlGetSubscriberNameById($id = '') {
    if (empty($id)) return false;

    global $wpdb;

    $name = $wpdb->get_var(
        $wpdb->prepare("SELECT name FROM subscribers WHERE id = %d LIMIT 1", $id)
    );

    if ($name === null) return false;

    return $name;
}
?>
<?php
/**
 * Функция получает email подписчика по его id
 *
 * @param $id - id подписчика
 * @return string|false - email подписчика или false, если подписчика с таким id нет
 */
function sqlGetSubscriberEmailById($id = '') {
    if (empty($id)) return false;

    global $wpdb;

    $email = $wpdb->get_var(
        $wpdb->prepare("SELECT email FROM subscribers WHERE id = %d LIMIT 1", $id)
    );

    if ($email === null) return false;

    return $email;
}
?>
<?php
/**
 * Функция получает token подписчика по его id
 *
 * @param $id - id подписчика
 * @return string|false - token подписчика или false, если подписчика с таким id нет
 */
function sqlGetSubscriberTokenById($id = '') {
    if (empty($id)) return false;

    global $wpdb;

    $token = $wpdb->get_var(
        $wpdb->prepare("SELECT token FROM subscribers WHERE id = %d LIMIT 1", $id)
    );

    if ($token === null) return false;

    return $token;
}
?>
<?php
/**
 * Функция возвращает общее количество зарегистрировавшихся подписчиков
 *
 * @return int - количество зарегистрировавшихся подписчиков
 */
function sqlGetTotalSubscribers() {
    global $wpdb;

    $tableName = 'subscribers';

    $exists = sqlIsTableExists($tableName);
    if (!$exists) return 0;

    // Если таблица есть — считаем количество активных подписчиков
    $count = $wpdb->get_var("SELECT COUNT(*) FROM `$tableName`");

    return (int)$count;
}
?>
<?php
/**
 * Функция возвращает количество активированных зарегистрировавшихся подписчиков
 *
 * @return int - количество активированных зарегистрировавшихся подписчиков
 */
function sqlGetActiveSubscribers() {
    global $wpdb;

    $tableName = 'subscribers';

    $exists = sqlIsTableExists($tableName);
    if (!$exists) return 0;

    // Если таблица есть — считаем количество активных подписчиков
    $count = $wpdb->get_var("SELECT COUNT(*) FROM `$tableName` WHERE active = 1");

    return (int)$count;
}

/**
 * Функция возвращает количество подписок
 *
 * @return int - количество подписок
 */
function sqlGetTotalSubscriptions() {
    global $wpdb;

    $tableName = 'subscriptions';

    $exists = sqlIsTableExists($tableName);
    if (!$exists) return 0;

    // Если таблица есть — считаем количество активных подписчиков
    $count = $wpdb->get_var("SELECT COUNT(*) FROM `$tableName`");

    return (int)$count;
}
?>
<?php
/**
 * Функция возвращает массив подписок на фоксбуст по его id из базы данных
 *
 * @param int|null $foxboostId int - id фоксбуста (совпадает с номером записи фоксбуста в WP)
 *
 * @return array[] - массив ассоциированных массивов с подписками
 */
function sqlGetSubscriptionsByFoxboostId(?int $foxboostId = null): array {
    global $wpdb;

    if (empty($foxboostId)) return [];

    $sql = $wpdb->prepare(
        "
        SELECT 
            s.id,
            s.name,
            s.email,
            s.tel,
            s.promocode,
            sub.id AS subscription_id,
            sub.order_sent
        FROM subscribers AS s
        INNER JOIN subscriptions AS sub
            ON s.id = sub.subscriber_id
        WHERE sub.post_id = %d
          AND s.active = 1
        ",
        $foxboostId
    );

    $results = $wpdb->get_results($sql, ARRAY_A);

    return $results ?: [];
}
?>
<?php
/**
 * Функция обновления таблицы подписок, что по данной подписке уведомление отправлено
 * @param int $subscription_id - ID подписки
 *
 * @return bool - true - обновлено, false - не обновлено
 */
function sqlSetSubscriptionOrderSend($subscription_id) {
    if ($subscription_id <= 0) {
        return false;
    }

    global $wpdb;

    $table = 'subscriptions';
    $data = [
        'order_sent' => current_time('mysql')
    ];
    $where = ['id' => $subscription_id];

    $updated = $wpdb->update(
        $table,
        $data,
        $where,
        ['%s'],
        ['%d']
    );

    return $updated > 0;
}
?>
<?php
/**
 * Функция получает ID подписчика по ID подписки
 * @param int $subscription_id - ID подписки
 *
 * @return int | bool - ID подписчика или false, если не найдено
 */
function sqlGetSubscriberIdBySubscriptionId($subscription_id) {
    if ($subscription_id <= 0) {
        return false;
    }

    global $wpdb;

    $subscriber_id = $wpdb->get_var(
        $wpdb->prepare("SELECT subscriber_id FROM subscriptions WHERE id = %d LIMIT 1", $subscription_id)
    );

    if ($subscriber_id === null) return false;

    return $subscriber_id;
}
?>
<?php
/**
 * Функция получает ID фоксбуста по ID подписки
 * @param int $subscription_id - ID подписки
 *
 * @return int | bool - ID фоксбуста или false, если не найдено
 */
function sqlGetFoxboostIdBySubscriptionId($subscription_id) {
    if ($subscription_id <= 0) {
        return false;
    }

    global $wpdb;

    $post_id = $wpdb->get_var(
        $wpdb->prepare("SELECT post_id FROM subscriptions WHERE id = %d LIMIT 1", $subscription_id)
    );

    if ($post_id === null) return false;

    return $post_id;
}
