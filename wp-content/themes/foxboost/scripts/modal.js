document.addEventListener('DOMContentLoaded', () => {
    const body = document.querySelector('body');
    const modals = document.querySelectorAll('.modal');
    const overlay = document.querySelector('.modal-overlay');
    const closeButtons = document.querySelectorAll('.modal__close');

    closeButtons.forEach(closeButton =>
        closeButton.addEventListener('click',
            () => closeModal(body, closeButton.closest('.modal'), overlay))
    );

    if (overlay) overlay.addEventListener('click', () => {
        modals.forEach(modal => closeModal(body, modal, overlay));
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape')
            modals.forEach(modal => closeModal(body, modal, overlay));
    })
})

function closeModal(body, modal, overlay) {
    if (modal) modal.classList.remove('modal_visible');

    const visibleModals = document.querySelectorAll('.modal_visible');

    if (visibleModals.length === 0) {
        if (overlay) overlay.classList.remove('modal-overlay_visible');
        if (body) body.classList.remove('no-scroll');
    }
}
