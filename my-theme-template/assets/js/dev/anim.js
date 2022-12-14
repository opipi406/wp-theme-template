AOS.init({
  once: true,
})

const start = 'top bottom-=10%'
const markers = false

/**
 * GSAP初期設定
 */
gsap.defaults({
  ease: 'power3.out',
})

gsap.config({
  nullTargetWarn: false,
})

/* --------------------------------
  Sample Code
-----------------------------------

const jsAnimSelectors = [
  '.js-fadein',
]

// スクロールトリガーでclass付与
ScrollTrigger.batch(jsAnimSelectors.join(','), {
  start: start,
  onEnter: (batch) => {
    for (const elm of batch) {
      elm.classList.add('js-animated')
    }
  },
  markers: markers,
  once: true,
})

-------------------------------- */

//
