const body = document.querySelector('body');
const logoHeader = document.querySelector('#logoHeader');
const logoFooter = document.querySelector('#logoFooter');
const temaIcon = document.querySelector('#iconTema');

function toggleStyle() {
  if (body.classList.contains('dark')) {
    body.classList.remove('dark');
    body.classList.add('clear');
    logoHeader.src = '/src/assets/icons/logo-claro.png';
    logoFooter.src = '/src/assets/icons/logo-claro.png';
    temaIcon.src = '/src/assets/icons/moon.png';
  } else {
    body.classList.remove('clear');
    body.classList.add('dark');
    logoHeader.src = '/src/assets/icons/logo-padrao.png';
    logoFooter.src = '/src/assets/icons/logo-padrao.png';
    temaIcon.src = '/src/assets/icons/sun.png';
  }
}


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
      window.location.href = '../../account/login.html?redirect=' + encodeURIComponent(window.location.pathname);
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
