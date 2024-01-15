import gsap from 'gsap'

export function initializeAOS(_AOS: Aos.Aos) {
  console.log('initialize AOS')

  _AOS.init({
    once: true,
    duration: 2500,
    offset: Number(window.innerHeight / 5),
  })
}

export function initializeGSAP(_gsap: typeof gsap) {
  console.log('initialize GSAP')

  _gsap.defaults({
    ease: 'power3.out',
  })

  _gsap.config({
    nullTargetWarn: false,
  })
}
