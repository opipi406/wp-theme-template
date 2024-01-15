import { start, markers } from './_variables';
/*
|--------------------------------------------------------------------------
| to scroll
|--------------------------------------------------------------------------
*/
const toScrollTimeline = gsap.timeline({
    scrollTrigger: {
        trigger: '.anim-to-scroll',
        start: start,
        markers: markers,
    },
});
toScrollTimeline.from('.to-scroll', {
    scaleX: 0,
    alpha: 0,
    duration: 1.5,
    ease: 'power4.out',
}, 0);
toScrollTimeline.from('.to-scroll-line', {
    scaleY: 0,
    alpha: 0,
    duration: 3,
    ease: 'power3.out',
}, 1);
