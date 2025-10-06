<?php
/**
 * forms/form-add-certify4.php
 *
 * The partial for displaying the form for adding Declaration of Conformity.
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
      name="addcertform4"
      id="addform4"
      onsubmit="return checkInput('addform4')">
    <h3>Декларация соответствия Таможенного союза</h3>
    <div class="fields__wrapper">
        <img class="formtip" src="<?php echo $images_url; ?>/ds-header.png" alt="Верхний колонтитул">

        <label class="formlabel" for="form4parama_declarant">Заявитель</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-parama_declarant.png" alt="Заявитель">
        <div class="fields_width">
            <textarea class="fields"
                      id="form4parama_declarant"
                      name="parama_declarant"
                      form="addform4"
                      placeholder="Пример: Общество с ограниченной ответственностью &laquo;Мастер Мармелада&raquo;, ОГРН: 1156952013140. Зарегистрировано Межрайонной инспекцией Федеральной налоговой службы №12 по Тверской области 19 июня 2015 г. Адрес: 170041, Россия, Тверская область, город Тверь, улица Михаила Румянцева, дом 44. Фактический адрес: 170041, Россия, Тверская область, город Тверь, улица Михаила Румянцева, дом 44, Телефон: 89066527731, E-mail: mironovasvu@mail.ru в лице генерального директора Мироновой Светланы Владимировны"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения о заявителе/декларанте"
            ></textarea>
        </div>

        <label class="formlabel" for="form4param4_product">Продукция (услуга, работа)</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-param4_product.png" alt="Продукция (услуга, работа)">
        <div class="fields_width">
            <textarea class="fields"
                      id="form4param4_product"
                      name="param4_product"
                      form="addform4"
                      placeholder="Пример: Мармелад желейный формовой: &laquo;С вареньем из апельсина&raquo;; &laquo;С вареньем из лимона и имбиря&raquo;; &laquo;С вареньем из черники&raquo;; &laquo;С вареньем из брусники&raquo;; &laquo;С вареньем из клубники&raquo;; &laquo;С вареньем из малины&raquo;; &laquo;С вареньем из вишни&raquo;; &laquo;С вареньем из яблок и корицы&raquo;; &laquo;С вареньем из киви&raquo;; &laquo;С вареньем из крыжовника&raquo;; &laquo;С вареньем из черной смородины&raquo;."
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать наименование продукции (услуги, работы)"></textarea>
        </div>

        <label class="formlabel" for="form4param6_manufacturer">Изготовитель</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-param6_manufacturer.png" alt="Изготовитель">
        <div class="fields_width">
            <textarea class="fields"
                      id="form4param6_manufacturer"
                      name="param6_manufacturer"
                      form="addform4"
                      placeholder="Пример: Общество с ограниченной ответственностью &laquo;Мастер Мармелада&raquo;. Адрес: 170041, Россия, Тверская область, город Тверь, улица Михаила Румянцева, дом 44. Фактический адрес: 170041, Россия, Тверская область, город Тверь, улица Михаила Румянцева, дом 44. ОГРН: 1156952013140, телефон: 89066527731, E-mail: mironovasvu@mail.ru"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать сведения об изготовителе"></textarea>
        </div>

        <label class="formlabel" for="form4paramb_okp">Код ТН ВЭД ТС</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-okp.png" alt="Код ТН ВЭД ТС">
        <input class="fields"
               id="form4paramb_okp"
               name="paramb_okp"
               type="text"
               form="addform4"
               placeholder="Пример: 1704 90 650 0"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать код ТН ВЭД ТС">

        <label class="formlabel" for="form4param5_complies_with">Соответствует требованиям</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-param5_complies_with.png" alt="Соответствует требованиям">
        <div class="fields_width">
            <textarea class="fields"
                      id="form4param5_complies_with"
                      name="param5_complies_with"
                      form="addform4"
                      placeholder="Пример: ТР ТС 021/2011 &laquo;О безопасности пищевой продукции&raquo;; ТР ТС 022/2011 &laquo;Пищевая продукция в части ее маркировки&raquo;"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать каким требованиям удовлетворяет продукция"></textarea>
        </div>

        <label class="formlabel" for="form4param8_on_the_basis">На основании</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-param8_on_the_basis.png" alt="На основании">
        <div class="fields_width">
            <textarea class="fields"
                      id="form4param8_on_the_basis"
                      name="param8_on_the_basis"
                      form="addform4"
                      placeholder="Пример: Протоколов испытаний № 4104-4105 от 15.08.2016 Тверской независимый испытательный центр ООО &laquo;Тверьтест&raquo;, Аттестат аккредитации № RA.RU.21ПУ24 от 27.07.2015г, адрес: г. Тверь, ул. Плеханова, д. 51"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать на основании чего выдана декларация"></textarea>
        </div>

        <label class="formlabel" for="form4param9_add_info">Дополнительная информация</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-param9_add_info.png" alt="Дополнительная информация">
        <div class="fields_width">
            <textarea class="fields"
                      id="form4param9_add_info"
                      name="param9_add_info"
                      form="addform4"
                      placeholder="Пример: Срок годности мармелада 6 месяцев при температуре хранения 10-20 град. С и относительной влажности воздуха 75-85%. Продукция маркируется единым знаком обращения на рынке Евразийского экономического союза"
                      onfocus="clearError(this.id)"
                      value=""
                      data-error="Необходимо указать дополнительную информацию о декларации или поставить пробел"></textarea>
        </div>

        <label class="formlabel" for="form4param1_number">№ декларации</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-param1_number.png" alt="Номер декларации">
        <input class="fields"
               id="form4param1_number"
               name="param1_number"
               type="text"
               form="addform4"
               placeholder="Пример: ТС N RU Д-RU.АЕ67.В01835"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать № декларации">

        <label class="formlabel" for="form4param2_validity">Срок действия</label>
        <img class="formtip" src="<?php echo $images_url; ?>/ds-param2_validity.png" alt="Срок действия">
        <input class="fields"
               id="form4param2_validity"
               name="param2_validity"
               type="text"
               form="addform4"
               placeholder="Пример: с 18.08.2016 по 18.08.2019 включительно"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать срок действия декларации">

        <div style="width: 100%; height: 1px; margin: 10px 0; border-bottom: 1px #aaa solid;"></div>

        <label class="formlabel" for="form4advego_name">Ваше имя/ник на <strong>фриланс-бирже</strong></label>
        Необходимо указать имя/ник для идентификации исполнителя и оплаты выполненной работы

        <input class="fields"
               id="form4advego_name"
               name="advego_name"
               type="text"
               form="addform4"
               placeholder="Пример: vi_lenin"
               onfocus="clearError(this.id)"
               value=""
               data-error="Необходимо указать имя/ник исполнителя на фриланс-бирже для получения оплаты">

        <input type="hidden" name="img_edited" form="addform4" value="<?php echo $fname; ?>">
        <input type="hidden" name="img_edited2" form="addform4" value="<?php echo $fname2; ?>">
    </div>

    <button class="button" type="submit" form="addform4">Отправить</button>
</form>