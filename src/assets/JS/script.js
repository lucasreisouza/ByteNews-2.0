const body = document.querySelector('body');
const logoHeader = document.querySelector('#logoHeader');
const logoFooter = document.querySelector('#logoFooter');
const temaIcon = document.querySelector('#iconTema');

function getAssetPath(fileName) {
  const path = window.location.pathname;
  const root = path.includes('/src/') ? path.split('/src/')[0] : path.substring(0, path.lastIndexOf('/'));
  return root + '/src/assets/icons/' + fileName;
}

function setImagens(isClear) {
  const logoFile = isClear ? 'logo-claro.png' : 'logo-padrao.png';
  const iconFile = isClear ? 'moon.png' : 'sun.png';
  if (logoHeader) logoHeader.src = getAssetPath(logoFile);
  if (logoFooter) logoFooter.src = getAssetPath(logoFile);
  if (temaIcon) temaIcon.src = getAssetPath(iconFile);
  const painelTema = document.querySelector('#iconTemaPainel');
  if (painelTema) painelTema.src = getAssetPath(iconFile);
}

function toggleStyle() {
  const isDark = body.classList.contains('dark');
  body.classList.toggle('dark', !isDark);
  body.classList.toggle('clear', isDark);
  setImagens(isDark);
  localStorage.setItem('tema', isDark ? 'clear' : 'dark');
}

async function getSession() {
  try {
    const response = await fetch(getPhpPath('sessao.php'), { credentials: 'same-origin' });
    return await response.json();
  } catch {
    return { logado: false };
  }
}

function getPhpPath(file) {
  const path = window.location.pathname;
  const root = path.includes('/src/') ? path.split('/src/')[0] : path.substring(0, path.lastIndexOf('/'));
  return root + '/src/php/' + file;
}

function getLoginPath() {
  const path = window.location.pathname;
  const root = path.includes('/src/') ? path.split('/src/')[0] : path.substring(0, path.lastIndexOf('/'));
  return root + '/src/pages/account/login.php';
}

async function updateHeader() {
  const login = document.querySelector('#login');
  const secondaryAction = document.querySelector('#account-secondary');
  if (!login) return;
  const session = await getSession();
  // Remove um possível botão de logout antigo antes de atualizar o cabeçalho.
  const logoutExistente = document.querySelector('#logout');
  if (logoutExistente) logoutExistente.remove();

  if (session.logado) {
    login.textContent = 'PAINEL';
    login.href = getLoginPath().replace('/account/login.php', '/painel.php');
    login.removeAttribute('target');

    if (secondaryAction) {
      secondaryAction.textContent = 'SAIR';
      secondaryAction.href = getPhpPath('logout.php');
      secondaryAction.title = 'Encerrar sessão';
      secondaryAction.addEventListener('click', () => {
        localStorage.removeItem('byteNewsUser');
      }, { once: true });
      return;
    }

    // Botão separado para encerrar a sessão.
    const logout = document.createElement('a');
    logout.id = 'logout';
    logout.href = getPhpPath('logout.php');
    logout.textContent = 'SAIR';
    logout.title = 'Encerrar sessão';
    logout.addEventListener('click', () => {
      // Compatibilidade com versões antigas que usavam localStorage.
      localStorage.removeItem('byteNewsUser');
    });
    login.insertAdjacentElement('afterend', logout);
  } else {
    login.textContent = 'ENTRAR';
    login.href = getLoginPath();
    if (secondaryAction) {
      secondaryAction.textContent = 'CADASTRAR';
      secondaryAction.href = getLoginPath().replace('/login.php', '/cadastro.php');
      secondaryAction.removeAttribute('title');
    }
  }
}

function getNewsSlug() {
  const parts = window.location.pathname.split('/');
  const file = parts[parts.length - 1] || '';
  return file.replace(/\.php$/, '');
}

function registerNewsView() {
  if (!document.querySelector('.news-article')) return;
  const idNoticia = document.body.dataset.newsId || '';
  fetch(getPhpPath('registrar-visualizacao.php?slug=' + encodeURIComponent(getNewsSlug()) + '&id_noticia=' + encodeURIComponent(idNoticia)), {
    credentials: 'same-origin',
    keepalive: true
  }).catch(() => {});
}

