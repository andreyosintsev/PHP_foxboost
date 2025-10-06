<?php
/*
Template Name: Panel
*
* template-panel.php
*
* Template file for the dashboard page for managing user access to download certificates.
* /panel/
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
    $page_url            = get_page_uri();

    $isAuth              = isset($_SESSION['auth']);

    $idActivate          = isset($_GET['activate']) ? $_GET['activate'] : false;
    $today               = date("Y-m-d");

    if ($idActivate) {
        $todayUsers = $wpdb->get_results("SELECT ID, paid FROM wp_paidusers WHERE regtime > '$today'", OBJECT_K);
        foreach ($todayUsers as $user) {
            if (($idActivate == $user->ID) AND ($user->paid == 0)) {
                //Активируем запись
                $res = $wpdb->update('wp_paidusers', ['paid' => 1], ['ID' => $idActivate]);

                if (!$res) continue;

                /*Отправим письмо с уведомлением пользователю на почту*/

                $res = $wpdb->get_row($wpdb->prepare("SELECT email FROM wp_paidusers WHERE ID = %d", $user->ID));
                $to = $res->email;

                $subject = mb_encode_mimeheader('Регистрация на сайте rostest-certify','UTF-8', 'B');

                $headers  = "From: support@rostest-certify.ru\r\n";
                $headers .= "Reply-To: support@rostest-certify.ru\r\n";
                $headers .= "Date: ".date('D, d M Y H:i:s O')."\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\r\n";
                $headers .= "Message-ID: ".$user->ID."@rostest-certify.ru\r\n";

                $message = "<html><div>";
                $message .= 'Уважаемый пользователь,<br /><br />';
                $message .= 'поздравляем вас с регистрацией на сайте <b>rostest-certify.ru</b>.';
                $message .= '<br />';
                $message .= 'E-mail для входа: <b>'.$to.'</b><br/>';
                $message .= '<br />';
                $message .= '<br />';
                $message .= 'Теперь вы можете вернуться на сайт и войти в учетную запись используя ваш E-mail и пароль.';
                $message .= '<br />';
                $message .= '<br />';
                $message .= '<br />';
                $message .= '<br />';
                $message .= '<br />';
                $message .= 'Для связи с администрацией сайта воспользуйтесь формой http://rostest-certify.ru/o-sajte/';
                $message .= '<br />';
                $message .= '<br />';
                $message .= 'С уважением, администрация сайта rostest-certify.ru';
                $message .= "</div></html>\r\n";
                $sent = mail($to, $subject, $message, $headers);

                break;
            }
        }
    }
?>
    <div class="wrapper">
        <div class="hero">
            <div class="hero__content">
                <?php
                get_template_part('partials/breadcrumbs', null, ['breadcrumbs' => [
                    [ 'content' => 'Панель управления активациями' ]
                ]])
                ?>
                <h1 class="hero__title">
                    Панель управления активациями
                </h1>
                <h2 class="hero__subtitle">
                    Активность за <?php echo date("d.m.Y")?>
                </h2>
            </div>
        </div>
        <main class="main">
            <div class="content">
                <?php if (!$isAuth) { ?>
                    <div class="content__ad">
                        <?php echo getAdContent('horizontal.ad'); ?>
                    </div>
                <?php } ?>
                <h2 class="content__title">
                    Регистрация и активация
                </h2>
                <div class="certificates">
                    <div class="certificates-table certificates-table_activate">
                        <div class="certificates-table__cell certificates-table__cell_header">
                            E-mail
                        </div>
                        <div class="certificates-table__cell certificates-table__cell_header">
                            Время
                        </div>
                        <div class="certificates-table__cell certificates-table__cell_header">
                            Скачивания
                        </div>
                        <div class="certificates-table__cell certificates-table__cell_header">
                            Активация
                        </div>
                        <?php
                            $todayUsers = $wpdb->get_results("SELECT ID, email, regtime, lasttime, paid, downloads FROM wp_paidusers WHERE lasttime > '$today' ORDER BY lasttime ASC", OBJECT_K);

                            foreach ($todayUsers as $user) { ?>
                                <div class="certificates-table__cell">
                                    <?php
                                        echo $user->email;

                                        $userDownload=$wpdb->get_results("SELECT post_id FROM wp_userhistory WHERE user = '$user->email' AND downloaded = 1 AND lasttime > '$today'", OBJECT_K);
                                    ?>
                                    <ol class="certificates-table__downloaded">
                                        <?php foreach ($userDownload as $post) { ?>
                                             <li>
                                                 <a class="certificates-table__downloaded-link" href="<?php echo get_permalink($post->post_id); ?>">
                                                     <?php echo mb_ucfirst(cutStringToWords(get_the_title($post->post_id), 100)); ?>
                                                 </a>
                                             </li>
                                        <?php } ?>
                                    </ol>
                                </div>
                                <div class="certificates-table__cell">
                                    <?php echo mb_substr($user->lasttime, mb_strlen($user->lasttime)-8, 5); ?>
                                </div>
                                <div class="certificates-table__cell">
                                    <?php echo $user->downloads ?>
                                </div>
                                <div class="certificates-table__cell">
                                    <?php
                                        if (strtotime($user->regtime) < strtotime($today)) { ?>
                                            <span class="active">Активный</span>
                                        <?php } else {
                                            if ($user->paid == 0) { ?>
                                               <a class="activate" href="?activate=<?php echo $user->ID; ?>">
                                                    Активировать
                                               </a>
                                            <?php } else { ?>
                                                <span class="activated">
                                                    Активирован
                                                </span>
                                            <?php }
                                        }
                                    ?>
                                </div>
                        <?php } ?>
                    </div>
                </div>
                <h2 class="content__title">
                    Скачивание сертификатов
                </h2>
                <div class="certificates-table certificates-table_download">
                    <div class="certificates-table__cell certificates-table__cell_header">
                        №
                    </div>
                    <div class="certificates-table__cell certificates-table__cell_header">
                        Время
                    </div>
                    <div class="certificates-table__cell certificates-table__cell_header">
                        Сертификат или декларация
                    </div>
                    <?php
                        $postIds = $wpdb->get_col("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='download_lastdate' AND meta_value='$today'");

                        $postTimeArr = [];

                        foreach($postIds as $postId) {
                            $postTimes = $wpdb->get_col("SELECT meta_value FROM $wpdb->postmeta WHERE post_id='$postId' AND meta_key='download_lasttime'");

                            foreach ($postTimes as $postTime) {
                                $postTimeArr[$postTime] = $postId;
                            }
                        }

                        ksort($postTimeArr);

                        $counter = 0;

                        foreach($postTimeArr as $postTime => $postId) {
                            $postTitles = $wpdb->get_col("SELECT post_title FROM $wpdb->posts WHERE ID='$postId'");

                            foreach ($postTitles as $postTitle) { ?>
                                <div class="certificates-table__cell">
                                    <?php echo ++$counter; ?>
                                </div>
                                <div class="certificates-table__cell">
                                    <?php echo $postTime ?>
                                </div>
                                <div class="certificates-table__cell">
                                    <a class="certificates-table__cell-link" href="<?php echo get_permalink($postId); ?>">
                                        <?php echo mb_ucfirst(cutStringToWords($postTitle, 100)); ?>
                                    </a>
                                </div>
                            <?php
                            }
                        }
                    ?>
                </div>
            </div>

            <aside class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </main>
    </div>
<?php get_footer(); ?>