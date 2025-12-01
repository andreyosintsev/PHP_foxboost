/*
Отображение попапа об успешной деактивации учетной записи
*/

console.log("popup-deactivation.js loaded");

import {showPopup} from "./popup.js";

const params = new URLSearchParams(window.location.search);
if (params.get('deactivated') === '1') {
    const popupDeactivate = document.querySelector('#popup-deactivate');
    if (popupDeactivate) {
        showPopup(popupDeactivate);
        window.history.replaceState({}, document.title, window.location.pathname);
    } else console.warn('DOM: no #popup-deactivate found');
}