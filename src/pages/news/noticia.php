<?php
require_once __DIR__ . '/../../php/conexao.php';

$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['slug'] ?? ''));
$idNoticia = (int) ($_GET['id_noticia'] ?? 0);

// As matérias legadas preservam o conteúdo editorial completo em suas páginas próprias.
// Notícias publicadas pelo painel continuam sendo exibidas nesta página dinâmica.
$arquivoLegado = $slug !== '' ? __DIR__ . '/' . $slug . '.php' : '';
if ($arquivoLegado !== '' && is_file($arquivoLegado) && basename($arquivoLegado) !== 'noticia.php') {
    header('Location: ' . rawurlencode($slug) . '.php', true, 302);
    exit;
}

if ($slug !== '') {
    $stmt = $conexao->prepare('SELECT id_noticia, titulo, subtitulo, conteudo, categoria, autor, fonte_nome, fonte_url, data_publicacao, imagem FROM noticias WHERE slug = ? LIMIT 1');
    $stmt->bind_param('s', $slug);
} else {
    $stmt = $conexao->prepare('SELECT id_noticia, titulo, subtitulo, conteudo, categoria, autor, fonte_nome, fonte_url, data_publicacao, imagem FROM noticias WHERE id_noticia = ? LIMIT 1');
    $stmt->bind_param('i', $idNoticia);
}
$stmt->execute();
$noticia = $stmt->get_result()->fetch_assoc();
if (!$noticia) {
    http_response_code(404);
    exit('Notícia não encontrada.');
}

// Compatibilidade com o banco atual, que pode ainda não ter os slugs preenchidos.
// A página legada é localizada pelo título; não há mapa fixo de IDs.
$normalizarTitulo = static function (string $titulo): string {
    $titulo = html_entity_decode(strip_tags($titulo), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return mb_strtolower(trim((string) preg_replace('/\s+/u', ' ', $titulo)), 'UTF-8');
};
$tituloNormalizado = $normalizarTitulo($noticia['titulo']);
foreach (glob(__DIR__ . '/*.php') ?: [] as $pagina) {
    if (basename($pagina) === 'noticia.php') {
        continue;
    }
    $html = file_get_contents($pagina);
    if ($html === false || !preg_match('/<h1[^>]*>(.*?)<\/h1>/si', $html, $tituloLegado)) {
        continue;
    }
    if ($normalizarTitulo($tituloLegado[1]) === $tituloNormalizado) {
        header('Location: ' . rawurlencode(basename($pagina)), true, 302);
        exit;
    }
}

$blocos = json_decode($noticia['conteudo'], true);
if (!is_array($blocos)) {
    $blocos = array_map(
        static fn (string $texto) => ['tipo' => 'paragrafo', 'conteudo' => $texto],
        array_filter(preg_split('/\R{2,}/', $noticia['conteudo']))
    );
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($noticia['titulo']) ?> | ByteNews</title>
  <link rel="stylesheet" href="../../assets/CSS/style.css">
  <link rel="icon" href="../../assets/icons/icone.png">
</head>
<body class="dark" data-news-id="<?= (int) $noticia['id_noticia'] ?>">
<?php $headerBasePath = '../../../'; require __DIR__ . '/../../php/header.php'; ?>
<main>
  <section class="news-article">
    <div class="news-title">
      <span class="news-card_category tecnologia"><?= htmlspecialchars($noticia['categoria']) ?></span>
      <h1><?= htmlspecialchars($noticia['titulo']) ?></h1>
      <?php if (!empty($noticia['subtitulo'])): ?><p><?= htmlspecialchars($noticia['subtitulo']) ?></p><?php endif; ?>
      <p>Por <?= htmlspecialchars($noticia['autor']) ?> | <?= date('d/m/Y H:i', strtotime($noticia['data_publicacao'])) ?></p>
      <?php if (!empty($noticia['fonte_nome']) && !empty($noticia['fonte_url'])): ?><p class="news-source">Fonte: <a href="<?= htmlspecialchars($noticia['fonte_url']) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($noticia['fonte_nome']) ?></a></p><?php endif; ?>
    </div>
    <figure class="news-image"><img src="../../assets/images/<?= htmlspecialchars(str_starts_with($noticia['imagem'], 'news-upload/') ? $noticia['imagem'] : basename($noticia['imagem'])) ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>"></figure>
    <article class="news-content">
      <?php foreach ($blocos as $bloco): $tipo = $bloco['tipo'] ?? 'paragrafo'; $conteudoBloco = (string) ($bloco['conteudo'] ?? ''); $texto = htmlspecialchars($conteudoBloco); ?>
        <?php if ($tipo === 'titulo'): ?><h2><?= $texto ?></h2>
        <?php elseif ($tipo === 'recuado'): ?><p class="news-paragraph-indented"><?= nl2br($texto) ?></p>
        <?php elseif (in_array($tipo, ['lista_ordenada', 'lista_nao_ordenada'], true)): $itens = array_filter(array_map('trim', preg_split('/\R+/', $conteudoBloco))); ?>
          <?php if ($tipo === 'lista_ordenada'): ?><ol><?php else: ?><ul><?php endif; ?>
            <?php foreach ($itens as $item): ?><li><?= htmlspecialchars($item) ?></li><?php endforeach; ?>
          <?php if ($tipo === 'lista_ordenada'): ?></ol><?php else: ?></ul><?php endif; ?>
        <?php else: ?><p><?= nl2br($texto) ?></p><?php endif; ?>
      <?php endforeach; ?>
    </article>
    <section class="news-comments" aria-labelledby="commentsTitle">
      <h2 id="commentsTitle" class="news-comments-title">Comentários</h2>
      <div id="commentsList" class="comments-list" aria-live="polite"></div>
      <form id="commentForm" class="comment-form">
        <label for="commentText">Seu comentário</label>
        <textarea id="commentText" name="comment" placeholder="Escreva seu comentário..."></textarea>
        <p id="commentError" class="comment-error" role="alert"></p>
        <p class="comment-login-message">Seu nome será exibido junto ao comentário.</p>
        <button id="commentButton" class="comment-button" type="submit">Comentar</button>
      </form>
    </section>
  </section>
</main>
<?php require __DIR__ . '/../../php/footer.php'; ?>
</body>
</html>
