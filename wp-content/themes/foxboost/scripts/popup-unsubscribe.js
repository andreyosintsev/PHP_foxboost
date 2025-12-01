/*
Отображение попапа об успешной деактивации учетной записи
*/

console.log("popup-unsubscribe.js loaded");

import {showPopup} from "./popup.js";

const params = new URLSearchParams(window.location.search);
if (params.get('unsubscribed') === '1') {
    const popupUnsubscribe = document.querySelector('#popup-unsubscribe');
    if (popupUnsubscribe) {
        showPopup(popupUnsubscribe);
        window.history.replaceState({}, document.title, window.location.pathname);
    } else console.warn('DOM: no #popup-unsubscribe found');
}