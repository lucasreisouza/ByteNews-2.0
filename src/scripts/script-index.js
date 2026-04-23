const body = document.querySelector('body');
const logoHeader = document.querySelector('#logoHeader');
const logoFooter = document.querySelector('#logoFooter');
const temaIcon = document.querySelector('#iconTema');

function toggleStyle() {
  if (body.classList.contains('dark')) {
    body.classList.remove('dark');
    body.classList.add('clear');
    logoHeader.src = './src/assets/icons/logo-claro.png';
    logoFooter.src = './src/assets/icons/logo-claro.png';
    temaIcon.src = './src/assets/icons/moon.png';
  } else {
    body.classList.remove('clear');
    body.classList.add('dark');
    logoHeader.src = './src/assets/icons/logo-padrao.png';
    logoFooter.src = './src/assets/icons/logo-padrao.png';
    temaIcon.src = './src/assets/icons/sun.png';
  }
}