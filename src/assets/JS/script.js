const body = document.querySelector('body');
const logoHeader = document.querySelector('#logoHeader');
const logoFooter = document.querySelector('#logoFooter');
const temaIcon = document.querySelector('#iconTema');

function getAssetPath(fileName) {
  const path = window.location.pathname;
  // Pega tudo antes do /src/ -> ex: /GitHub/ByteNews-2.0
  const root = path.includes('/src/')? path.split('/src/')[0] : path.substring(0, path.lastIndexOf('/'));
  // root + /src/assets/icons/file
  return root + '/src/assets/icons/' + fileName;
}

function setImagens(isClear) {
  const logoFile = isClear? 'logo-claro.png' : 'logo-padrao.png';
  const iconFile = isClear? 'moon.png' : 'sun.png';

  const logoPath = getAssetPath(logoFile);
  const iconPath = getAssetPath(iconFile);

  console.log('Carregando:', logoPath);

  if (logoHeader) logoHeader.src = logoPath;
  if (logoFooter) logoFooter.src = logoPath;
  if (temaIcon) temaIcon.src = iconPath;
}

function toggleStyle() {
  const isDark = body.classList.contains('dark');
  if (isDark) {
    body.classList.replace('dark', 'clear');
    setImagens(true);
  } else {
    body.classList.replace('clear', 'dark');
    setImagens(false);
  }
  localStorage.setItem('tema', body.classList.contains('clear')? 'clear' : 'dark');
}

document.addEventListener('DOMContentLoaded', () => {
  const temaSalvo = localStorage.getItem('tema');
  if (temaSalvo === 'clear') {
    body.classList.remove('dark');
    body.classList.add('clear');
    setImagens(true);
  } else {
    body.classList.add('dark');
    setImagens(false);
  }
});


/* ================= COMENTARIOS DAS NOTICIAS ================= */

function getLoggedUser() {
  try {
    const user = JSON.parse(localStorage.getItem('byteNewsUser'));
    if (user && user.loggedIn && user.name) return user;
  } catch (error) {
    console.error('Não foi possível ler o usuário logado.', error);
  }
  return null;
}

function getCurrentNewsKey() {
  return 'byteNewsComments_' + window.location.pathname;
}

function getComments() {
  try {
    return JSON.parse(localStorage.getItem(getCurrentNewsKey())) || [];
  } catch (error) {
    return [];
  }
}

function saveComments(comments) {
  localStorage.setItem(getCurrentNewsKey(), JSON.stringify(comments));
}

function renderComments() {
  const commentsList = document.querySelector('#commentsList');
  if (!commentsList) return;

  commentsList.innerHTML = '';
  const comments = getComments();

  if (comments.length === 0) {
    const empty = document.createElement('p');
    empty.className = 'comment-login-message';
    empty.textContent = 'Ainda não há comentários. Seja o primeiro a comentar!';
    commentsList.appendChild(empty);
    return;
  }

  comments.forEach(comment => {
    const item = document.createElement('article');
    item.className = 'comment-item';

    const name = document.createElement('strong');
    name.textContent = comment.name;

    const text = document.createElement('p');
    text.textContent = comment.text;

    item.appendChild(name);
    item.appendChild(text);
    commentsList.appendChild(item);
  });
}

function setupComments() {
  const form = document.querySelector('#commentForm');
  const textarea = document.querySelector('#commentText');
  const button = document.querySelector('#commentButton');
  const error = document.querySelector('#commentError');

  if (!form || !textarea || !button) return;

  const user = getLoggedUser();

  if (!user) {
    button.textContent = 'Fazer login';
    button.type = 'button';
    button.addEventListener('click', () => {
      window.location.href = '../account/login.php?redirect=' + encodeURIComponent(window.location.pathname);
    });
    textarea.addEventListener('focus', () => {
      textarea.blur();
    });
    textarea.setAttribute('readonly', 'readonly');
    textarea.placeholder = 'Faça login para escrever um comentário.';
  } else {
    button.textContent = 'Comentar';
    button.type = 'submit';
    textarea.removeAttribute('readonly');
    textarea.placeholder = 'Escreva seu comentário...';

    form.addEventListener('submit', event => {
      event.preventDefault();
      const text = textarea.value.trim();

      if (!text) {
        error.textContent = 'Digite um comentário antes de enviar.';
        error.style.display = 'block';
        return;
      }

      error.style.display = 'none';

      const comments = getComments();
      comments.push({
        name: user.name,
        text: text
      });

      saveComments(comments);
      textarea.value = '';
      renderComments();
    });
  }

  renderComments();
}

document.addEventListener('DOMContentLoaded', setupComments);
