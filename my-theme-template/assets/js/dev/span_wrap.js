/**
 * テキストをspanで分解
 * @param string selector
 * @param string className
 */
 function spanWrap(selector, className = 'char') {
  const targets = document.querySelectorAll(selector)

  if (className) {
    className = ` class="${className}"`
  }

  for (const target of targets) {
    const nodes = [...target.childNodes]
  
    let spanWrapText = ''
  
    nodes.forEach((node) => {
      if (node.nodeType == 3) {
        const text = node.textContent.replace(/\r?\n/g, '') // テキストから改行コード削除
        // spanで囲んで連結
        spanWrapText =
          spanWrapText +
          text.split('').reduce((acc, v) => {
            return acc + `<span${className}>${v}</span>`
          }, '')
      } else {
        //テキスト以外
        //<br>などテキスト以外の要素をそのまま連結
        spanWrapText = spanWrapText + node.outerHTML
      }
    })
  
    target.innerHTML = spanWrapText
  }
}

window.addEventListener('DOMContentLoaded', function () {
  // 
})
