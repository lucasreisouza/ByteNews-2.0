<?php
require_once __DIR__ . '/../php/autorizacao.php';
exigirTipo(['admin', 'editor']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cadastrar notícia | ByteNews</title><link rel="stylesheet" href="../assets/CSS/style.css"><link rel="icon" href="../assets/icons/icone.png"></head>
<body class="dark">
<?php $headerBasePath = '../../'; require __DIR__ . '/../php/header.php'; ?>
<main class="page-shell">
	<section class="editor-hero"><div><span class="eyebrow">CENTRAL EDITORIAL</span><h1>Publicar notícia</h1><p>Transforme uma pauta em uma matéria clara, relevante e pronta para o leitor ByteNews.</p></div><span class="role-chip"><?= htmlspecialchars(ucfirst($_SESSION['tipo_usuario'])) ?></span></section>
	<section class="editor-layout">
		<form class="editor-form" method="post" action="../php/cadastrar-noticia.php" enctype="multipart/form-data">
			<div class="form-section"><span class="section-kicker">01 / Identidade</span><h2>Como a notícia será apresentada</h2><label>Título<input name="titulo" required maxlength="255" placeholder="Um título direto e informativo"></label><label>Subtítulo<textarea name="subtitulo" rows="3" placeholder="Resuma o que o leitor precisa saber"></textarea></label></div>
			<div class="form-section"><span class="section-kicker">02 / Conteúdo</span><h2>Construa a matéria</h2><label>Blocos da notícia</label><div id="paragraphs-container"><div class="content-block"><select name="blocos_tipo[]" aria-label="Tipo do bloco"><option value="paragrafo">Parágrafo</option><option value="lista_ordenada">Lista ordenada</option><option value="lista_nao_ordenada">Lista normal</option><option value="titulo">Título</option></select><textarea name="blocos_conteudo[]" required rows="5" placeholder="Escreva o primeiro bloco da notícia..."></textarea></div></div><button class="add-block" type="button" id="add-block">+ Adicionar bloco</button><small>Para listas, escreva um item por linha.</small></div>
			<div class="form-section"><span class="section-kicker">03 / Classificação</span><h2>Organize a publicação</h2><div class="form-grid"><label>Categoria<input name="categoria" required maxlength="100" placeholder="Tecnologia"></label><label>Autor<input name="autor" required maxlength="100" value="<?= htmlspecialchars($_SESSION['nome']) ?>"></label></div><div class="form-grid"><label>Nome do site de origem<input name="fonte_nome" required maxlength="150" placeholder="Ex.: Tecnoblog"></label><label>URL da fonte<input type="url" name="fonte_url" required maxlength="2048" placeholder="https://site-origem.com/noticia"></label></div><label>Imagem da notícia<input type="file" name="imagem_upload" accept="image/jpeg,image/png,image/webp,image/gif" required><small>Formatos aceitos: JPG, PNG, WEBP ou GIF. Tamanho máximo: 5 MB.</small></label></div>
			<div class="form-actions"><a class="text-link" href="./painel.php">Voltar ao painel</a><button class="primary-action" type="submit">Publicar notícia <span>→</span></button></div>
		</form>
		<aside class="editor-aside"><span class="aside-mark">BN</span><h2>Antes de publicar</h2><ul><li>Prefira títulos objetivos e específicos.</li><li>Use o subtítulo para situar o leitor.</li><li>Revise nomes, datas e caminhos de imagem.</li></ul></aside>
	</section>
</main></body></html>
