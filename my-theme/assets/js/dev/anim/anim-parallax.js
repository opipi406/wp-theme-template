import { start, markers } from './_variables'
/*
|--------------------------------------------------------------------------
| parallax
|--------------------------------------------------------------------------
*/

const parallaxElms = document.querySelectorAll('.anim-parallax')

parallaxElms.forEach((elm) => {
  const y = -elm.getAttribute('data-y') || -50

  gsap.to(elm, {
    yPercent: y,
    ease: 'none',
    scrollTrigger: {
      trigger: elm,
      start: start,
      scrub: 0,
      markers: markers,
    },
  })
})
