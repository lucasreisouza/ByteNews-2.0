<?php
require_once __DIR__ . '/../php/autorizacao.php';
require_once __DIR__ . '/../php/conexao.php';

exigirLogin();

$nome = $_SESSION['nome'];
$tipo = tipoUsuario();
$idUsuario = (int) $_SESSION['id_usuario'];
$favoritos = [];
$totalComentarios = 0;
$totalNoticias = 0;

$stmtFavoritos = $conexao->prepare('SELECT n.id_noticia, n.titulo, n.categoria, n.data_publicacao FROM favoritos_noticias f INNER JOIN noticias n ON n.id_noticia = f.id_noticia WHERE f.id_usuario = ? ORDER BY f.data_favorito DESC');
if ($stmtFavoritos) {
  $stmtFavoritos->bind_param('i', $idUsuario);
  $stmtFavoritos->execute();
  $favoritos = $stmtFavoritos->get_result()->fetch_all(MYSQLI_ASSOC);
}

$stmtComentarios = $conexao->prepare('SELECT COUNT(*) total FROM comentarios WHERE id_usuario = ?');
if ($stmtComentarios) {
  $stmtComentarios->bind_param('i', $idUsuario);
  $stmtComentarios->execute();
  $totalComentarios = (int) $stmtComentarios->get_result()->fetch_assoc()['total'];
}

