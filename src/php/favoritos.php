<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
header('Content-Type: application/json; charset=utf-8');
iniciarSessao();

if (!usuarioLogado()) {
    http_response_code(401);
    echo json_encode(['erro' => 'Faça login para favoritar'], JSON_UNESCAPED_UNICODE);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['erro' => 'Método inválido'], JSON_UNESCAPED_UNICODE);
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];
$idNoticia = (int) ($_POST['id_noticia'] ?? 0);
$acao = $_POST['acao'] ?? 'adicionar';
if ($idNoticia < 1 || !in_array($acao, ['adicionar', 'remover'], true)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados inválidos'], JSON_UNESCAPED_UNICODE);
    exit;
}

$noticia = $conexao->prepare('SELECT 1 FROM noticias WHERE id_noticia = ? LIMIT 1');
$noticia->bind_param('i', $idNoticia);
$noticia->execute();
if (!$noticia->get_result()->fetch_assoc()) {
    http_response_code(404);
    echo json_encode(['erro' => 'Notícia não encontrada'], JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = $acao === 'adicionar'
    ? 'INSERT IGNORE INTO favoritos_noticias (id_usuario, id_noticia) VALUES (?, ?)'
    : 'DELETE FROM favoritos_noticias WHERE id_usuario = ? AND id_noticia = ?';
$stmt = $conexao->prepare($sql);
$stmt->bind_param('ii', $idUsuario, $idNoticia);
if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['erro' => 'Não foi possível atualizar os favoritos'], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode(['ok' => true, 'favorito' => $acao === 'adicionar'], JSON_UNESCAPED_UNICODE);
