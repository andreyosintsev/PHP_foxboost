$(document).ready(function () {
    let ambassadorsInitialized = false;
    const $ambassadors = $(".section-ambassador");

    function initCarousel() {
        if ($(window).width() <= 1440 && $(window).width() >= 480 && !ambassadorsInitialized) {
            $ambassadors.addClass("owl-carousel owl-theme").owlCarousel({
                items: 2,
                loop: false,
                nav: false,
                dots: false,
                autoplay: false,
                center: false,
                pullDrag: true,
                responsive: {
                    900: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    },
                },
            });

            ambassadorsInitialized = true;
        }
    }

    function destroyCarousel() {
        if ($(window).width() > 1440 || $(window).width() < 480) {
            if (ambassadorsInitialized) {
                $ambassadors.trigger("destroy.owl.carousel").removeClass("owl-carousel owl-theme");
                ambassadorsInitialized = false;
            }
        }
    }

    initCarousel();
    destroyCarousel();

    $(window).resize(function () {
        initCarousel();
        destroyCarousel();
    });
});
