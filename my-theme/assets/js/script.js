/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/js/dev/_entry.js":
/*!*********************************!*\
  !*** ./assets/js/dev/_entry.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _main__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./main */ \"./assets/js/dev/main.js\");\n/* harmony import */ var _span_wrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./span-wrap */ \"./assets/js/dev/span-wrap.js\");\n/* harmony import */ var _span_wrap__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_span_wrap__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _anim_index__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./anim/index */ \"./assets/js/dev/anim/index.js\");\n// エントリポイント\n\n\n\n// import './webfont'\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/_entry.js?");

/***/ }),

/***/ "./assets/js/dev/anim/_variables.js":
/*!******************************************!*\
  !*** ./assets/js/dev/anim/_variables.js ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"markers\": function() { return /* binding */ markers; },\n/* harmony export */   \"start\": function() { return /* binding */ start; }\n/* harmony export */ });\nconst start = 'top bottom-=10%'\nconst markers = false\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/anim/_variables.js?");

/***/ }),

/***/ "./assets/js/dev/anim/anim-parallax.js":
/*!*********************************************!*\
  !*** ./assets/js/dev/anim/anim-parallax.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _variables__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_variables */ \"./assets/js/dev/anim/_variables.js\");\n\n/*\n|--------------------------------------------------------------------------\n| parallax\n|--------------------------------------------------------------------------\n*/\n\nconst parallaxElms = document.querySelectorAll('.anim-parallax')\n\nparallaxElms.forEach((elm) => {\n  const y = -elm.getAttribute('data-y') || -50\n\n  gsap.to(elm, {\n    yPercent: y,\n    ease: 'none',\n    scrollTrigger: {\n      trigger: elm,\n      start: _variables__WEBPACK_IMPORTED_MODULE_0__.start,\n      scrub: 0,\n      markers: _variables__WEBPACK_IMPORTED_MODULE_0__.markers,\n    },\n  })\n})\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/anim/anim-parallax.js?");

/***/ }),

/***/ "./assets/js/dev/anim/anim-title.js":
/*!******************************************!*\
  !*** ./assets/js/dev/anim/anim-title.js ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _variables__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_variables */ \"./assets/js/dev/anim/_variables.js\");\n\n/*\n|--------------------------------------------------------------------------\n| タイトルアニメーション、ラインアニメーション\n|--------------------------------------------------------------------------\n*/\n\nScrollTrigger.batch(['.anim-ttl', '.anim-line'].join(','), {\n  start: _variables__WEBPACK_IMPORTED_MODULE_0__.start,\n  onEnter: (batch) => {\n    for (const elm of batch) {\n      elm.classList.add('animated')\n    }\n  },\n  markers: _variables__WEBPACK_IMPORTED_MODULE_0__.markers,\n  once: true,\n})\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/anim/anim-title.js?");

/***/ }),

/***/ "./assets/js/dev/anim/anim-to-scroll.js":
/*!**********************************************!*\
  !*** ./assets/js/dev/anim/anim-to-scroll.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _variables__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_variables */ \"./assets/js/dev/anim/_variables.js\");\n\n/*\n|--------------------------------------------------------------------------\n| to scroll\n|--------------------------------------------------------------------------\n*/\n\nconst toScrollTimeline = gsap.timeline({\n  scrollTrigger: {\n    trigger: '.anim-to-scroll',\n    start: _variables__WEBPACK_IMPORTED_MODULE_0__.start,\n    markers: _variables__WEBPACK_IMPORTED_MODULE_0__.markers,\n  },\n})\ntoScrollTimeline.from(\n  '.to-scroll',\n  {\n    scaleX: 0,\n    alpha: 0,\n    duration: 1.5,\n    ease: 'power4.out',\n  },\n  0,\n)\ntoScrollTimeline.from(\n  '.to-scroll-line',\n  {\n    scaleY: 0,\n    alpha: 0,\n    duration: 3,\n    ease: 'power3.out',\n  },\n  1,\n)\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/anim/anim-to-scroll.js?");

/***/ }),