function setupFavoriteButton() {
  const title = document.querySelector('.news-title');
  if (!title) return;
  const ids = { 'ameaca-ia': 1, 'carro-voador': 2, 'grecia-redes-sociais': 3, 'gta-6': 4, 'guerra-eua': 5, 'hacker-reino-unido': 6, 'hackers-ira': 7, 'iphone-dobravel': 8, 'meta-ia': 9, 'modelo-ia': 10, 'produto-apple': 11, 'tratamento-ia': 12, 'treinar-robos': 13, 'vicio-redes-sociais': 14, 'voz-clonada': 15 };
  const idNoticia = Number(document.body.dataset.newsId || ids[getNewsSlug()] || 0);
  if (!idNoticia) return;
  const button = document.createElement('button');
  button.type = 'button';
  button.className = 'favorite-button';
  button.textContent = '☆ Salvar nos favoritos';
  button.addEventListener('click', async () => {
    const formData = new FormData();
    formData.append('id_noticia', idNoticia);
    formData.append('acao', button.dataset.saved === 'true' ? 'remover' : 'adicionar');
    const response = await fetch(getPhpPath('favoritos.php'), { method: 'POST', body: formData, credentials: 'same-origin' });
    if (response.status === 401) { window.location.href = getLoginPath() + '?redirect=' + encodeURIComponent(window.location.pathname); return; }
    if (!response.ok) return;
    const data = await response.json();
    button.dataset.saved = data.favorito ? 'true' : 'false';
    button.textContent = data.favorito ? '★ Salvo nos favoritos' : '☆ Salvar nos favoritos';
  });
  title.appendChild(button);
}

function setupHomeNews() {
  const emphasis = document.querySelector('.news-emphasis_cards');
  if (!emphasis) return;
  fetch(getPhpPath('home-noticias.php'), { credentials: 'same-origin' }).then(response => response.json()).then(data => {
    const makeUrl = item => item.slug ? './src/pages/news/' + item.slug + '.php' : './src/pages/noticias.php#noticia-' + item.id_noticia;
    const makeImage = item => './src/assets/images/' + item.imagem;
    const updateCards = (selector, items, type) => {
      const cards = document.querySelectorAll(selector);
      items.forEach((item, index) => {
        const card = cards[index];
        if (!card) return;
        const link = card.querySelector('a');
        const image = card.querySelector('img');
        const title = card.querySelector('.news-card_title, .news-latest_content h2');
        const category = card.querySelector('.news-card_category');
        const time = card.querySelector('.news-card_time, .news-card_description p');
        if (link) link.href = makeUrl(item);
        if (image) { image.src = makeImage(item); image.alt = item.titulo; }
        if (title) title.textContent = item.titulo;
        if (category) { category.textContent = item.categoria; category.className = 'news-card_category ia'; }
        if (time) time.textContent = type === 'latest' ? new Date(item.data_publicacao.replace(' ', 'T')).toLocaleDateString('pt-BR') : type === 'hot' ? '↑ ' + Number(item.visualizacoes).toLocaleString('pt-BR') : '💬 ' + item.comentarios + ' comentários';
      });
    };
    updateCards('.news-emphasis_cards .news-card', data.destaques, 'featured');
    updateCards('.news-latest_cards article', data.ultimas, 'latest');
    const hotItems = document.querySelectorAll('.news-rise_item');
    data.alta.forEach((item, index) => { const row = hotItems[index]; if (!row) return; const link = row.querySelector('a'); const title = row.querySelector('.news-rise_title-text'); const stats = row.querySelector('.news-rise_trend'); if (link) link.href = makeUrl(item); if (title) title.textContent = item.titulo; if (stats) stats.textContent = '↑ ' + Number(item.visualizacoes).toLocaleString('pt-BR'); });
  }).catch(() => {});
}

