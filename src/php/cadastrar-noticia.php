<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
exigirTipo(['admin', 'editor']);

function voltarComErro(string $erro): never { header('Location: ../pages/cadastrar-noticia.php?erro=' . urlencode($erro)); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { voltarComErro('metodo'); }

$titulo = trim($_POST['titulo'] ?? '');
$subtitulo = trim($_POST['subtitulo'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$autor = trim($_POST['autor'] ?? '');
$fonteNome = trim($_POST['fonte_nome'] ?? '');
$fonteUrl = trim($_POST['fonte_url'] ?? '');
$tipos = $_POST['blocos_tipo'] ?? [];
$blocos = $_POST['blocos_conteudo'] ?? [];
if ($titulo === '' || $categoria === '' || $autor === '' || $fonteNome === '' || $fonteUrl === '' || !is_array($tipos) || !is_array($blocos) || count($tipos) !== count($blocos) || count($blocos) === 0) { voltarComErro('campos'); }
if (mb_strlen($fonteNome) > 150 || !filter_var($fonteUrl, FILTER_VALIDATE_URL) || !in_array(parse_url($fonteUrl, PHP_URL_SCHEME), ['http', 'https'], true)) { voltarComErro('fonte'); }

$permitidos = ['paragrafo', 'lista_ordenada', 'lista_nao_ordenada', 'titulo'];
$conteudo = [];
foreach ($blocos as $indice => $bloco) {
    $tipo = $tipos[$indice] ?? '';
    $texto = trim((string) $bloco);
    if (!in_array($tipo, $permitidos, true) || $texto === '' || mb_strlen($texto) > 10000) { voltarComErro('conteudo'); }
    $conteudo[] = ['tipo' => $tipo, 'conteudo' => $texto];
}
if (!isset($_FILES['imagem_upload']) || $_FILES['imagem_upload']['error'] !== UPLOAD_ERR_OK || $_FILES['imagem_upload']['size'] > 5 * 1024 * 1024) { voltarComErro('imagem'); }
$arquivo = $_FILES['imagem_upload'];
$mime = (new finfo(FILEINFO_MIME_TYPE))->file($arquivo['tmp_name']);
$extensoes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
if (!isset($extensoes[$mime])) { voltarComErro('imagem'); }
$diretorio = dirname(__DIR__) . '/assets/images/news-upload';
if (!is_dir($diretorio) && !mkdir($diretorio, 0755, true)) { voltarComErro('upload'); }
$nomeImagem = bin2hex(random_bytes(16)) . '.' . $extensoes[$mime];
if (!move_uploaded_file($arquivo['tmp_name'], $diretorio . '/' . $nomeImagem)) { voltarComErro('upload'); }
$ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $titulo);
$baseSlug = trim((string) preg_replace('/-+/', '-', preg_replace('/[^a-z0-9]+/', '-', strtolower($ascii))), '-');
$slug = ($baseSlug !== '' ? $baseSlug : 'noticia') . '-' . bin2hex(random_bytes(4));
try {
    $conteudoJson = json_encode($conteudo, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    $imagem = 'news-upload/' . $nomeImagem;
    $stmt = $conexao->prepare('INSERT INTO noticias (titulo, subtitulo, conteudo, categoria, autor, fonte_nome, fonte_url, data_publicacao, imagem, slug) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)');
    if (!$stmt) { throw new RuntimeException('Não foi possível preparar a publicação.'); }
    $stmt->bind_param('sssssssss', $titulo, $subtitulo, $conteudoJson, $categoria, $autor, $fonteNome, $fonteUrl, $imagem, $slug);
    if (!$stmt->execute()) { throw new RuntimeException('Não foi possível salvar a publicação.'); }
} catch (Throwable) { @unlink($diretorio . '/' . $nomeImagem); voltarComErro('banco'); }
header('Location: ../pages/news/noticia.php?slug=' . urlencode($slug));
exit;
