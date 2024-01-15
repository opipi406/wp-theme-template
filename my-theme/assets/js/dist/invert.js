let ticking = false;
import { breakPoints } from './constants';
const invertHeightThreasold = window.innerWidth < breakPoints.md
    ? window.innerHeight - 50
    : window.innerHeight - window.innerHeight / 2;
window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            handleScroll();
            ticking = false;
        });
        ticking = true;
    }
});
const handleScroll = () => {
    const $header = document.querySelector('header');
    if (window.scrollY >= invertHeightThreasold) {
        $header === null || $header === void 0 ? void 0 : $header.classList.add('-invert');
    }
    else {
        $header === null || $header === void 0 ? void 0 : $header.classList.remove('-invert');
    }
};
