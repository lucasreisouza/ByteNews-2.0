<?php
require_once __DIR__ . '/../php/autorizacao.php';
require_once __DIR__ . '/../php/conexao.php';
exigirTipo(['admin', 'editor']);
$noticias = $conexao->query('SELECT n.id_noticia, n.titulo, n.autor, n.data_publicacao, COUNT(DISTINCT c.id_comentario) comentarios, COUNT(DISTINCT l.id_usuario) curtidas FROM noticias n LEFT JOIN comentarios c ON c.id_noticia = n.id_noticia LEFT JOIN curtidas_noticias l ON l.id_noticia = n.id_noticia GROUP BY n.id_noticia ORDER BY n.data_publicacao DESC')->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Gerenciar notícias | ByteNews</title><link rel="stylesheet" href="../assets/CSS/style.css"><link rel="icon" href="../assets/icons/icone.png"></head>
<body class="dark">
<?php $headerBasePath = '../../'; require __DIR__ . '/../php/header.php'; ?>
<main class="page-shell news-manager">
  <section class="manager-hero"><div><span class="eyebrow">CENTRAL EDITORIAL</span><h1>Gerenciar notícias</h1><p>Selecione as publicações que deseja alterar ou excluir.</p></div><a class="primary-action" href="./cadastrar-noticia.php">＋ Nova notícia</a></section>
  <form method="post" action="../php/gerenciar-noticias.php" id="bulk-news-form">
    <section class="manager-list"><div class="manager-list-heading"><div><h2>Publicações</h2><span>Marque as notícias para editar ou excluir</span></div><label class="select-all-label"><input type="checkbox" id="select-all-news"> Selecionar todas</label></div>
      <?php foreach ($noticias as $noticia): ?><article class="manager-row"><label class="news-select"><input type="checkbox" name="ids[]" value="<?= (int) $noticia['id_noticia'] ?>"><span></span></label><div class="manager-title"><span class="manager-id">#<?= (int) $noticia['id_noticia'] ?></span><div><h3><?= htmlspecialchars($noticia['titulo']) ?></h3><span><?= htmlspecialchars($noticia['autor']) ?></span></div></div><div class="manager-metrics"><span>◌ <?= (int) $noticia['comentarios'] ?></span><span>♡ <?= (int) $noticia['curtidas'] ?></span></div><div class="manager-inline-fields"><label>Autor<input name="autor[<?= (int) $noticia['id_noticia'] ?>]" value="<?= htmlspecialchars($noticia['autor']) ?>"></label><label>Data<input type="datetime-local" name="data_publicacao[<?= (int) $noticia['id_noticia'] ?>]" value="<?= date('Y-m-d\\TH:i', strtotime($noticia['data_publicacao'])) ?>"></label></div></article><?php endforeach; ?>
</section>
<div class="bulk-actions"><span>As alterações serão aplicadas somente às notícias selecionadas.</span><div><button class="bulk-save" type="submit" name="acao" value="atualizar">Salvar alterações</button><button class="bulk-delete" type="button">Excluir selecionadas</button></div></div>
</form><a class="back-home" href="./painel.php">← Voltar ao painel</a>
</main>
<dialog id="delete-news-dialog" class="delete-dialog"><form method="post" action="../php/gerenciar-noticias.php"><h2>Excluir notícias selecionadas?</h2><p>Essa ação removerá permanentemente as publicações escolhidas e seus dados relacionados.</p><input type="hidden" name="acao" value="excluir"><div id="selected-news-inputs"></div><div class="dialog-actions"><button type="button" onclick="this.closest('dialog').close()">Cancelar</button><button class="bulk-delete" type="submit">Sim, excluir</button></div></form></dialog>
</body></html>
