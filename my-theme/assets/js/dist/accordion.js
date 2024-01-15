import { breakPoints } from './constants';
export default function jqAccordion($) {
    const accordionItems = $('.faq-item');
    accordionItems.each(function () {
        const question = $(this).find('.faq-item-question');
        const answer = $(this).find('.faq-item-answer');
        question.on('click', function () {
            if (window.innerWidth >= breakPoints.sm) {
                return;
            }
            answer.stop().slideToggle(200, 'swing');
            $(this).parent().toggleClass('-open');
        });
    });
}
