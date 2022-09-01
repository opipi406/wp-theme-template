jQuery(function ($) {

  // ハンバーガーボタンのクリックイベント
  $("body").on("click", ".burger-menu__btn, .burger-overlay, .menu-item", function () {
    const selectors = [
      ".burger-menu",
      ".burger-menu__btn",
      ".burger-menu-line",
      ".burger-menu__nav",
      ".burger-overlay",
    ];
    $(selectors.join(', ')).toggleClass("open");
    $("body, html").toggleClass("scroll-prevent");
  });
  
});