<?php
/**
 * forms/form-add-certify3.php
 *
 * The partial for displaying the form for adding certificate TR TS.
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
<!--Форма для сертификатов Таможенного союза-->
<form action="<?php echo $site_url; ?>/certificate-added"
      class="formcontent hidden"
      method="post"
      name="addcertform3"
      id="addform3"
      onsubmit="return checkInput('addform3')">
    <p>Нажмите на изображение фрагмента сертификата для распознавания</p>
    <h3>Сертификат соответствия Таможенного союза</h3>
    <div class="fields__wrapper">
        <img class="formtip" src="<?php echo $images_url; ?>/ss-header.png" alt="Верхний колонтитул">

        <label class="formlabel" for="form3param1_number">№ сертификата</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param1_number.png" alt="Номер сертификата">
        <img class="formactual"
             id="tnvedts_0"
             src="<?php echo $path. '/'. $filename.'_tnvedts_0.'. $extension; ?>"
             alt="Номер сертификата"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param1_number');">
        <input class="fields"
               id="form3param1_number"
               name="param1_number"
               type="text"
               form="addform3"
               placeholder="Пример: ТС BY/112 02.01. 002 00671"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать № сертификата">

        <label class="formlabel" for="form3param3_certification_agency">Орган по сертификации</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param3_certification_agency.png" alt="Орган по сертификации">
        <img class="formactual"
             id="tnvedts_1"
             src="<?php echo $path. '/'. $filename.'_tnvedts_1.'. $extension; ?>"
             alt="Орган по сертификации"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param3_certification_agency');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form3param3_certification_agency"
                      name="param3_certification_agency"
                      form="addform3"
                      placeholder="Пример: Научно-производственное республиканское унитарное предприятие &laquo;Белорусский государственный институт стандартизации и сертификации&raquo;; место нахождения: Республика Беларусь, 220113, г. Минск, ул. Мележа, 3, к. 406; фактический адрес: Республика Беларусь, 220113, г. Минск, ул. Мележа, 3; тел.: (+375 17) 237 14 21; факс: (+375 17) 262 16 23; e-mail: belgiss@mail.belpak.by; аттестат аккредитации: BY/112 002.03 от 03.06.1993, Республиканское унитарное предприятие &laquo;Белорусский государственный центр аккредитации&raquo;"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения об органе сертификации"
            ></textarea>
        </div>

        <label class="formlabel" for="form3parama_declarant">Заявитель</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-parama_declarant.png" alt="Заявитель">
        <img class="formactual"
             id="tnvedts_2"
             src="<?php echo $path. '/'. $filename.'_tnvedts_2.'. $extension; ?>"
             alt="Орган по сертификации"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3parama_declarant');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form3parama_declarant"
                      name="parama_declarant"
                      form="addform3"
                      placeholder="Представительство общества с ограниченной ответственностью &laquo;Самсунг Электроникс Рус Компани&raquo; (Российская Федерация) в Республике Беларусь; сведения о регистрации: разрешение Министерства иностранных дел Республики Беларусь № 5086 от 12.08.2010; место нахождения: Республика Беларусь, 220123, г. Минск, ул. В. Хоружей, 25, корпус 3, комната 1001; фактический адрес: Республика Беларусь, 220123, г. Минск, ул. В. Хоружей, 25, корпус 3, комната 1001; тел.: 290-72-65; факс: 290-72-65; e-mail: w.serc@samsung.com"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения о заявителе/декларанте"
            ></textarea>
        </div>

        <label class="formlabel" for="form3param6_manufacturer">Изготовитель</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param6_manufacturer.png" alt="Изготовитель">
        <img class="formactual"
             id="tnvedts_3"
             src="<?php echo $path. '/'. $filename.'_tnvedts_3.'. $extension; ?>"
             alt="Изготовитель"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param6_manufacturer');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form3param6_manufacturer"
                      name="param6_manufacturer"
                      form="addform3"
                      placeholder="Пример: SAMSUNG ELECTRONICS СО., LTD. Республика Корея, (Maetan-dong) 129, Samsung-ro, Yeongtong-gu, Suwon-si, Gyeonggi-do 443-742, Republic of Korea; заводы-изготовители указаны в приложении (бланк BY 0019972)"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения об изготовителе"></textarea>
        </div>

        <label class="formlabel" for="form3param4_product">Продукция (услуга, работа)</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param4_product.png" alt="Продукция (услуга, работа)">
        <img class="formactual"
             id="tnvedts_4"
             src="<?php echo $path. '/'. $filename.'_tnvedts_4.'. $extension; ?>"
             alt="Продукция (услуга, работа)"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param4_product');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form3param4_product"
                      name="param4_product"
                      form="addform3"
                      placeholder="Пример: Микроволновые печи торговой марки &laquo;SAMSUNG&raquo;, модели указаны в приложении (бланк BY 0019972), серийный выпуск"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать наименование продукции (услуги, работы)"></textarea>
        </div>

        <label class="formlabel" for="form3paramb_okp">Код ТН ВЭД ТС</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-okp.png" alt="Код ТН ВЭД ТС">
        <img class="formactual"
             id="tnvedts_5"
             src="<?php echo $path. '/'. $filename.'_tnvedts_5.'. $extension; ?>"
             alt="Код ТН ВЭД ТС"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3paramb_okp');">
        <input class="fields"
               id="form3paramb_okp"
               name="paramb_okp"
               type="text"
               form="addform3"
               placeholder="Пример: 8516 50 000 0"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать код ТН ВЭД ТС">

        <label class="formlabel" for="form3param5_complies_with">Соответствует требованиям</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param5_complies_with.png" alt="Соответствует требованиям">
        <img class="formactual"
             id="tnvedts_6"
             src="<?php echo $path. '/'. $filename.'_tnvedts_6.'. $extension; ?>"
             alt="Соответствует требованиям"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param5_complies_with');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form3param5_complies_with"
                      name="param5_complies_with"
                      form="addform3"
                      placeholder="Пример: ТР ТС 004/2011 &laquo;О безопасности низковольтного оборудования&raquo;, СТБ IEC 60335-1-2008, СТБ IEC 60335-2-25-2012, СТБ IEC 60335-2-9-2008, СТБ EN 50366-2007; ТР ТС 020/2011 &laquo;Электромагнитная совместимость технических средств&raquo;, ГОСТ Р 51318.11-2006 (СИСПР 11:2004), ГОСТ Р 51317.3.2-2006 (МЭК 61000-3-2:2005), ГОСТ Р 51317.3.3-2008 (МЭК 61000-3-3:2005), ГОСТ Р 51318.14.1-2006 (СИСПР 14-1:2005), ГОСТ Р 51318.14.2-2006 (СИСПР 14-2:2001)"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать каким требованиям удовлетворяет продукция"></textarea>
        </div>

        <label class="formlabel" for="form3param8_on_the_basis">На основании</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param8_on_the_basis.png" alt="На основании">
        <img class="formactual"
             id="tnvedts_7"
             src="<?php echo $path. '/'. $filename.'_tnvedts_7.'. $extension; ?>"
             alt="На основании"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param8_on_the_basis');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form3param8_on_the_basis"
                      name="param8_on_the_basis"
                      form="addform3"
                      placeholder="Пример: Акт от 15.11.2013; протоколы испытаний Испытательного центра БелГИСС, Республика Беларусь, аттестат аккредитации BY/112 02.1.0.0085 от 01.09.1995 (срок действия с 02.10.2009 по 02.10.2014), протоколы №№ 20618 ЭБ от 04.04.2012, 20615-1 ЭБ от 05.04.2012, 21830 ЭБ от 28.11.2012, 21825-1 ЭБ от 28.11.2012. 22388 ЭБ от 05.04.2013, 20659 ЭМС от 05.04.2012, 21826 ЭМС от 28.11.2012"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать на основании чего выдан сертификат"></textarea>
        </div>

        <label class="formlabel" for="form3param9_add_info">Дополнительная информация</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param9_add_info.png" alt="Дополнительная информация">
        <img class="formactual"
             id="tnvedts_8"
             src="<?php echo $path. '/'. $filename.'_tnvedts_8.'. $extension; ?>"
             alt="Дополнительная информация"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param9_add_info');">
        <div class="fields_width">
            <textarea class="fields"
                      id="form3param9_add_info"
                      name="param9_add_info"
                      form="addform3"
                      placeholder="Пример: Срок службы продукции 7 лет."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать дополнительную информацию о сертификате или поставить пробел"></textarea>
        </div>

        <label class="formlabel" for="form3param2_validity">Срок действия</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ss-param2_validity.png" alt="Срок действия">
        <img class="formactual"
             id="tnvedts_9"
             src="<?php echo $path. '/'. $filename.'_tnvedts_9.'. $extension; ?>"
             alt="Срок действия"
             title="Нажмите для распознавания текста"
             onclick="ocr(this.id, 'form3param2_validity');">
        <input class="fields"
               id="form3param2_validity"
               name="param2_validity"
               type="text"
               form="addform3"
               placeholder="Пример: с 18.03.2014 по 15.04.2018 включительно"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать срок действия сертификата">

        <img class="formtip" src="<?php echo $images_url; ?>/ss-footer.png" alt="Нижний колонтитул">

        <div style="width: 100%; height: 1px; margin: 10px 0; border-bottom: 1px #aaa solid;"></div>

        <label class="formlabel" for="form3advego_name">Ваше имя/ник на <strong>фриланс-бирже</strong></label>
        Необходимо указать имя/ник для идентификации исполнителя и оплаты выполненной работы

        <input class="fields"
               id="form3advego_name"
               name="advego_name"
               type="text"
               form="addform3"
               placeholder="Пример: vi_lenin"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать имя/ник исполнителя на фриланс-бирже для получения оплаты">

        <input type="hidden" name="img_edited" form="addform3" value="<?php echo $fname; ?>">
        <input type="hidden" name="img_edited2" form="addform3" value="<?php echo $fname2; ?>">
    </div>

    <button class="button" type="submit" form="addform3">Отправить</button>
</form>