const body = document.querySelector('body');
const logo = document.querySelector('#logo');
const tema = document.querySelector('#tema')

function toggleStyle() {
  if (body.classList.contains('dark')) {
    body.classList.remove('dark');
    body.classList.add('clear');
    logo.setAttribute('src', './src/assets/icons/logo-claro.png');
  } else {
    body.classList.remove('clear');
    body.classList.add('dark');
    logo.setAttribute('src', './src/assets/icons/logo-padrao.png');
  }
}