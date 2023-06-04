export default function jqBurgerMenu($) {
  console.log('ready burger-menu.js')

  const selectors = [
    '.burger-menu',
    '.burger-menu-line',
    '.burger-menu__nav',
    '.burger-overlay',
    '.js-burger-open',
  ]

  $('body').on('click', '.js-burger-open', function () {
    $(selectors.join(', ')).toggleClass('open')
    if ($(this).hasClass('open')) {
      document.addEventListener('touchmove', noscroll, {
        passive: false,
      })
      document.addEventListener('mousewheel', noscroll, {
        passive: false,
      })
    } else {
      document.removeEventListener('touchmove', noscroll, {
        passive: false,
      })
      document.removeEventListener('mousewheel', noscroll, {
        passive: false,
      })
    }
  })

  $('body').on('click', '.js-burger-close', function () {
    $(selectors.join(', ')).removeClass('open')
    document.removeEventListener('touchmove', noscroll, {
      passive: false,
    })
    document.removeEventListener('mousewheel', noscroll, {
      passive: false,
    })
  })

  const burgerElm = document.querySelector('.burger-menu__nav')
  burgerElm.scrollTop = 1

  burgerElm.addEventListener('scroll', function (e) {
    if (burgerElm.scrollTop === 0) {
      burgerElm.scrollTop = 1
    } else if (
      burgerElm.scrollTop + burgerElm.clientHeight ===
      burgerElm.scrollHeight
    ) {
      burgerElm.scrollTop = burgerElm.scrollTop - 1
    }
  })

  function noscroll(e) {
    if (
      $(e.target).closest('.burger-menu__nav').length > 0 &&
      burgerElm.scrollTop !== 0 &&
      burgerElm.scrollTop + burgerElm.clientHeight !== burgerElm.scrollHeight
    ) {
      e.stopPropagation()
    } else {
      e.preventDefault()
    }
  }
}
