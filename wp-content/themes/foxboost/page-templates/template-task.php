<?php
/*
Template Name: Task
*
* template-task.php
*
* Template file for the page with certificates that users were looking for.
* /task/
*
* @link        http://rostest-certify.ru/
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2024-2025 asosintsev@yandex.ru
*/
?>
<?php get_header(); ?>
<?php
    date_default_timezone_set('Europe/Samara');

    $site_url            = site_url();
    $template_url        = get_template_directory_uri();

    $isAuth              = isset($_SESSION['auth']);
    $isAdmin             = is_user_logged_in() && current_user_can('administrator') ;

    $period              = in_array($_GET['period'] ?? '', ['month', 'all']) ? $_GET['period'] : 'all';
?>
    <div class="wrapper">
        <div class="hero">
            <div class="hero__content">
                <?php
                    get_template_part('partials/breadcrumbs', null, ['breadcrumbs' => [
                        [ 'content' => 'Необходимые сертификаты' ]
                    ]])
                ?>
                <h1 class="hero__title">
                    Необходимые сертификаты
                </h1>
            </div>
        </div>
        <main class="main">
            <div class="content task">
                <?php if (!$isAuth) { ?>
                    <div class="content__ad">
                        <?php echo getAdContent('horizontal.ad'); ?>
                    </div>
                <?php } ?>
                <div class="task__content">
                    <p>
                        Для развития сайта необходимы сертификаты соответствия.
                    </p>
                    <h2>Вид необходимых сертификатов</h2>
                    <p>
                        Нужны только такие сертификаты, все остальные не нужны
                    </p>
                    <ul class="task__items">
                        <li class="task__item">
                            <img class="task__image"
                                 src="<?php echo $template_url; ?>/images/about/gost_o.jpg"
                                 alt="Сертификат соответствия ГОСТ Р — обязательная сертификация">
                        </li>
                        <li class="task__item">
                            <img class="task__image"
                                 src="<?php echo $template_url; ?>/images/about/gost_d.jpg"
                                 alt="Сертификат соответствия ГОСТ Р — добровольная сертификация">
                        </li>
                        <li class="task__item">
                            <img class="task__image"
                                 src="<?php echo $template_url; ?>/images/about/ss.jpg"
                                 alt="Сертификат соответствия Таможенного союза">
                        </li>
                        <li class="task__item">
                            <img class="task__image"
                                 src="<?php echo $template_url; ?>/images/about/ds.jpg"
                                 alt="Декларация соответствия Таможенного союза">
                        </li>
                    </ul>
                    <h2>Перечень необходимых сертификатов</h2>
                    <p>
                        <b>Важно!</b> Наименование продукции указано в соответствующем разделе сертификата. Сокращения, аббревиатуры и продукция "по-аналогии", а также обобщенные наименования ("ликер" не тоже самое что "алкоголь") не подходят. Допустимы частичное совпадение наименования продукции перечню ("какао-порошок" это тоже "порошок") и словоформы ("окна" это тоже что и "окно").
                    </p>
                    <p>
                        <b>Важно!</b> Сроки действия сертификата или декларации <b>НЕ</b>важны.
                    </p>
                    <p>
                        Для поиска в системе Яндекс или Google щелкните по ссылке рядом.
                    </p>
                </div>
                <div class="task__classificators">
                    <a class="button task__classificator <?php echo $period == 'all' ? '' : 'button_not_active'; ?>"
                       href="?period=all"
                       title="Необходимые сертификаты за все время">
                        За все время
                    </a>
                    <a class="button task__classificator <?php echo $period == 'month' ? '' : 'button_not_active'; ?>"
                       href="?period=month"
                       title="Необходимые сертификаты за все месяц">
                        За месяц
                    </a>
                </div>
                <div class="certificates task__certificates">
                    <?php
                    $date = new DateTime();
                    $date->modify('-1 month');
                    $dateString = $date->format('Y-m-d H:i:s');

                    if ($period == 'month')
                        //Если запрошены запросы за последний месяц
                        $queries = $wpdb->get_col("SELECT search_query FROM wp_search WHERE search_freq > 1 AND search_date > '$dateString' ORDER BY search_freq DESC LIMIT 300");
                    else
                        //Иначе запросы за всё время
                        $queries = $wpdb->get_col("SELECT search_query FROM wp_search WHERE search_freq > 1 ORDER BY search_freq DESC LIMIT 300");

                    $filteredQueries = []; //Запросы, для которых менее трех сертификатов
                    foreach ($queries as $query) {
                        //Выполним поиск по отдельным словам из запроса
                        $words = mb_split("[ ,]+", $query, 5);
                        $num = 0;       // количество найденных запросов на поиск с прямым вхождением

                        foreach ($words as $word) {
                            //Обрежем слово для поиска словоформ с конца
                            //Если слово 4 символа - не обрезаем, 5 символов - обрезаем 1, 6 символов и более - 2

                            if (mb_strlen($word) >= 6) $word = mb_substr($word, 0, -2);
                            else if (mb_strlen($word) == 5) $word = mb_substr($word, 0, -1);

                            $res = $wpdb->get_var($wpdb->prepare("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'post' AND post_title LIKE %s", '%' . $wpdb->esc_like($word) . '%'));

                            $num += (int)$res;
                        }

                        if ($num < 3) $filteredQueries[] = $query;
                    }

                    sort($filteredQueries);

                    $currLetter = '';
                    $isOpened = false;

                    foreach ($filteredQueries as $query) {
                    $firstLetter = mb_substr($query, 0, 1);

                    if ($firstLetter != $currLetter) {
                        if ($isOpened) echo '</div>'; else $isOpened = true; ?>
                        <div class="certificates__chapter"><?php echo $firstLetter; ?></div>
                        <div class="certificates-table">
                            <div class="certificates-table__cell certificates-table__cell_header">
                                Товар или услуга
                            </div>
                            <div class="certificates-table__cell certificates-table__cell_header">
                                Поиск
                            </div>
                            <div class="certificates-table__cell certificates-table__cell_header">

                            </div>

                <?php   $currLetter = $firstLetter;
                    }

                    //Частота запросов
                    $freq = $wpdb->get_var($wpdb->prepare("SELECT search_freq FROM wp_search WHERE search_query LIKE %s", '%' . $wpdb->esc_like($query) . '%'));
                    ?>

                        <div class="certificates-table__cell">
                            <?php echo $query; ?> (<?php echo $freq .' '. declination($freq, ['запрос', 'запроса', 'запросов']); ?>)
                        </div>
                        <div class="certificates-table__cell">
                            <a class="certificates-table__cell-link"
                                href="https://yandex.ru/images/search?text=сертификат соответствия на <?php echo $query; ?>&isize=large"
                                target="_blank">
                                найти в Яндексе
                            </a>
                            <a class="certificates-table__cell-link"
                                href="https://www.google.ru/search?q=сертификат соответствия на <?php echo $query; ?>&newwindow=1&hl=ru&tbm=isch&tbo=u&source=univ&sa=X&ved=0ahUKEwiUoIL7mpvMAhWLBSwKHSgOBxIQsAQIGw&biw=1280&bih=865&tbs=isz:l"
                                target="_blank">
                                найти в Google
                            </a>
                        </div>
                        <div class="certificates-table__cell">
                            <?php
                            if ($isAdmin) {
                                ?>
                                <a class="certificates-table__cell-link"
                                   href="<?php echo $site_url; ?>/api/remove-query.php?q=<?php echo $query; ?>"
                                    title="Удалить запрос">
                                    удалить
                                </a>
                            <?php } ?>
                        </div>
                    <?php   } ?>
                    </div>
                </div>
            </div>
            <aside class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </main>
    </div>
<?php get_footer(); ?>