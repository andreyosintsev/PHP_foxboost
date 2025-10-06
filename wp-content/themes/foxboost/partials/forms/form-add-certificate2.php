<?php
/**
 * forms/form-add-certify2.php
 *
 * The partial for displaying the form for adding Optional certificate.
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
<!--Форма для добровольных сертификатов ГОСТ Р-->
<form action="<?php echo $site_url; ?>/certificate-added"
      class="formcontent hidden"
      method="post"
      name="addcertform2"
      id="addform2"
      onsubmit="return checkInput('addform2')">
    <p>Нажмите на изображение фрагмента сертификата для распознавания</p>
    <h3>Сертификат соответствия ГОСТ Р - добровольная сертификация (синий)</h3>
    <div class="fields__wrapper">
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-header.png" alt="Верхний колонтитул">

        <label class="formlabel" for="form2param1_number">№ сертификата</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param1_number.png" alt="Номер сертификата">
        <img class="formactual"
             id="gost_b_0"
             src="<?php echo $path. '/'. $filename.'_gost_b_0.'. $extension; ?>"
             alt="Номер сертификата"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param1_number');">
        <input class="fields"
               id="form2param1_number"
               name="param1_number"
               type="text"
               form="addform2"
               placeholder="Пример: РОСС RU.СТ08.Н00068"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать № сертификата">

        <label class="formlabel" for="form2param2_validity">Срок действия</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param2_validity.png" alt="Срок действия">
        <img class="formactual"
             id="gost_b_1"
             src="<?php echo $path. '/'. $filename.'_gost_b_1.'. $extension; ?>"
             alt="Срок действия"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param2_validity');">
        <input class="fields"
               id="form2param2_validity"
               name="param2_validity"
               type="text"
               form="addform2"
               placeholder="Пример: с 09.06.2015 по 09.06.2018"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать срок действия сертификата">

        <label class="formlabel" for="form2paramb_okp">Код ОКП или ТН ВЭД ТС или ОКУН</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-okp.png" alt="Код ОКП или ТН ВЭД ТС или ОКУН">
        <img class="formactual"
             id="gost_b_2"
             style="width: auto; max-width: 100%"
             src="<?php echo $path. '/'. $filename.'_gost_b_2.'. $extension; ?>"
             alt="Код ОКП или ТН ВЭД ТС или ОКУН"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2paramb_okp');">
        <input class="fields"
               id="form2paramb_okp"
               name="paramb_okp"
               type="text"
               form="addform2"
               placeholder="Пример: 73 9940"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать или код ОКП, или ТН ВЭД ТС, или ОКУН">

        <label class="formlabel" for="form2param3_certification_agency">Орган по сертификации</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param3_certification_agency.png" alt="Орган по сертификации">
        <img class="formactual"
             id="gost_b_3"
             src="<?php echo $path. '/'. $filename.'_gost_b_3.'. $extension; ?>"
             alt="Орган по сертификации"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param3_certification_agency');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form2param3_certification_agency"
                      name="param3_certification_agency"
                      form="addform2"
                      placeholder="Пример: рег. № RA.RU.11СТ08. Московского областного Общественного Учреждения &laquo;РЕГИОНАЛЬНЫЙ СЕРТИФИКАЦИОННЫЙ ЦЕНТР &laquo;ОПЫТНОЕ&raquo;. 143913, Россия, Московская область, г. Балашиха, мкр. им. Гагарина, д. 6, пом. 1, тел 8 (495) 585-58-18, 8 (498) 600-75-16, факс 8 (495) 585-58-18, E-mail: info-opitnoe@mail.ru."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения об органе сертификации"
            ></textarea>
        </div>

        <label class="formlabel" for="form2param4_product">Продукция (услуга, работа)</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param4_product.png" alt="Продукция (услуга, работа)">
        <img class="formactual"
             id="gost_b_4"
             src="<?php echo $path. '/'. $filename.'_gost_b_4.'. $extension; ?>"
             alt="Продукция (услуга, работа)"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param4_product');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form2param4_product"
                      name="param4_product"
                      form="addform2"
                      placeholder="Пример: Дверь металлическая модели ДМ Н-10В. Выпускается по ТУ 5262-017-50140568-2009. Серийный выпуск."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать наименование продукции (услуги, работы)"></textarea>
        </div>

        <label class="formlabel" for="form2param5_complies_with">Соответствует требованиям</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param5_complies_with.png" alt="Соответствует требованиям">
        <img class="formactual"
             id="gost_b_5"
             src="<?php echo $path. '/'. $filename.'_gost_b_5.'. $extension; ?>"
             alt="Соответствует требованиям"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param5_complies_with');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form2param5_complies_with"
                      name="param5_complies_with"
                      form="addform2"
                      placeholder="Пример: ГОСТ Р 51113-1997, ГОСТ Р 51224-1998 и ГОСТ Р 51072-2005 класс устойчивости ко взлому - II (второй)."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать каким требованиям удовлетворяет продукция"></textarea>
        </div>

        <label class="formlabel" for="form2param6_manufacturer">Изготовитель</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param6_manufacturer.png" alt="Изготовитель">
        <img class="formactual"
             id="gost_b_6"
             src="<?php echo $path. '/'. $filename.'_gost_b_6.'. $extension; ?>"
             alt="Изготовитель"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param6_manufacturer');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form2param6_manufacturer"
                      name="param6_manufacturer"
                      form="addform2"
                      placeholder="Пример: ООО &laquo;НЕМАН&raquo;. ИНН: 4401042862. Адрес: 156009, г. Кострома, ул. Льняная, д. 8 &laquo;А&raquo;."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения об изготовителе"></textarea>
        </div>

        <label class="formlabel" for="form2param7_issued">Сертификат выдан</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param7_issued.png" alt="Сертификат выдан">
        <img class="formactual"
             id="gost_b_7"
             src="<?php echo $path. '/'. $filename.'_gost_b_7.'. $extension; ?>"
             alt="Сертификат выдан"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param7_issued');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form2param7_issued"
                      name="param7_issued"
                      form="addform2"
                      placeholder="Пример: ООО &laquo;НЕМАН&raquo;. ОКПО: 50140568, ИНН: 4401042862. Адрес: 156009, г. Кострома, ул. Льняная, д. 8 &laquo;А&raquo; ."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать кому выдан сертификат"></textarea>
        </div>

        <label class="formlabel" for="form2param8_on_the_basis">На основании</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param8_on_the_basis.png" alt="На основании">
        <img class="formactual"
             id="gost_b_8"
             src="<?php echo $path. '/'. $filename.'_gost_b_8.'. $extension; ?>"
             alt="На основании"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param8_on_the_basis');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form2param8_on_the_basis"
                      name="param8_on_the_basis"
                      form="addform2"
                      placeholder="Пример: Протоколы № 507/ИЦ-15 от 3.06.2015 ИЦ &laquo;Опытное&raquo;, аттестат аккредитации № РОСС RU.0001.21АВ74 от 14.10.2011 г. Акт проверки состояния производства продукции, выпускаемой Обществом с ограниченной ответственностью ООО &laquo;НЕМАН&raquo;."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать на основании чего выдан сертификат"></textarea>
        </div>

        <label class="formlabel" for="form2param9_add_info">Дополнительная информация</label>
        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-param9_add_info.png" alt="Дополнительная информация">
        <img class="formactual"
             id="gost_b_9"
             src="<?php echo $path. '/'. $filename.'_gost_b_9.'. $extension; ?>"
             alt="Дополнительная информация"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form2param9_add_info');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form2param9_add_info"
                      name="param9_add_info"
                      form="addform2"
                      placeholder="Пример: Схема сертификации № 3а на сопроводительной технической документации."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать дополнительную информацию о сертификате или поставить пробел"></textarea>
        </div>

        <img class="formtip" src="<?php echo $images_url; ?>gostr-r-footer.png" alt="Нижний колонтитул">

        <div style="width: 100%; height: 1px; margin: 10px 0; border-bottom: 1px #aaa solid;"></div>

        <label class="formlabel" for="form2advego_name">Ваше имя/ник на <strong>фриланс-бирже</strong></label>
        Необходимо указать имя/ник для идентификации исполнителя и оплаты выполненной работы

        <input class="fields"
               id="form2advego_name"
               name="advego_name"
               type="text"
               form="addform2"
               placeholder="Пример: vi_lenin"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать имя/ник исполнителя на фриланс-бирже для получения оплаты">

        <input type="hidden" name="img_edited" form="addform2" value="<?php echo $fname; ?>">
        <input type="hidden" name="img_edited2" form="addform2" value="<?php echo $fname2; ?>">
    </div>

    <button class="button" type="submit" form="addform2">Отправить</button>
</form>