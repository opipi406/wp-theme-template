import { start, markers } from './_variables';
/*
|--------------------------------------------------------------------------
| タイトルアニメーション、ラインアニメーション
|--------------------------------------------------------------------------
*/
ScrollTrigger.batch(['.anim-ttl', '.anim-line'].join(','), {
    start: start,
    onEnter: (batch) => {
        for (const elm of batch) {
            elm.classList.add('animated');
        }
    },
    markers: markers,
    once: true,
});