function setupEditorialControls() {
  const paragraphs = document.querySelector('#paragraphs-container');
  const addBlockButton = document.querySelector('#add-block');
  const addBlock = () => {
      const field = document.createElement('textarea');
      field.name = 'blocos_conteudo[]';
      field.rows = 5;
      field.required = true;
      field.placeholder = 'Escreva o conteúdo do bloco...';
      const select = document.createElement('select');
      select.name = 'blocos_tipo[]';
      select.setAttribute('aria-label', 'Tipo do bloco');
      select.innerHTML = '<option value="paragrafo">Parágrafo</option><option value="recuado">Parágrafo recuado</option><option value="titulo">Título</option>';
      const block = document.createElement('div');
      block.className = 'content-block';
      block.append(select, field);
      paragraphs.appendChild(block);
      field.focus();
  };
  if (paragraphs && addBlockButton) addBlockButton.addEventListener('click', addBlock);
  const selectAll = document.querySelector('#select-all-news');
  if (selectAll) {
    selectAll.addEventListener('change', () => {
      document.querySelectorAll('input[name="ids[]"]').forEach(input => { input.checked = selectAll.checked; });
    });
  }
  const deleteButton = document.querySelector('.bulk-delete');
  const deleteDialog = document.querySelector('#delete-news-dialog');
  if (deleteButton && deleteDialog) {
    deleteButton.removeAttribute('onclick');
    deleteButton.addEventListener('click', event => {
      event.preventDefault();
      const selected = [...document.querySelectorAll('input[name="ids[]"]:checked')];
      if (!selected.length) return;
      const hiddenInputs = document.querySelector('#selected-news-inputs');
      hiddenInputs.innerHTML = '';
      selected.forEach(input => {
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'ids[]';
        hidden.value = input.value;
        hiddenInputs.appendChild(hidden);
      });
      deleteDialog.showModal();
    });
  }
}

async function renderComments() {
  const list = document.querySelector('#commentsList');
  if (!list) return;
  try {
    const idNoticia = document.body.dataset.newsId || '';
    const response = await fetch(getPhpPath('comentarios.php?noticia=' + encodeURIComponent(getNewsSlug()) + '&id_noticia=' + encodeURIComponent(idNoticia)), { credentials: 'same-origin' });
    const data = await response.json();
    list.innerHTML = '';
    if (!data.comentarios || data.comentarios.length === 0) {
      const empty = document.createElement('p');
      empty.className = 'comment-login-message';
      empty.textContent = 'Ainda não há comentários. Seja o primeiro a comentar!';
      list.appendChild(empty);
      return;
    }
    data.comentarios.forEach(comment => {
      const item = document.createElement('article');
      item.className = 'comment-item';
      const name = document.createElement('strong');
      name.textContent = comment.nome;
      const text = document.createElement('p');
      text.textContent = comment.comentario;
      item.append(name, text);
      list.appendChild(item);
    });
  } catch {
    list.innerHTML = '<p class="comment-login-message">Não foi possível carregar os comentários.</p>';
  }
}

async function setupComments() {
  const form = document.querySelector('#commentForm');
  const textarea = document.querySelector('#commentText');
  const button = document.querySelector('#commentButton');
  const error = document.querySelector('#commentError');
  if (!form || !textarea || !button) return;

  const session = await getSession();
  if (!session.logado) {
    button.textContent = 'Fazer login';
    button.type = 'button';
    button.onclick = () => {
      window.location.href = getLoginPath() + '?redirect=' + encodeURIComponent(window.location.pathname);
    };
    textarea.readOnly = true;
    textarea.placeholder = 'Faça login para escrever um comentário.';
  } else {
    button.textContent = 'Comentar';
    button.type = 'submit';
    textarea.readOnly = false;
    textarea.placeholder = 'Escreva seu comentário...';
    form.addEventListener('submit', async event => {
      event.preventDefault();
      const text = textarea.value.trim();
      if (!text) {
        error.textContent = 'Digite um comentário antes de enviar.';
        error.style.display = 'block';
        return;
      }
      error.style.display = 'none';
      const formData = new FormData();
      formData.append('noticia', getNewsSlug());
      if (document.body.dataset.newsId) formData.append('id_noticia', document.body.dataset.newsId);
      formData.append('comentario', text);
      try {
        const response = await fetch(getPhpPath('comentarios.php'), { method: 'POST', body: formData, credentials: 'same-origin' });
        const data = await response.json();
        if (!response.ok) throw new Error(data.erro || 'Erro ao salvar.');
        textarea.value = '';
        await renderComments();
      } catch (err) {
        error.textContent = err.message;
        error.style.display = 'block';
      }
    });
  }
  await renderComments();
}

document.addEventListener('DOMContentLoaded', () => {
  const temaSalvo = localStorage.getItem('tema');
  const clear = temaSalvo === 'clear';
  body.classList.toggle('dark', !clear);
  body.classList.toggle('clear', clear);
  setImagens(clear);
  registerNewsView();
  setupFavoriteButton();
  setupHomeNews();
  setupEditorialControls();
  setupComments();
});
