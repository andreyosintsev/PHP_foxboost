<?php
/*
Template Name: Certificate added
*
* template-certificate-added.php
*
* Template file for the page after adding the certificate or declaration.
* /certificate-added/
*
* @link        http://rostest-certify.ru/
*
* @author      Andrei Osintsev
* @copyright   Copyright (c) 2024-2025 asosintsev@yandex.ru
*/
?>
<?php get_header(); ?>
<?php
    $site_url           = site_url();
    $isAuth             = isset($_SESSION['auth']);
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php
            get_template_part('partials/breadcrumbs', null, ['breadcrumbs' => [
                [ 'content' => 'Результаты добавления сертификата' ]
            ]])
            ?>
            <h1 class="hero__title">
                Результаты добавления сертификата
            </h1>
        </div>
    </div>
    <main class="main">
        <div class="content added">
            <?php if (!$isAuth) { ?>
                <div class="content__ad">
                    <?php echo getAdContent('horizontal.ad'); ?>
                </div>
            <?php } ?>
            <div class="added__content">
                <?php
                    $advego_name = $_POST["advego_name"];
                    if (empty($advego_name)) { ?>
                        <h2>Ошибка добавления нового сертификата/декларации</h2>
                        <h3>Не задано имя/ник на фриланс-бирже</h3>
                        <p>Вероятнее всего, вы забыли указать ваше имя/ник. Задание не принято.</p>
              <?php } else {

                        $advego_product =				$_POST["advego_product"] ?? '';
                        $param1_number =				$_POST["param1_number"] ?? '';
                        $param2_validity =				$_POST["param2_validity"] ?? '';
                        $param3_certification_agency =	$_POST["param3_certification_agency"] ?? '';
                        $param4_product =				$_POST["param4_product"] ?? '';
                        $param5_complies_with =			$_POST["param5_complies_with"] ?? '';
                        $param6_manufacturer =			$_POST["param6_manufacturer"] ?? '';
                        $param7_issued =				$_POST["param7_issued"] ?? '';
                        $param8_on_the_basis =			$_POST["param8_on_the_basis"] ?? '';
                        $param9_add_info =				$_POST["param9_add_info"] ?? '';
                        $parama_declarant =				$_POST["parama_declarant"] ?? '';
                        $paramb_okp =					$_POST["paramb_okp"] ?? '';
                        $advego_link =					$_POST["advego_link"] ?? '';
                        $advego_link2 =					$_POST["advego_link2"] ?? '';
                        $img_edited =					$_POST["img_edited"] ?? '';
                        $img_edited2 =					$_POST["img_edited2"] ?? '';

                        /*Создадим запись для последующей проверки*/
                        $new_title = mb_substr(wp_strip_all_tags($param4_product),0, 100);

                        $post_data = [
                            'post_title'    => mb_lcfirst($new_title),
                            'post_type'		=> 'post',
                            'post_content'  => '',
                            'post_status'   => 'pending',
                            'post_author'   => 1,
                            'post_category' => [1]
                        ];

                        /*Вставляем запись в базу данных*/
                        $id = wp_insert_post($post_data) ;

                        /*Обновляем пользовательские поля*/
                        update_post_meta($id, "advego_product", $advego_product);
                        update_post_meta($id, "param1_number", normalizeNumber($param1_number));
                        update_post_meta($id, "param2_validity", mb_strtolower($param2_validity));
                        update_post_meta($id, "param3_certification_agency", normalizeString($param3_certification_agency, true));
                        update_post_meta($id, "param4_product", normalizeString($param4_product));
                        update_post_meta($id, "param5_complies_with", normalizeString($param5_complies_with));
                        update_post_meta($id, "param6_manufacturer", normalizeString($param6_manufacturer));
                        update_post_meta($id, "param7_issued", normalizeString($param7_issued));
                        update_post_meta($id, "param8_on_the_basis", normalizeString($param8_on_the_basis, true));
                        update_post_meta($id, "param9_add_info", normalizeString($param9_add_info));
                        update_post_meta($id, "parama_declarant", normalizeString($parama_declarant));
                        update_post_meta($id, "paramb_okp", $paramb_okp);
                        update_post_meta($id, "advego_name", $advego_name);
                        update_post_meta($id, "advego_link", $advego_link);
                        update_post_meta($id, "advego_link2", $advego_link2);

                        if (!(empty($img_edited))) {
                            update_post_meta($id, "img_edited", $site_url .'/upload/'. $img_edited);
                            update_post_meta($id, "img_download_link", mb_substr($img_edited, 4));
                        }

                        if (!(empty($img_edited2))) {
                            update_post_meta($id, "img_edited2", $site_url .'/upload/'. $img_edited2);
                            update_post_meta($id, "img_download_link2", mb_substr($img_edited2, 4));
                        } ?>

                        <h2>Сертификат/декларация успешно добавлен</h2>
              <?php } ?>
                    <p>Чтобы добавить новый сертификат/декларацию, нажмите кнопку ниже.</p>
                    <a class="button added__button" href="<?php echo $site_url; ?>/add/">Добавить сертификат/декларацию</a>
            </div>
        </div>
        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </main>
</div>
<?php get_footer(); ?>