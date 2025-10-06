$(document).ready(function () {
    $(".slider-hero__cards").owlCarousel({
        items: 1,
        loop: true,
        autoplay: false,
        autoplayTimeout: 5000,
        nav: false,
        dots: true,
        animateIn: "fadeInLeft",
        animateOut: "fadeOutLeft",
        pullDrag: true,
        // autoWidth: true,
        // autoHeight: false,
    });
});
