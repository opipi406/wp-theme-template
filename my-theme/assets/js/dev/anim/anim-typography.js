import { start, markers } from './_variables'
/*
|--------------------------------------------------------------------------
| 本文のスライドアニメーション
|--------------------------------------------------------------------------
*/

gsap.set('.anim-typography', {
  opacity: 0,
  x: 100,
})
gsap.to('.anim-typography', {
  opacity: 1,
  x: 0,
  duration: 2,
  scrollTrigger: {
    trigger: '.anim-typography-trigger',
    start: start,
  },
  stagger: 0.7,
  markers: markers,
})

gsap.to('.char', {
  y: 0,
  stagger: 0.05,
  delay: 0.2,
  duration: 0.5,
  ease: 'power2.out',
})
