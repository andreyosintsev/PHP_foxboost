<?php
/**
 * search.php
 *
 * The template for displaying Search Results pages.
 *
 * @link        https://foxboost.ru
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2025 asosintsev@yandex.ru
 */
?>
<?php get_header(); ?>
<?php
    $site_url         = site_url();
    $page_url         = get_page_uri();
    $template_url     = get_template_directory_uri();
    $search_query     = get_search_query();
?>
<main class="main">
    <div class="wrapper">
        <section class="section">
            <div class="title-wrapper">
                <h2 class="title">Результаты поиска <?php echo $search_query?></h2>
                <div class="subtitle">Найдено 12 фоксбустов</div>
            </div>
            <div class="section-foxboost">
                <div class="card-foxboost section-foxboost__card">
                    <div class="card-foxboost__caption">
                        <div class="card-foxboost__image">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                <img
                                        class="card-foxboost__img"
                                        src="images/foxboosts/image.png"
                                        alt="Кресло FoxGear NETZ model X "
                                />
                            </a>
                        </div>
                        <div class="card-foxboost__stats">
                            <div class="card-foxboost__togo-apps">1500 дней, 100000 заявок</div>
                            <div class="card-foxboost__views">15600</div>
                        </div>
                        <h3 class="card-foxboost__title">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                Кресло FoxGear NETZ model X белого, чёрного и серого цвета c регулировкой подъема
                            </a>
                        </h3>
                    </div>
                    <div class="card-foxboost__content">
                        <div class="card-foxboost__description">
                            Комфортное настраиваемое офисное кресло для дома, предприятия, с отличной поддержкой поясницы и
                            регулировкой подъема
                        </div>
                        <div class="card-foxboost__rating">
                            <div class="card-foxboost__stars">
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star card-foxboost__star_gray"></span>
                            </div>
                            <div class="card-foxboost__average">4.6</div>
                            <div class="card-foxboost__reviews">12 оценок</div>
                        </div>
                        <div class="button card-foxboost__button button_subscribe" data-product="Кресло FoxGear NETZ">
                            Оставить заявку
                        </div>
                    </div>
                    <div class="card-foxboost__special card-foxboost__special_recommended"></div>
                </div>
                <div class="card-foxboost section-foxboost__card">
                    <div class="card-foxboost__caption">
                        <div class="card-foxboost__image">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                <img
                                        class="card-foxboost__img"
                                        src="images/foxboosts/image.png"
                                        alt="Кресло FoxGear NETZ model X "
                                />
                            </a>
                        </div>
                        <div class="card-foxboost__stats">
                            <div class="card-foxboost__togo-apps">1500 дней, 100000 заявок</div>
                            <div class="card-foxboost__views">15600</div>
                        </div>
                        <h3 class="card-foxboost__title">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                Кресло FoxGear NETZ model X белого, чёрного и серого цвета c регулировкой подъема
                            </a>
                        </h3>
                    </div>
                    <div class="card-foxboost__content">
                        <div class="card-foxboost__description">
                            Комфортное настраиваемое офисное кресло для дома, предприятия, с отличной поддержкой поясницы и
                            регулировкой подъема
                        </div>
                        <div class="card-foxboost__rating">
                            <div class="card-foxboost__stars">
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star card-foxboost__star_gray"></span>
                            </div>
                            <div class="card-foxboost__average">4.6</div>
                            <div class="card-foxboost__reviews">12 оценок</div>
                        </div>
                        <div class="button card-foxboost__button button_subscribe" data-product="Кресло FoxGear NETZ">
                            Оставить заявку
                        </div>
                    </div>
                    <div class="card-foxboost__special card-foxboost__special_recommended"></div>
                </div>
                <div class="card-foxboost section-foxboost__card">
                    <div class="card-foxboost__caption">
                        <div class="card-foxboost__image">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                <img
                                        class="card-foxboost__img"
                                        src="images/foxboosts/image.png"
                                        alt="Кресло FoxGear NETZ model X "
                                />
                            </a>
                        </div>
                        <div class="card-foxboost__stats">
                            <div class="card-foxboost__togo-apps">1500 дней, 100000 заявок</div>
                            <div class="card-foxboost__views">15600</div>
                        </div>
                        <h3 class="card-foxboost__title">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                Кресло FoxGear NETZ model X белого, чёрного и серого цвета c регулировкой подъема
                            </a>
                        </h3>
                    </div>
                    <div class="card-foxboost__content">
                        <div class="card-foxboost__description">
                            Комфортное настраиваемое офисное кресло для дома, предприятия, с отличной поддержкой поясницы и
                            регулировкой подъема
                        </div>
                        <div class="card-foxboost__rating">
                            <div class="card-foxboost__stars">
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star card-foxboost__star_gray"></span>
                            </div>
                            <div class="card-foxboost__average">4.6</div>
                            <div class="card-foxboost__reviews">12 оценок</div>
                        </div>
                        <div class="button card-foxboost__button button_subscribe" data-product="Кресло FoxGear NETZ">
                            Оставить заявку
                        </div>
                    </div>
                    <div class="card-foxboost__special card-foxboost__special_recommended"></div>
                </div>
                <div class="card-foxboost section-foxboost__card">
                    <div class="card-foxboost__caption">
                        <div class="card-foxboost__image">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                <img
                                        class="card-foxboost__img"
                                        src="images/foxboosts/image.png"
                                        alt="Кресло FoxGear NETZ model X "
                                />
                            </a>
                        </div>
                        <div class="card-foxboost__stats">
                            <div class="card-foxboost__togo-apps">1500 дней, 100000 заявок</div>
                            <div class="card-foxboost__views">15600</div>
                        </div>
                        <h3 class="card-foxboost__title">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                Кресло FoxGear NETZ model X белого, чёрного и серого цвета c регулировкой подъема
                            </a>
                        </h3>
                    </div>
                    <div class="card-foxboost__content">
                        <div class="card-foxboost__description">
                            Комфортное настраиваемое офисное кресло для дома, предприятия, с отличной поддержкой поясницы и
                            регулировкой подъема
                        </div>
                        <div class="card-foxboost__rating">
                            <div class="card-foxboost__stars">
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star card-foxboost__star_gray"></span>
                            </div>
                            <div class="card-foxboost__average">4.6</div>
                            <div class="card-foxboost__reviews">12 оценок</div>
                        </div>
                        <div class="button card-foxboost__button button_subscribe" data-product="Кресло FoxGear NETZ">
                            Оставить заявку
                        </div>
                    </div>
                    <div class="card-foxboost__special card-foxboost__special_recommended"></div>
                </div>
                <div class="card-foxboost section-foxboost__card">
                    <div class="card-foxboost__caption">
                        <div class="card-foxboost__image">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                <img
                                        class="card-foxboost__img"
                                        src="images/foxboosts/image.png"
                                        alt="Кресло FoxGear NETZ model X "
                                />
                            </a>
                        </div>
                        <div class="card-foxboost__stats">
                            <div class="card-foxboost__togo-apps">1500 дней, 100000 заявок</div>
                            <div class="card-foxboost__views">15600</div>
                        </div>
                        <h3 class="card-foxboost__title">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                Кресло FoxGear NETZ model X белого, чёрного и серого цвета c регулировкой подъема
                            </a>
                        </h3>
                    </div>
                    <div class="card-foxboost__content">
                        <div class="card-foxboost__description">
                            Комфортное настраиваемое офисное кресло для дома, предприятия, с отличной поддержкой поясницы и
                            регулировкой подъема
                        </div>
                        <div class="card-foxboost__rating">
                            <div class="card-foxboost__stars">
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star card-foxboost__star_gray"></span>
                            </div>
                            <div class="card-foxboost__average">4.6</div>
                            <div class="card-foxboost__reviews">12 оценок</div>
                        </div>
                        <div class="button card-foxboost__button button_subscribe" data-product="Кресло FoxGear NETZ">
                            Оставить заявку
                        </div>
                    </div>
                    <div class="card-foxboost__special card-foxboost__special_recommended"></div>
                </div>
                <div class="card-foxboost section-foxboost__card">
                    <div class="card-foxboost__caption">
                        <div class="card-foxboost__image">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                <img
                                        class="card-foxboost__img"
                                        src="images/foxboosts/image.png"
                                        alt="Кресло FoxGear NETZ model X "
                                />
                            </a>
                        </div>
                        <div class="card-foxboost__stats">
                            <div class="card-foxboost__togo-apps">1500 дней, 100000 заявок</div>
                            <div class="card-foxboost__views">15600</div>
                        </div>
                        <h3 class="card-foxboost__title">
                            <a class="card-foxboost__link" href="#" title="Посмотреть кресло FoxGear NETZ model X">
                                Кресло FoxGear NETZ model X белого, чёрного и серого цвета c регулировкой подъема
                            </a>
                        </h3>
                    </div>
                    <div class="card-foxboost__content">
                        <div class="card-foxboost__description">
                            Комфортное настраиваемое офисное кресло для дома, предприятия, с отличной поддержкой поясницы и
                            регулировкой подъема
                        </div>
                        <div class="card-foxboost__rating">
                            <div class="card-foxboost__stars">
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star"></span>
                                <span class="card-foxboost__star card-foxboost__star_gray"></span>
                            </div>
                            <div class="card-foxboost__average">4.6</div>
                            <div class="card-foxboost__reviews">12 оценок</div>
                        </div>
                        <div class="button card-foxboost__button button_subscribe" data-product="Кресло FoxGear NETZ">
                            Оставить заявку
                        </div>
                    </div>
                    <div class="card-foxboost__special card-foxboost__special_recommended"></div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>