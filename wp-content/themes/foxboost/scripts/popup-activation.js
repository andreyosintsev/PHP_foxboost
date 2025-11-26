/*
Отображение попапа об успешной активации учетной записи
*/

console.log("popup-activation.js loaded");

import {showPopup} from "./popup.js";

const params = new URLSearchParams(window.location.search);
if (params.get('activated') === '1') {
    const popupSubscribe = document.querySelector('#popup-subscribe');
    if (popupSubscribe) {
        showPopup(popupSubscribe);
        window.history.replaceState({}, document.title, window.location.pathname);
    } else console.warn('DOM: no #popup-subscribe found');
}