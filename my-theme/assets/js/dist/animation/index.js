import { initializeAOS, initializeGSAP } from './settings';
if (typeof AOS !== 'undefined') {
    initializeAOS(AOS);
}
if (typeof gsap !== 'undefined') {
    initializeGSAP(gsap);
}
// import './anim-to-scroll'
// import './anim-title'
// import './anim-typography'
// import './anim-parallax'
/* --------------------------------
  Sample Code
-----------------------------------*

// スクロールトリガーでclass付与
ScrollTrigger.batch('.js-fadein', {
  start: start,
  onEnter: (batch) => {
    for (const elm of batch) {
      elm.classList.add('animated')
    }
  },
  markers: markers,
  once: true,
})

// staggerサンプル
gsap.set('.card', {
  opacity: 0,
  x: 100,
})
gsap.to('.card', {
  opacity: 1,
  x: 0,
  duration: 2,
  scrollTrigger: {
    trigger: '.card-list',
    start: start,
  },
  stagger: {
    amount: 1,
  },
  markers: markers,
})

-------------------------------- */
