/*
Работа с popup для отправки заявок - валидация формы и отправка на бэк
*/

console.log("popup-subscribe.js loaded");

import { showPopup, showLoader, hideLoader } from "./popup.js";

const placeholders = {};

const popupOrder = document.querySelector("#popup-order");
const popupForm = popupOrder.querySelector(".popup__form");

const popupSuccess = document.querySelector("#popup-success");
const popupFailed = document.querySelector("#popup-failed");

//Кнопки фоксбустов с надписью Оставить заявку
const buttonsSubscribe = document.querySelectorAll(".button_subscribe");

//Отображение попапа с формой и наименованием фоксбуста
buttonsSubscribe.forEach((button) =>
    button.addEventListener("click", (e) => {
        showPopup(popupOrder);
        setProduct(e.target, popupOrder);
    })
);

const loader = document.querySelector(".loader");

//Скрытие попапа, сброс продукта, формы, очистка ошибок
function hidePopupAndResetForm() {
    // hidePopups();
    setProduct(undefined, popupOrder);
    resetForm(popupForm);
    clearFormErrors(popupForm);
}

popupOrder.addEventListener("popupClosed", hidePopupAndResetForm);

//Отправка заявки на бэк
popupForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (!checkFormErrors(e)) return;

    showLoader();

    const popupFormData = new FormData(popupForm);

    fetch("api/sendmail.php", {
        method: "POST",
        body: popupFormData,
    })
        .then(checkFetchResponse)
        .then((data) => {
            console.log("Заявка успешно отправлено", data);
            hidePopupAndResetForm();
            showPopup(popupSuccess);
        })
        .catch((error) => {
            console.error("Не удалось отправить заявку", error);
            hidePopupAndResetForm();
            showPopup(popupFailed);
        })
        .finally(() => {
            hideLoader();
        });

    function checkFetchResponse(res) {
        return res.ok ? res.json() : Promise.reject(`Ошибка Fetch: ${res.status}`);
    }
});

//Очистка ошибок полей формы по нажатию на поле
popupForm.addEventListener("click", (e) => {
    clearFormErrors(e.currentTarget);
});

//Сохранение значений плейсхолдеров из инпутов формы
const inputs = popupForm.querySelectorAll(".popup__input");
inputs.forEach((input) => (placeholders[input.name] = input.placeholder));

function setProduct(button, popup) {
    if (!popup) return console.error("DOM: no element #popup-order found");
    const inputProduct = popup.querySelector('.popup__form input[name="product"]');
    if (!inputProduct) return console.error("DOM: no element name=product found");
    const popupProduct = popup.querySelector(".popup__product");
    if (!popupProduct) return console.error("DOM: no .popup__product element found");
    const product = (button && button.dataset.product) || "Ошибка, фоксбуст не найден";
    inputProduct.value = product;
    popupProduct.textContent = `${product}`;
}

function checkFormErrors(e) {
    let isFormValid = true;

    const form = e.currentTarget;

    const formName = form.querySelector('input[name="name"]');
    const formEmail = form.querySelector('input[name="email"]');
    const formTel = form.querySelector('input[name="tel"]');

    if (!formName?.value.trim()) {
        console.warn('Error: no input "name" or no name specified in form');

        formName.classList.add("popup__input_error");
        formName.placeholder = "Укажите ваше имя";

        isFormValid = false;
    }

    if (!(formTel?.value.trim() || formEmail?.value.trim())) {
        console.warn('Error: no input "tel" or "e-mail" in form');
        console.warn("Error: or no tel or e-mail specified in form");

        formTel.classList.add("popup__input_error");
        formEmail.classList.add("popup__input_error");
        formTel.placeholder = "Укажите телефон";
        formEmail.placeholder = "или адрес e-mail";

        isFormValid = false;
    }

    return isFormValid;
}

function clearFormErrors(form) {
    if (!form) return console.error("DOM: no .form element found");

    const inputs = form.querySelectorAll(".popup__input");
    inputs.forEach((input) => {
        input.classList.remove("popup__input_error");
        input.placeholder = placeholders[input.name] || "";
    });
}

function resetForm(form) {
    if (!form) return console.error("DOM: no .form element found");
    form.reset();
}
