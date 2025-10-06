/*
Только работа с базовыми функциями popup - закрытие попапов по нажатию кнопки, крестика или по нажатию escape, отображение и скрытие лоадера и оверлея
*/

console.log("popup.js loaded");

const body = document.querySelector("body");
const popups = document.querySelectorAll(".popup");
const crossClose = document.querySelectorAll(".popup__close");
const buttonsClose = document.querySelectorAll(".button_close");

const overlay = document.querySelector(".overlay");
const loader = document.querySelector(".loader");

crossClose.forEach((button) => button.addEventListener("click", hidePopups));
buttonsClose.forEach((button) => button.addEventListener("click", hidePopups));

if (overlay) {
    overlay.addEventListener("click", hidePopups);
}

window.addEventListener("keyup", (e) => {
    if (e.key === "Escape") {
        hidePopups();
    }
});

function hidePopups() {
    enableBodyScroll();
    hideOverlay();
    hideLoader();

    popups.forEach((popup) => {
        if (!popup.classList.contains("hidden")) {
            popup.classList.add("hidden");

            popup.dispatchEvent(new CustomEvent("popupClosed", { bubbles: true }));
        }
    });
}

export function showPopup(popup) {
    disableBodyScroll();

    showOverlay();
    hideLoader();

    popups.forEach((popup) => popup.classList.add("hidden"));
    if (popup) popup.classList.remove("hidden");
}

const disableBodyScroll = () => body && body.classList.add("noscroll");
const enableBodyScroll = () => body && body.classList.remove("noscroll");

const showOverlay = () => overlay && overlay.classList.remove("hidden");
const hideOverlay = () => overlay && overlay.classList.add("hidden");

export const showLoader = () => loader && loader.classList.remove("hidden");
export const hideLoader = () => loader && loader.classList.add("hidden");
