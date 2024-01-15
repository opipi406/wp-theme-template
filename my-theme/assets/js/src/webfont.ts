const fontURL =
  'https://fonts.googleapis.com/css2?family=Noto+Serif+JP&display=swap'

if (/android/i.test(navigator.userAgent)) {
  const e = document.createElement('link')
  e.rel = 'preconnect'
  e.href = 'https://fonts.googleapis.com'
  document.head.appendChild(e)

  const t = document.createElement('link')
  t.rel = 'preconnect'
  t.href = 'https://fonts.gstatic.com'
  t.crossOrigin = 'anonymous'
  document.head.appendChild(t)

  const n = document.createElement('link')
  n.rel = 'stylesheet'
  n.href = fontURL
  document.head.appendChild(n)

  window.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('ua-android')
  })
}
