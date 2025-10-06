document.addEventListener("DOMContentLoaded", () => {
    const downloadCertifyElement = document.querySelector('[data-link="certificate"]');
    if (!downloadCertifyElement) {
        return;
    }

    const downloadAppendixElement = document.querySelector('[data-link="appendix"]');
    const imageCertifyElement = document.querySelector('#certify__image');
    const imageAppendixElement = document.querySelector('#appendix__image');

    console.log(imageCertifyElement);

    function contextMenuEvent(e) {
        e.preventDefault();

        if (e.target.id === 'certify__image' && downloadCertifyElement) {
            scrollAndAnimate(downloadCertifyElement);
        } else if (e.target.id === 'appendix__image' && downloadAppendixElement) {
            scrollAndAnimate(downloadAppendixElement);
        }
    }

    if (imageCertifyElement) {
        imageCertifyElement.addEventListener('click', contextMenuEvent);
        imageCertifyElement.addEventListener('contextmenu', contextMenuEvent);
    }

    if (imageAppendixElement) {
        imageAppendixElement.addEventListener('click', contextMenuEvent);
        imageAppendixElement.addEventListener('contextmenu', contextMenuEvent);
    }
});

function scrollAndAnimate(element = null) {
    if (!element) return;

    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
    element.classList.add('specs__download_emphasized');

    clearTimeout(element.animationTimeout);
    element.animationTimeout = setTimeout(() => {
        element.classList.remove('specs__download_emphasized');
    }, 3000);
}