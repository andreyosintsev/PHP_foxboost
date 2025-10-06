$(document).ready(function () {
    let ambassadorsInitialized = false;
    const $ambassadors = $(".section-ambassador");

    function initCarousel() {
        if ($(window).width() <= 1440 && $(window).width() >= 480 && !ambassadorsInitialized) {
            $ambassadors.addClass("owl-carousel owl-theme").owlCarousel({
                items: 1.5,
                loop: true,
                nav: false,
                dots: false,
                autoplay: false,
                center: false,
                pullDrag: true,
                responsive: {
                    640: {
                        items: 2.5,
                    },
                    1000: {
                        items: 3.5,
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
