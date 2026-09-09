<?php
session_start();
require_once __DIR__ . '/../php/conexao.php';

$busca = trim($_GET['busca'] ?? '');
$categoriaSelecionada = trim($_GET['categoria'] ?? '');
$categorias = $conexao->query('SELECT DISTINCT categoria FROM noticias ORDER BY categoria')->fetch_all(MYSQLI_ASSOC);
$sql = 'SELECT id_noticia, slug, titulo, subtitulo, categoria, autor, data_publicacao, imagem FROM noticias WHERE 1=1';
$tipos = '';
$parametros = [];
if ($busca !== '') {
    $sql .= ' AND (titulo LIKE ? OR subtitulo LIKE ?)';
    $termo = '%' . $busca . '%';
    $tipos .= 'ss';
    $parametros[] = $termo;
    $parametros[] = $termo;
}
if ($categoriaSelecionada !== '') {
    $sql .= ' AND categoria = ?';
    $tipos .= 's';
    $parametros[] = $categoriaSelecionada;
}
$sql .= ' ORDER BY data_publicacao DESC';
$stmtNoticias = $conexao->prepare($sql);
if ($parametros) {
    $stmtNoticias->bind_param($tipos, ...$parametros);
}
$stmtNoticias->execute();
$resultado = $stmtNoticias->get_result();
$slugs = [1=>'ameaca-ia',2=>'carro-voador',3=>'grecia-redes-sociais',4=>'gta-6',5=>'guerra-eua',6=>'hacker-reino-unido',7=>'hackers-ira',8=>'iphone-dobravel',9=>'meta-ia',10=>'modelo-ia',11=>'produto-apple',12=>'tratamento-ia',13=>'treinar-robos',14=>'vicio-redes-sociais',15=>'voz-clonada'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Notícias | ByteNews</title><link rel="stylesheet" href="../assets/CSS/style.css"><link rel="icon" href="../assets/icons/icone.png"></head>
<body class="dark">
<?php $headerBasePath = '../../'; require __DIR__ . '/../php/header.php'; ?>
<main class="page-shell news-page">
  <section class="news-hero"><div><span class="eyebrow">BYTE / NEWSROOM</span><h1>Notícias que<br><em>movem</em> a tecnologia.</h1><p>As histórias, ideias e mudanças que estão redesenhando o mundo digital.</p></div><div class="hero-signal"><span class="signal-dot"></span><span>ATUALIZAÇÃO<br>CONTÍNUA</span></div></section>
  <section class="news-toolbar"><form method="get" class="news-search"><span>⌕</span><input name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Buscar por título ou assunto"><button type="submit">Buscar</button></form><div class="category-filters"><a class="filter-chip <?= $categoriaSelecionada === '' ? 'is-active' : '' ?>" href="./noticias.php<?= $busca !== '' ? '?busca=' . urlencode($busca) : '' ?>">Todas</a><?php foreach ($categorias as $categoria): ?><a class="filter-chip <?= $categoriaSelecionada === $categoria['categoria'] ? 'is-active' : '' ?>" href="?categoria=<?= urlencode($categoria['categoria']) ?><?= $busca !== '' ? '&busca=' . urlencode($busca) : '' ?>"><?= htmlspecialchars($categoria['categoria']) ?></a><?php endforeach; ?></div></section>
  <section class="news-results"><div class="results-heading"><h2><?= $categoriaSelecionada !== '' ? htmlspecialchars($categoriaSelecionada) : 'Últimas histórias' ?></h2><span><?= $resultado->num_rows ?> <?= $resultado->num_rows === 1 ? 'matéria' : 'matérias' ?></span></div><div class="news-grid"><?php while ($n = $resultado->fetch_assoc()): $slug = $slugs[(int) $n['id_noticia']] ?? ''; ?><article id="noticia-<?= (int) $n['id_noticia'] ?>" class="news-tile"><a href="<?= $slug ? './news/' . htmlspecialchars($slug) . '.php' : '#noticia-' . (int) $n['id_noticia'] ?>"><figure><img src="../assets/images/<?= htmlspecialchars(basename($n['imagem'])) ?>" alt="<?= htmlspecialchars($n['titulo']) ?>"><span class="tile-category"><?= htmlspecialchars($n['categoria']) ?></span></figure><div class="tile-body"><span class="tile-date"><?= date('d.m.Y', strtotime($n['data_publicacao'])) ?></span><h3><?= htmlspecialchars($n['titulo']) ?></h3><p><?= htmlspecialchars($n['subtitulo'] ?? '') ?></p><span class="tile-author">Por <?= htmlspecialchars($n['autor']) ?> <b>↗</b></span></div></a></article><?php endwhile; ?></div><?php if ($resultado->num_rows === 0): ?><div class="empty-state"><span>⌕</span><p>Nenhuma notícia encontrada para essa busca.</p><a class="text-link" href="./noticias.php">Limpar filtros</a></div><?php endif; ?></section>
</main>
<script src="../assets/JS/script.js"></script>
<?php require __DIR__ . '/../php/footer.php'; ?>
</body></html>