/***/ "./assets/js/dev/anim/anim-typography.js":
/*!***********************************************!*\
  !*** ./assets/js/dev/anim/anim-typography.js ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _variables__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_variables */ \"./assets/js/dev/anim/_variables.js\");\n\n/*\n|--------------------------------------------------------------------------\n| 本文のスライドアニメーション\n|--------------------------------------------------------------------------\n*/\n\ngsap.set('.anim-typography', {\n  opacity: 0,\n  x: 100,\n})\ngsap.to('.anim-typography', {\n  opacity: 1,\n  x: 0,\n  duration: 2,\n  scrollTrigger: {\n    trigger: '.anim-typography-trigger',\n    start: _variables__WEBPACK_IMPORTED_MODULE_0__.start,\n  },\n  stagger: 0.7,\n  markers: _variables__WEBPACK_IMPORTED_MODULE_0__.markers,\n})\n\ngsap.to('.char', {\n  y: 0,\n  stagger: 0.05,\n  delay: 0.2,\n  duration: 0.5,\n  ease: 'power2.out',\n})\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/anim/anim-typography.js?");

/***/ }),

/***/ "./assets/js/dev/anim/index.js":
/*!*************************************!*\
  !*** ./assets/js/dev/anim/index.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _anim_to_scroll__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./anim-to-scroll */ \"./assets/js/dev/anim/anim-to-scroll.js\");\n/* harmony import */ var _anim_title__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./anim-title */ \"./assets/js/dev/anim/anim-title.js\");\n/* harmony import */ var _anim_typography__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./anim-typography */ \"./assets/js/dev/anim/anim-typography.js\");\n/* harmony import */ var _anim_parallax__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./anim-parallax */ \"./assets/js/dev/anim/anim-parallax.js\");\nAOS.init({\n  once: true,\n  offset: Number(window.innerHeight / 5),\n})\n\n/**\n * GSAP初期設定\n */\ngsap.defaults({\n  ease: 'power3.out',\n})\n\ngsap.config({\n  nullTargetWarn: false,\n})\n\n;\n\n\n\n\n/* --------------------------------\n  Sample Code\n-----------------------------------*\n\n// スクロールトリガーでclass付与\nScrollTrigger.batch('.js-fadein', {\n  start: start,\n  onEnter: (batch) => {\n    for (const elm of batch) {\n      elm.classList.add('animated')\n    }\n  },\n  markers: markers,\n  once: true,\n})\n\n// staggerサンプル\ngsap.set('.card', {\n  opacity: 0,\n  x: 100,\n})\ngsap.to('.card', {\n  opacity: 1,\n  x: 0,\n  duration: 2,\n  scrollTrigger: {\n    trigger: '.card-list',\n    start: start,\n  },\n  stagger: {\n    amount: 1,\n  },\n  markers: markers,\n})\n\n-------------------------------- */\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/anim/index.js?");

/***/ }),

/***/ "./assets/js/dev/burger-menu.js":
/*!**************************************!*\
  !*** ./assets/js/dev/burger-menu.js ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": function() { return /* binding */ jqBurgerMenu; }\n/* harmony export */ });\nfunction jqBurgerMenu($) {\n  console.log('ready burger-menu.js')\n\n  const selectors = ['.burger', '.burger-overlay']\n\n  $('.js-burger-open').click(function (e) {\n    $(selectors.join(', ')).toggleClass('open')\n    $('body').toggleClass('disabled-scroll')\n  })\n\n  $('.js-burger-close').click(function (e) {\n    $(selectors.join(', ')).removeClass('open')\n    $('body').removeClass('disabled-scroll')\n  })\n}\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/burger-menu.js?");

/***/ }),

/***/ "./assets/js/dev/main.js":
/*!*******************************!*\
  !*** ./assets/js/dev/main.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _burger_menu__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./burger-menu */ \"./assets/js/dev/burger-menu.js\");\n/* harmony import */ var _slider__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./slider */ \"./assets/js/dev/slider.js\");\n\n\n\njQuery(function ($) {\n  console.log('ready main.js')\n\n  /**\n   * スムーススクロール\n   */\n  $('a[href^=\"#\"]').click(function () {\n    const speed = 500\n    const href = $(this).attr('href')\n    const target = $(href == '#' || href == '' ? 'html' : href)\n    const position = target.offset().top\n    $('html').animate(\n      {\n        scrollTop: position,\n      },\n      speed,\n      'swing',\n    )\n    return false\n  })\n\n  ;(0,_burger_menu__WEBPACK_IMPORTED_MODULE_0__[\"default\"])($)\n  ;(0,_slider__WEBPACK_IMPORTED_MODULE_1__[\"default\"])($)\n})\n\n/**\n * ローディングアニメーションはここに記載する。\n * on ready内に書くとモバイル環境で正常に発火しない可能性がある\n */\njQuery(window).on('load', function () {\n  const $ = jQuery\n  //\n})\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/main.js?");

