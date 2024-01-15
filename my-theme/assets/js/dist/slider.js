export default function jqSlider($) {
    console.log('ready slider.js');
    const $fvImgs = $.makeArray($('.fv-slider .fv-img')).map((x) => $(x));
    const $fvDots = $.makeArray($('.fv-slider__dot')).map((x) => $(x));
    const fadeInterval_ms = 2000; // フェードイン・アウトの間隔
    const showInterval_ms = 5000; // 次の画像切り替えまでの間隔
    var currentSliderIndex = 0;
    var preventClick = false;
    setInterval(() => {
        slideNext();
    }, showInterval_ms);
    $('body').on('click', '.fv-slider__btn--prev', function () {
        slidePrev();
    });
    $('body').on('click', '.fv-slider__btn--next', function () {
        slideNext();
    });
    function slidePrev() {
        if (preventClick)
            return;
        preventClick = true;
        for (let i = 0; i < $fvImgs.length; i++) {
            const $fv = $fvImgs[i];
            if (!$fv.hasClass('hide')) {
                const j = (i + $fvImgs.length - 1) % $fvImgs.length;
                $fv.fadeOut(fadeInterval_ms, function () {
                    $(this).addClass('hide');
                    preventClick = false;
                });
                $fvImgs[j].fadeIn(fadeInterval_ms);
                $fvImgs[j].removeClass('hide');
                currentSliderIndex = j;
                break;
            }
        }
        // console.log('prev', currentSliderIndex);
    }
    function slideNext() {
        if (preventClick)
            return;
        preventClick = true;
        for (let i = 0; i < $fvImgs.length; i++) {
            const $fv = $fvImgs[i];
            if (!$fv.hasClass('hide')) {
                const j = (i + 1) % $fvImgs.length;
                $fv.fadeOut(fadeInterval_ms, function () {
                    $(this).addClass('hide');
                    preventClick = false;
                });
                $fvImgs[j].fadeIn(fadeInterval_ms);
                $fvImgs[j].removeClass('hide');
                currentSliderIndex = j;
                break;
            }
        }
        // console.log('next', currentSliderIndex);
    }
}
