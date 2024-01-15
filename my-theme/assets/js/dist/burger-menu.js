export default function jqBurgerMenu($) {
    console.log('ready burger-menu.js');
    const selectors = ['.burger', '.burger-overlay'];
    $('.js-burger-open').on('click', function (e) {
        $(selectors.join(', ')).toggleClass('open');
        $('body').toggleClass('disabled-scroll');
    });
    $('.js-burger-close').on('click', function (e) {
        $(selectors.join(', ')).removeClass('open');
        $('body').removeClass('disabled-scroll');
    });
}
