const start = 'top bottom-=10%'

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

// スクロールトリガーでclass付与
ScrollTrigger.batch('.heading', {
  start: start,
  onEnter: (batch) => {
    for (const elm of batch) {
      elm.classList.add('js-animated')
    }
  },
  markers: true,
  once: true,
})

-------------------------------- */

//