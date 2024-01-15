import jqBurgerMenu from './burger-menu'
import jqSlider from './slider'
import jqAccordion from './accordion'

jQuery(function ($) {
  console.log('ready main.js')

  /**
   * スムーススクロール
   */
  $('a[href^="#"]').click(function () {
    const speed = 500
    const href = $(this).attr('href') ?? ''
    const target = $(href == '#' || href == '' ? 'html' : href)
    const position = target.offset()?.top
    $('html').animate(
      {
        scrollTop: position,
      },
      speed,
      'swing',
    )
    return false
  })

  jqBurgerMenu($)
  jqSlider($)
  jqAccordion($)
})

/**
 * ローディングアニメーションはここに記載する。
 * on ready内に書くとモバイル環境で正常に発火しない可能性がある
 */
jQuery(window).on('load', function () {
  const $ = jQuery
  //
})

import './invert'
import './span-wrap'
import './animation/index'
// import './webfont'
