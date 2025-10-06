<?php
/*
Template Name: Add new certificate
*
* template-add.php
*
* Template file for the page to add a certificate or declaration.
* /add/
*
* @link        http://rostest-certify.ru/
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2024-2025 asosintsev@yandex.ru
*/
?>
<?php get_header(); ?>
<?php
    $filename           = '';
    $filename2          = '';

    $isAuth             = isset($_SESSION['auth']);
//    date_default_timezone_set('Europe/Samara');

//    $site_url            = site_url();
    $template_url        = get_template_directory_uri();
?>
    <div class="wrapper">
        <div class="hero">
            <div class="hero__content">
                <?php
                    get_template_part('partials/breadcrumbs', null, ['breadcrumbs' => [
                        [ 'content' => 'Добавление нового сертификата' ]
                    ]])
                ?>
                <h1 class="hero__title">
                    Добавление нового сертификата
                </h1>
            </div>
        </div>
        <main class="main">
            <div class="content add">
                <?php if (!$isAuth) { ?>
                    <div class="content__ad">
                        <?php echo getAdContent('horizontal.ad'); ?>
                    </div>
                <?php } ?>
                <div class="add__content">
                    <h2>Порядок работы</h2>
                    <ol class="add__list">
                        <li>Выберите файл с изображением сертификата или декларации и приложения (при наличии)</li>
                        <li>Нажмите кнопку <strong>"Загрузить"</strong></li>
                        <li>Выберите вид документа</li>
                        <li>Заполните форму сведениями из сертификата или декларации и нажмите кнопку <strong>"Отправить"</strong></li>
                        <li>Данные в форму необходимо вводить так же, как они указаны в документе.</li>
                    </ol>
                    <form class="add__form" method="post" enctype="multipart/form-data">
                        <div class="add__form-wrapper">
                            <p>Изображение <strong>сертификата или декларации</strong></p>
                            <label class="input-file">
                                <input class="input-file__input" type="file" name="file">
                                <span class="button input-file__button button_outlined">Выберите файл сертификата</span>
                                <span class="input-file__text">Файл не выбран</span>
                            </label>
                            <label class="input-file">
                                <input class="input-file__input" type="file" name="file2">
                                <span class="button input-file__button button_outlined">Выберите файл приложения</span>
                                <span class="input-file__text">Файл не выбран</span>
                            </label>
                        </div>
                        <button class="add__form-button button" type="submit">Загрузить</button>
                    </form>

                    <?php
                        // Если была произведена отправка формы, проверить, задано ли имя файла сертификата
                        if (isset($_FILES['file'])) {

                            //проверяем, можно ли загружать изображение сертификата
                            $check = canUpload($_FILES['file']);

                            if ($check === true) {

                                // загружаем изображение на сервер
                                $filename = makeUpload($_FILES['file']);
                                if ($filename !== false) {
                                    echo resultSuccess('Файл '. $_FILES['file']['name'] .' успешно загружен!');

                                    // задано ли имя файла приложения (необязательно)
                                    if (isset($_FILES['file2']) && !empty($_FILES['file2']['name'])) {

                                        // проверяем, можно ли загружать изображение приложения
                                        $check = canUpload($_FILES['file2']);

                                        if ($check === true) {
                                            // загружаем изображение на сервер
                                            $filename2 = makeUpload($_FILES['file2']);
                                            if ($filename2 !== false) {
                                                echo resultSuccess('Файл '. $_FILES['file2']['name'] .' успешно загружен!');
                                            } else {
                                                echo resultFailed('Ошибка загрузки файла '. $_FILES['file2']['name']);
                                                echo resultSuccess('Однако вы можете продолжать оформление документа');
                                            }
                                        } else {
                                            echo resultFailed($check);
                                            echo resultSuccess('Однако вы можете продолжать оформление документа');
                                        }
                                    }

                                    $info = pathinfo($filename);

                                    //Нарежем исходное изображение для подготовки к распознаванию
                                    cutToOcr($filename); ?>

                                    <h2>Выберите вид документа, нажав на изображение</h2>
                                    <?php
                                        //Продолжение шаблона - вывод селектора типа документа и форм для заполнения
                                        echo get_template_part('partials/certificates-examples');
                                    ?>

                                    <h2>Заполните сведения о документе</h2>
                                    <span class="formtips button">Показать подсказки</span>

                                    <?php
                                        echo get_template_part('partials/forms/form-add-certificate1', null, [
                                            'info' => $info,
                                            'fname' => $filename,
                                            'fname2' => $filename2
                                        ]);
                                        echo get_template_part('partials/forms/form-add-certificate2', null, [
                                            'info' => $info,
                                            'fname' => $filename,
                                            'fname2' => $filename2
                                        ]);
                                        echo get_template_part('partials/forms/form-add-certificate3', null, [
                                            'info' => $info,
                                            'fname' => $filename,
                                            'fname2' => $filename2
                                        ]);
                                        echo get_template_part('partials/forms/form-add-certificate4', null, [
                                            'info' => $info,
                                            'fname' => $filename,
                                            'fname2' => $filename2
                                        ]);

                                    } else echo resultFailed('Ошибка загрузки файла ' . $_FILES['file']['name']);
                            } else echo resultFailed($check);
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