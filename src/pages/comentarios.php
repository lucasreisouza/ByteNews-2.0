<?php
require_once __DIR__ . '/../php/autorizacao.php';
require_once __DIR__ . '/../php/conexao.php';
exigirLogin();

$idUsuario = (int) $_SESSION['id_usuario'];
$stmt = $conexao->prepare('SELECT c.comentario, c.data_comentario, n.id_noticia, n.titulo, n.slug FROM comentarios c INNER JOIN noticias n ON n.id_noticia = c.id_noticia WHERE c.id_usuario = ? ORDER BY c.data_comentario DESC');
$stmt->bind_param('i', $idUsuario);
$stmt->execute();
$comentarios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meus comentários | ByteNews</title>
  <link rel="stylesheet" href="../assets/CSS/style.css">
  <link rel="icon" href="../assets/icons/icone.png">
</head>
<body class="dark">
<?php $headerBasePath = '../../'; require __DIR__ . '/../php/header.php'; ?>
<main class="page-shell comments-page">
  <section class="account-hero"><span class="eyebrow">MINHA PARTICIPAÇÃO</span><h1>Meus comentários.</h1><p>Acompanhe as conversas das notícias que você leu.</p></section>
  <section class="comments-history">
    <div class="results-heading"><h2>Histórico de comentários</h2><span><?= count($comentarios) ?> registrados</span></div>
    <?php if ($comentarios): foreach ($comentarios as $comentario): ?>
      <article class="history-item"><span class="history-mark">◌</span><div>
        <a href="./news/noticia.php?<?= $comentario['slug'] ? 'slug=' . urlencode($comentario['slug']) : 'id_noticia=' . (int) $comentario['id_noticia'] ?>"><?= htmlspecialchars($comentario['titulo']) ?></a>
        <p><?= nl2br(htmlspecialchars($comentario['comentario'])) ?></p><small><?= date('d/m/Y H:i', strtotime($comentario['data_comentario'])) ?></small>
      </div></article>
    <?php endforeach; else: ?>
      <div class="empty-state"><span>◌</span><p>Você ainda não fez comentários.</p><a class="text-link" href="./noticias.php">Ler notícias</a></div>
    <?php endif; ?>
  </section>
  <a class="back-home" href="./painel.php">← Voltar ao painel</a>
</main>
<?php require __DIR__ . '/../php/footer.php'; ?>
</body>
</html>
