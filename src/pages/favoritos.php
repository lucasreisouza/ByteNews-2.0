<?php
require_once __DIR__ . '/../php/autorizacao.php';
require_once __DIR__ . '/../php/conexao.php';
exigirLogin();
$idUsuario = (int) $_SESSION['id_usuario'];
$stmt = $conexao->prepare('SELECT n.id_noticia, n.titulo, n.subtitulo, n.categoria, n.autor, n.data_publicacao, n.imagem FROM favoritos_noticias f INNER JOIN noticias n ON n.id_noticia = f.id_noticia WHERE f.id_usuario = ? ORDER BY f.data_favorito DESC');
$stmt->bind_param('i', $idUsuario);
$stmt->execute();
$favoritos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Minhas notícias | ByteNews</title><link rel="stylesheet" href="../assets/CSS/style.css"><link rel="icon" href="../assets/icons/icone.png"></head><body class="dark">
<?php $headerBasePath = '../../'; require __DIR__ . '/../php/header.php'; ?><main class="page-shell favorites-page"><section class="news-hero"><div><span class="eyebrow">SUA CURADORIA</span><h1>Minhas<br><em>notícias.</em></h1><p>As histórias que você guardou para voltar quando quiser.</p></div></section><section class="news-results"><div class="results-heading"><h2>Salvas para depois</h2><span><?= count($favoritos) ?> <?= count($favoritos) === 1 ? 'matéria' : 'matérias' ?></span></div><?php if ($favoritos): ?><div class="news-grid"><?php foreach ($favoritos as $noticia): ?><article class="news-tile favorite-tile"><a href="./noticias.php#noticia-<?= (int) $noticia['id_noticia'] ?>"><figure><img src="../assets/images/<?= htmlspecialchars(basename($noticia['imagem'])) ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>"><span class="tile-category"><?= htmlspecialchars($noticia['categoria']) ?></span></figure><div class="tile-body"><span class="tile-date"><?= date('d.m.Y', strtotime($noticia['data_publicacao'])) ?></span><h3><?= htmlspecialchars($noticia['titulo']) ?></h3><p><?= htmlspecialchars($noticia['subtitulo'] ?? '') ?></p><span class="tile-author">Por <?= htmlspecialchars($noticia['autor']) ?> <b>↗</b></span></div></a></article><?php endforeach; ?></div><?php else: ?><div class="empty-state"><span>☆</span><p>Sua coleção ainda está vazia.</p><a class="text-link" href="./noticias.php">Explorar notícias</a></div><?php endif; ?></section></main><?php require __DIR__ . '/../php/footer.php'; ?></body></html>
