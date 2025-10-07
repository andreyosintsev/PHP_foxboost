<?php
/**
 * norms-some.php
 *
 * The partial for displaying the norms page if some norms are found.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */
?>
<?php
    $site_url            = site_url();
    $page_url            = get_page_uri();
    $norms               = $args;

    $normSearchString    = $_GET['norm'];
    $isAuth              = isset($_SESSION['auth']);
?>
<div class="wrapper">
    <div class="hero">
        <div class="hero__content">
            <?php
                $breadcrumbs = [[
                    "href" => $page_url,
                    "title" => "Поиск ГОСТа по номеру",
                    "content" => "Поиск ГОСТа по номеру"
                ],
                [
                    "content" => $normSearchString
                ]];

                get_template_part('partials/breadcrumbs',null, ['breadcrumbs' => $breadcrumbs]);
            ?>

            <h1 class="hero__title">
                Поиск ГОСТа или ТР ТС по номеру: <?php echo $normSearchString; ?>
            </h1>
            <?php get_template_part(
                'partials/search-item',
                null, [
                    'title'                => 'Поиск ГОСТа по номеру:',
                    'placeholder'          => $normSearchString,
                    'placeholderDefault'   => 'Например, ГОСТ 30547-97',
                    'action'               => $site_url. '/' . get_page_uri(),
                    'param'                => 'norm'
                ]);
            ?>
        </div>
    </div>
    <main class="main">
        <div class="content">
            <section class="norms">
                <h2 class="title-section certificates__title ">
                    <?php
                        $normsCount = count($norms);
                        if ($normsCount > 20) {
                            $norms = array_slice($norms, 0, 20);
                            $normsCount = 20;
                            echo 'Найдено более 20 результатов';
                        } else {
                            echo declination($normsCount, ["Найден", "Найдено", "Найдено"])
                                . ' ' . $normsCount
                                . ' ' . declination($normsCount, ["результат", "результата", "результатов"]);
                        }
                    ?>
                </h2>
                <div class="norms__content">
                    <?php
                        foreach ($norms as $norm) {
                            get_template_part( 'partials/norms-item', null, ['norm' => $norm] );
                        }
                    ?>
                </div>
            </section>