/***/ }),

/***/ "./assets/js/dev/slider.js":
/*!*********************************!*\
  !*** ./assets/js/dev/slider.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": function() { return /* binding */ jqSlider; }\n/* harmony export */ });\nfunction jqSlider($) {\n  console.log('ready slider.js')\n\n  const $fvImgs = $.makeArray($('.fv-slider .fv-img')).map((x) => $(x))\n  const $fvDots = $.makeArray($('.fv-slider__dot')).map((x) => $(x))\n  const fadeInterval_ms = 1000 // フェードイン・アウトの間隔\n  const showInterval_ms = 5000 // 次の画像切り替えまでの間隔\n\n  var currentSliderIndex = 0\n  var preventClick = false\n\n  setInterval(() => {\n    slideNext()\n  }, showInterval_ms)\n\n  $('body').on('click', '.fv-slider__btn--prev', function () {\n    slidePrev()\n  })\n  $('body').on('click', '.fv-slider__btn--next', function () {\n    slideNext()\n  })\n\n  function slidePrev() {\n    if (preventClick) return\n    preventClick = true\n\n    for (let i = 0; i < $fvImgs.length; i++) {\n      const $fv = $fvImgs[i]\n\n      if (!$fv.hasClass('hide')) {\n        const j = (i + $fvImgs.length - 1) % $fvImgs.length\n        const $currentDot = $fvDots[j]\n\n        $('.fv-slider__dot').removeClass('current')\n        $currentDot.addClass('current')\n\n        $fv.fadeOut(fadeInterval_ms, function () {\n          $(this).addClass('hide')\n          preventClick = false\n        })\n        $fvImgs[j].fadeIn(fadeInterval_ms)\n        $fvImgs[j].removeClass('hide')\n\n        currentSliderIndex = j\n        break\n      }\n    }\n    // console.log('prev', currentSliderIndex);\n  }\n\n  function slideNext() {\n    if (preventClick) return\n    preventClick = true\n\n    for (let i = 0; i < $fvImgs.length; i++) {\n      const $fv = $fvImgs[i]\n\n      if (!$fv.hasClass('hide')) {\n        const j = (i + 1) % $fvImgs.length\n        const $currentDot = $fvDots[j]\n\n        $('.fv-slider__dot').removeClass('current')\n        $currentDot.addClass('current')\n\n        $fv.fadeOut(fadeInterval_ms, function () {\n          $(this).addClass('hide')\n          preventClick = false\n        })\n        $fvImgs[j].fadeIn(fadeInterval_ms)\n        $fvImgs[j].removeClass('hide')\n\n        currentSliderIndex = j\n        break\n      }\n    }\n    // console.log('next', currentSliderIndex);\n  }\n}\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/slider.js?");

/***/ }),

/***/ "./assets/js/dev/span-wrap.js":
/*!************************************!*\
  !*** ./assets/js/dev/span-wrap.js ***!
  \************************************/
/***/ (function() {

eval("/**\n * テキストをspanで分解\n * @param string selector\n * @param string className\n */\nfunction spanWrap(selector, className = 'char') {\n  const targets = document.querySelectorAll(selector)\n\n  if (className) {\n    className = ` class=\"${className}\"`\n  }\n\n  for (const target of targets) {\n    const nodes = [...target.childNodes]\n\n    let spanWrapText = ''\n\n    nodes.forEach((node) => {\n      if (node.nodeType == 3) {\n        const text = node.textContent.replace(/\\r?\\n/g, '') // テキストから改行コード削除\n        // spanで囲んで連結\n        spanWrapText =\n          spanWrapText +\n          text.split('').reduce((acc, v) => {\n            return acc + `<span${className}>${v}</span>`\n          }, '')\n      } else {\n        //テキスト以外\n        //<br>などテキスト以外の要素をそのまま連結\n        spanWrapText = spanWrapText + node.outerHTML\n      }\n    })\n\n    target.innerHTML = spanWrapText\n  }\n}\n\nwindow.addEventListener('DOMContentLoaded', function () {\n  spanWrap('.anim-ttl')\n})\n\n\n//# sourceURL=webpack://wp-theme/./assets/js/dev/span-wrap.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/js/dev/_entry.js");
/******/ 	
/******/ })()
;