if (podeGerenciarNoticias()) {
  $resultadoNoticias = $conexao->query('SELECT COUNT(*) total FROM noticias');
  $totalNoticias = $resultadoNoticias ? (int) $resultadoNoticias->fetch_assoc()['total'] : 0;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu Painel | ByteNews</title>
  <link rel="stylesheet" href="../assets/CSS/style.css">
  <link rel="icon" type="image/png" href="../assets/icons/icone.png">
</head>

<body class="dark">

  <?php
  $headerBasePath = '../../';
  $hideHeaderTheme = true;
  require __DIR__ . '/../php/header.php';
  ?>

  <main class="dashboard-app">

    <aside class="dashboard-sidebar">
      <nav>
        <a class="sidebar-link active" href="./painel.php">
          <span>▣</span>Painel
        </a>
        <a class="sidebar-link" href="./perfil.php">
          <span>♙</span>Meu perfil
        </a>
        <a class="sidebar-link" href="./favoritos.php">
          <span>▤</span>Minhas notícias
        </a>
        <a class="sidebar-link" href="./comentarios.php">
          <span>◌</span>Meus comentários
        </a>

        <?php if (podeGerenciarNoticias()): ?>
          <a class="sidebar-link" href="./gerenciar-noticias.php">
            <span>✎</span>Gerenciar notícias
          </a>
          <a class="sidebar-link" href="./cadastrar-noticia.php">
            <span>＋</span>Adicionar notícia
          </a>
        <?php endif; ?>

        <?php if (podeGerenciarModeradores()): ?>
          <a class="sidebar-link" href="./gerenciar-moderadores.php">
            <span>⬡</span>Gerenciar acessos
          </a>
        <?php elseif ($tipo === 'leitor'): ?>
          <a class="sidebar-link" href="./solicitar-moderador.php">
            <span>↗</span>Solicitar acesso
          </a>
        <?php endif; ?>
      </nav>

      <a class="sidebar-link sidebar-logout" href="../php/logout.php">
        <span>⇥</span>Sair
      </a>
    </aside>

    <section class="dashboard-content">

      <section class="dashboard-welcome">
        <div class="welcome-avatar">
          <?= htmlspecialchars(strtoupper(substr($nome, 0, 1))) ?>
        </div>
        <div>
          <span class="eyebrow">PAINEL DO USUÁRIO</span>
          <h1>Olá, <?= htmlspecialchars($nome) ?>!</h1>
          <p>Bem-vindo de volta ao ByteNews.</p>
          <small>Aqui está um resumo da sua atividade no portal.</small>
        </div>
        <span class="dashboard-role"><?= htmlspecialchars(ucfirst($tipo)) ?></span>
        <button class="dashboard-theme-button" type="button" onclick="toggleStyle()">
          <img id="iconTemaPainel" src="../assets/icons/sun.png" alt="Alternar tema">
          <span>Alterar tema</span>
        </button>
      </section>

      <section class="dashboard-stats">
        <article>
          <span class="stat-icon cyan">▤</span>
          <div>
            <small><?= podeGerenciarNoticias() ? 'Total de notícias' : 'Notícias salvas' ?></small>
            <strong><?= podeGerenciarNoticias() ? $totalNoticias : count($favoritos) ?></strong>
            <em>↗ atividade recente</em>
          </div>
        </article>

        <article>
          <span class="stat-icon purple">☷</span>
          <div>
            <small>Comentários feitos</small>
            <strong><?= $totalComentarios ?></strong>
            <em>nesta conta</em>
          </div>
        </article>

        <article>
          <span class="stat-icon pink">☆</span>
          <div>
            <small>Seu cargo</small>
            <strong><?= htmlspecialchars(ucfirst($tipo)) ?></strong>
            <em>permissões atuais</em>
          </div>
        </article>
      </section>

      <section class="dashboard-columns">
        <article class="dashboard-panel" id="favoritos">
          <div class="panel-heading">
            <h2><?= podeGerenciarNoticias() ? 'Últimas notícias publicadas' : 'Artigos salvos' ?></h2>
            <a href="<?= podeGerenciarNoticias() ? './gerenciar-noticias.php' : './noticias.php' ?>">Ver todos →</a>
          </div>

          <?php if ($favoritos && !podeGerenciarNoticias()): ?>
            <div class="dashboard-list">
              <?php foreach ($favoritos as $favorito): ?>
                <a href="./noticias.php#noticia-<?= (int) $favorito['id_noticia'] ?>">
                  <span class="list-marker">▮</span>
                  <div>
                    <strong><?= htmlspecialchars($favorito['titulo']) ?></strong>
                    <small><?= htmlspecialchars($favorito['categoria']) ?></small>
                  </div>
                  <b>↗</b>
                </a>
              <?php endforeach; ?>
            </div>
          <?php elseif (podeGerenciarNoticias()): ?>
            <div class="dashboard-list">
              <a href="./gerenciar-noticias.php">
                <span class="list-marker">▣</span>
                <div>
                  <strong>Central editorial disponível</strong>
                  <small><?= $totalNoticias ?> notícias no catálogo</small>
                </div>
                <b>↗</b>
              </a>
              <a href="./cadastrar-noticia.php">
                <span class="list-marker">＋</span>
                <div>
                  <strong>Publicar uma nova notícia</strong>
                  <small>Adicionar conteúdo ao ByteNews</small>
                </div>
                <b>↗</b>
              </a>
            </div>
          <?php else: ?>
            <div class="dashboard-empty">
              Você ainda não salvou notícias.<br>
              <a href="./noticias.php">Explorar o catálogo →</a>
            </div>
          <?php endif; ?>
        </article>

        <article class="dashboard-panel" id="perfil">
          <div class="panel-heading">
            <h2>Atividade recente</h2>
            <span class="live-dot">● online</span>
          </div>
          <div class="activity-list">
            <div>
              <span class="activity-icon cyan">◎</span>
              <p>Você acessou o painel<strong>Agora</strong></p>
            </div>
            <div>
              <span class="activity-icon purple">☆</span>
              <p><?= count($favoritos) ?> notícias salvas<strong>Na sua coleção</strong></p>
            </div>
            <div>
              <span class="activity-icon pink">◌</span>
              <p><?= $totalComentarios ?> comentários realizados<strong>Na comunidade</strong></p>
            </div>
          </div>
        </article>
      </section>

      <section class="quick-actions">
        <div class="panel-heading">
          <h2>Ações rápidas</h2>
        </div>
        <div>
          <?php if (podeGerenciarNoticias()): ?>
            <a href="./cadastrar-noticia.php"><span>＋</span>Adicionar notícia</a>
            <a href="./gerenciar-noticias.php"><span>☷</span>Gerenciar notícias</a>
          <?php endif; ?>

          <?php if (podeGerenciarModeradores()): ?>
            <a href="./gerenciar-moderadores.php"><span>⬡</span>Gerenciar acessos</a>
          <?php elseif ($tipo === 'leitor'): ?>
            <a href="./solicitar-moderador.php"><span>↗</span>Solicitar moderador</a>
          <?php endif; ?>

          <a href="../../index.php"><span>⌂</span>Voltar ao início</a>
        </div>
      </section>

    </section>
  </main>

  <script src="../assets/JS/script.js"></script>
</body>
</html>