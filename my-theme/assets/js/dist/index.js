import jqBurgerMenu from './burger-menu';
import jqSlider from './slider';
import jqAccordion from './accordion';
jQuery(function ($) {
    console.log('ready main.js');
    /**
     * スムーススクロール
     */
    $('a[href^="#"]').click(function () {
        var _a, _b;
        const speed = 500;
        const href = (_a = $(this).attr('href')) !== null && _a !== void 0 ? _a : '';
        const target = $(href == '#' || href == '' ? 'html' : href);
        const position = (_b = target.offset()) === null || _b === void 0 ? void 0 : _b.top;
        $('html').animate({
            scrollTop: position,
        }, speed, 'swing');
        return false;
    });
    jqBurgerMenu($);
    jqSlider($);
    jqAccordion($);
});
/**
 * ローディングアニメーションはここに記載する。
 * on ready内に書くとモバイル環境で正常に発火しない可能性がある
 */
jQuery(window).on('load', function () {
    const $ = jQuery;
    //
});
import './invert';
import './span-wrap';
import './animation/index';
// import './webfont'
