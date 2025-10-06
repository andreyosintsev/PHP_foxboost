(function() {

    document.addEventListener('DOMContentLoaded', () => {
        const backToTop = document.querySelector('.back-to-top');

        if (!backToTop) {
            return console.error('DOM: no .back-to-top element found');
        }

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        document.addEventListener('scroll', () => {
            if (window.scrollY > window.innerHeight) {
                showBackToTop(backToTop);
            } else {
                hideBackToTop(backToTop);
            }
        });
    });

    function showBackToTop(button) {
        if (!button) return;

        button.classList.remove('invisible');
    }

    function hideBackToTop(button) {
        if (!button) return;

        button.classList.add('invisible');
    }

})();
