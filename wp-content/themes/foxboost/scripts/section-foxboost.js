$(document).ready(function () {
    const $carousels = $(".section-foxboost");

    function initCarousel($carousel) {
        if ($(window).width() <= 1440 && $(window).width() >= 480 && !$carousel.data("carousel-initialized")) {
            $carousel.addClass("owl-carousel owl-theme").owlCarousel({
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

    $(window).on('resize', () => {
        $('.owl-carousel').trigger('refresh.owl.carousel');
    });
});
