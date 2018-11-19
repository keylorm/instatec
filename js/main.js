$(document).ready(function () {


    var minSlider = 1;
    var maxSlider = 3;
    var slideWidth = 370;
    var slideMargin = 0;

    var widthScre = $(document).width();
    var controlsSlider = false;

    if (widthScre <= 1030) {
        minSlider = 1;
        maxSlider = 3;
        slideWidth = 310;
        slideMargin = 0;
    }

    if (widthScre <= 991) {
        minSlider = 1;
        maxSlider = 2;
        slideWidth = 340;
        slideMargin = 0;
    }

    if (widthScre <= 767) {
        minSlider = 1;
        maxSlider = 2;
        slideWidth = 365;
        slideMargin = 15;
        controlsSlider = false;
    }

    if (widthScre <= 479) {
        minSlider = 1;
        maxSlider = 2;
        slideWidth = 350;
        slideMargin = 15;
    }

    var carousel = $('.bxslider');
   
    if (carousel.length !== 0) {
        carousel.bxSlider({
            minSlides: minSlider,
            maxSlides: maxSlider,
            slideWidth: slideWidth,
            slideMargin: slideMargin,
            responsive: true,
            pager: true,
            controls: controlsSlider,
            auto: true,
            pause: 5000,
            autoStart: true
        });
    }

  
});