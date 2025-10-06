$(document).ready(function () {
    const $carousels = $(".section-foxboost");

    function initCarousel($carousel) {
        if ($(window).width() <= 1440 && $(window).width() >= 480 && !$carousel.data("carousel-initialized")) {
            $carousel.addClass("owl-carousel owl-theme").owlCarousel({
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
            $carousel.data("carousel-initialized", true);
        }
    }

    function destroyCarousel($carousel) {
        if ($(window).width() > 1440 || $(window).width() < 480) {
            if ($carousel.data("carousel-initialized")) {
                $carousel.trigger("destroy.owl.carousel").removeClass("owl-carousel owl-theme");
                $carousel.data("carousel-initialized", false);
            }
        }
    }

    function handleCarousels() {
        $carousels.each(function () {
            const $carousel = $(this);
            initCarousel($carousel);
            destroyCarousel($carousel);
        });
    }

    handleCarousels();

    $(window).resize(function () {
        handleCarousels();
    });
});
