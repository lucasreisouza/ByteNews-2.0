const body = document.body;
const logoHeader = document.getElementById('logoHeader');
const logoFooter = document.getElementById('logoFooter');
const temaIcon = document.getElementById('iconTema');

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