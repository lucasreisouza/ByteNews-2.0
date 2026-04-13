const body = document.querySelector('body');
const logo = document.querySelector('#logo');
const tema = document.querySelector('#tema')

function toggleStyle() {
  if (body.classList.contains('claro')) {
    body.classList.remove('claro');
    body.classList.add('escuro');
    logo.setAttribute('src', './imagens/logo.png');
  } else {
    body.classList.remove('escuro');
    body.classList.add('claro');
    logo.setAttribute('src', './Imagens/logo.png');
  }
}