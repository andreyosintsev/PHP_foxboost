<?php
/**
 * forms/form-add-certify1.php
 *
 * The partial for displaying the form for adding Required certificate.
 *
 * @link        http://rostest-certify.ru/
 *
 * @author      Andrei Osintsev
 * @copyright   Copyright (c) 2024 asosintsev@yandex.ru
 */

    $info = $args['info'];
    if (!isset($info)) return;

    $fname = $args['fname'];
    $fname2 = $args['fname2'];

    $site_url = site_url();
    $images_url = get_template_directory_uri() .'/images/about/';
    $path = $site_url. '/upload/'. $info['filename'];
    $filename = $info['filename'];
    $extension = $info['extension'];
?>
<!--Форма для обязательных сертификатов ГОСТ Р-->
<form action="<?php echo $site_url; ?>/certificate-added"
      class="formcontent"
      method="post"
      name="addcertform1"
      id="addform1"
      onsubmit="return checkInput('addform1')">
    <p>Нажмите на изображение фрагмента сертификата для распознавания</p>
    <h3>Сертификат соответствия ГОСТ Р - обязательная сертификация (красный)</h3>
    <div class="fields__wrapper">
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-header.png" alt="Верхний колонтитул">

        <label class="formlabel" for="form1param1_number">№ сертификата</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param1_number.png" alt="Номер сертификата">
        <img class="formactual"
             id="gost_r_0"
             src="<?php echo $path. '/'. $filename.'_gost_r_0.'. $extension; ?>"
             alt="Номер сертификата"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param1_number');">
        <input class="fields"
               id="form1param1_number"
               name="param1_number"
               type="text"
               form="addform1"
               placeholder="Пример: РОСС RU.НО02.В01904"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать № сертификата">

        <label class="formlabel" for="form1param2_validity">Срок действия</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param2_validity.png" alt="Срок действия">
        <img class="formactual"
             id="gost_r_1"
             src="<?php echo $path. '/'. $filename.'_gost_r_1.'. $extension; ?>"
             alt="Срок действия"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param2_validity');">
        <input class="fields"
               id="form1param2_validity"
               name="param2_validity"
               type="text"
               form="addform1"
               placeholder="Пример: с 03.05.2013 по 29.05.2016"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать срок действия сертификата">

        <label class="formlabel" for="form1paramb_okp">Код ОКП или ТН ВЭД ТС или ОКУН</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-okp.png" alt="Код ОКП или ТН ВЭД ТС или ОКУН">
        <img class="formactual"
             id="gost_r_2"
             style="width: auto; max-width: 100%"
             src="<?php echo $path. '/'. $filename.'_gost_r_2.'. $extension; ?>"
             alt="Код ОКП или ТН ВЭД ТС или ОКУН"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1paramb_okp');">
        <input class="fields"
               id="form1paramb_okp"
               name="paramb_okp"
               type="text"
               form="addform1"
               placeholder="Пример: 22 4811"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать или код ОКП, или ТН ВЭД ТС, или ОКУН">

        <label class="formlabel" for="form1param3_certification_agency">Орган по сертификации</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param3_certification_agency.png" alt="Орган по сертификации">
        <img class="formactual"
             id="gost_r_3"
             src="<?php echo $path. '/'. $filename.'_gost_r_3.'. $extension; ?>"
             alt="Орган по сертификации"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param3_certification_agency');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form1param3_certification_agency"
                      name="param3_certification_agency"
                      form="addform1"
                      placeholder="Пример: РОСС RU.0001.11НО02. Научно-технический фонд &laquo;СЕРТИФИКАЦИОННЫЙ ЦЕНТР &laquo;КОНТСТАНД&raquo;. 123060, г. Москва, ул. Маршала Рыбалко, д. 8, тел (499) 194-83-80."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения об органе сертификации"
            ></textarea>
        </div>

        <label class="formlabel" for="form1param4_product">Продукция (услуга, работа)</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param4_product.png" alt="Продукция (услуга, работа)">
        <img class="formactual"
             id="gost_r_4"
             src="<?php echo $path. '/'. $filename.'_gost_r_4.'. $extension; ?>"
             alt="Продукция (услуга, работа)"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param4_product');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form1param4_product"
                      name="param4_product"
                      form="addform1"
                      placeholder="Пример: ТРУБЫ НАПОРНЫЕ ИЗ ПОЛИЭТИЛЕНА ПЭ80, ПЭ100, SDR 6; 7,4; 9; 11; 13,6; 17; 17,6; 21; 26; 33; 41 ДИАМЕТРОМ ОТ 20 ДО 1200 ММ. ГОСТ 18599-2001 с изм. № 1. Серийный выпуск."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать наименование продукции (услуги, работы)"></textarea>
        </div>

        <label class="formlabel" for="form1param5_complies_with">Соответствует требованиям</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param5_complies_with.png" alt="Соответствует требованиям">
        <img class="formactual"
             id="gost_r_5"
             src="<?php echo $path. '/'. $filename.'_gost_r_5.'. $extension; ?>"
             alt="Соответствует требованиям"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param5_complies_with');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form1param5_complies_with"
                      name="param5_complies_with"
                      form="addform1"
                      placeholder="Пример: ГОСТ 18599-2001 с изм. № 1 (табл. 5, п. 5.1)."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать каким требованиям удовлетворяет продукция"></textarea>
        </div>

        <label class="formlabel" for="form1param6_manufacturer">Изготовитель</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param6_manufacturer.png" alt="Изготовитель">
        <img class="formactual"
             id="gost_r_6"
             src="<?php echo $path. '/'. $filename.'_gost_r_6.'. $extension; ?>"
             alt="Изготовитель"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param6_manufacturer');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form1param6_manufacturer"
                      name="param6_manufacturer"
                      form="addform1"
                      placeholder="Пример: ООО &laquo;МирТрубПласт&raquo;. ИНН: 2112390338. 429544, Республика Чувашия, Моргаушский район, село Большой Сундырь, ул. Советская, д. 23."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения об изготовителе"></textarea>
        </div>

        <label class="formlabel" for="form1param7_issued">Сертификат выдан</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param7_issued.png" alt="Сертификат выдан">
        <img class="formactual"
             id="gost_r_7"
             src="<?php echo $path. '/'. $filename.'_gost_r_7.'. $extension; ?>"
             alt="Сертификат выдан"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param7_issued');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form1param7_issued"
                      name="param7_issued"
                      form="addform1"
                      placeholder="Пример: ООО &laquo;МирТрубПласт&raquo;. 429544, Республика Чувашия, Моргаушский район, село Большой Сундырь, ул. Советская, д. 23. Тел. (83541) 6-93-43, факс (83541) 6-91-19."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать кому выдан сертификат"></textarea>
        </div>

        <label class="formlabel" for="form1param8_on_the_basis">На основании</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param8_on_the_basis.png" alt="На основании">
        <img class="formactual"
             id="gost_r_8"
             src="<?php echo $path. '/'. $filename.'_gost_r_8.'. $extension; ?>"
             alt="На основании"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param8_on_the_basis');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form1param8_on_the_basis"
                      name="param8_on_the_basis"
                      form="addform1"
                      placeholder="Пример: Протокола сертификационных испытаний № 652/13-КС от 28.05.2013 ИЛ Научно-технического фонда &laquo;СЕРТИФИКАЦИОННЫЙ ЦЕНТР &laquo;КОНТСТАНД&raquo;, регистрационный номер в Госреестре РОСС RU.0001.21АЮ45. 443070, г. Самара, ул. Песчаная, д. 1"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать на основании чего выдан сертификат"></textarea>
        </div>

        <label class="formlabel" for="form1param9_add_info">Дополнительная информация</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-param9_add_info.png" alt="Дополнительная информация">
        <img class="formactual"
             id="gost_r_9"
             src="<?php echo $path. '/'. $filename.'_gost_r_9.'. $extension; ?>"
             alt="Дополнительная информация"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form1param9_add_info');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form1param9_add_info"
                      name="param9_add_info"
                      form="addform1"
                      placeholder="Пример: Знак соответствия по ГОСТ Р 50460 наносится на изделие и/или в товаросопроводительную документацию. Схема сертификации: 3."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать дополнительную информацию о сертификате или поставить пробел"></textarea>
        </div>

        <img class="formtip" src="<?php echo $images_url; ?>gostr-o-footer.png" alt="Нижний колонтитул">

        <div style="width: 100%; height: 1px; margin: 10px 0; border-bottom: 1px #aaa solid;"></div>

        <label class="formlabel" for="form1advego_name">Ваше имя/ник на <strong>фриланс-бирже</strong></label>
        Необходимо указать имя/ник для идентификации исполнителя и оплаты выполненной работы

        <input class="fields"
               id="form1advego_name"
               name="advego_name"
               type="text"
               form="addform1"
               placeholder="Пример: vi_lenin"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать имя/ник исполнителя на фриланс-бирже для получения оплаты">

        <input type="hidden" name="img_edited" form="addform1" value="<?php echo $fname; ?>">
        <input type="hidden" name="img_edited2" form="addform1" value="<?php echo $fname2; ?>">
    </div>

    <button class="button" type="submit" form="addform1">Отправить</button>
</form>