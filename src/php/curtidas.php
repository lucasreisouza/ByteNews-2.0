<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
header('Content-Type: application/json; charset=utf-8');
iniciarSessao();
$idNoticia = (int) ($_GET['id_noticia'] ?? $_POST['id_noticia'] ?? 0);
if ($idNoticia < 1) { http_response_code(400); echo json_encode(['erro' => 'Notícia inválida.']); exit; }
$noticia = $conexao->prepare('SELECT id_noticia FROM noticias WHERE id_noticia = ?');
$noticia->bind_param('i', $idNoticia); $noticia->execute();
if (!$noticia->get_result()->fetch_assoc()) { http_response_code(404); echo json_encode(['erro' => 'Notícia não encontrada.']); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!usuarioLogado()) { http_response_code(401); echo json_encode(['erro' => 'Faça login para curtir.']); exit; }
    $idUsuario = (int) $_SESSION['id_usuario']; $acao = $_POST['acao'] ?? '';
    if ($acao === 'curtir') $stmt = $conexao->prepare('INSERT IGNORE INTO curtidas_noticias (id_usuario, id_noticia) VALUES (?, ?)');
    elseif ($acao === 'remover') $stmt = $conexao->prepare('DELETE FROM curtidas_noticias WHERE id_usuario = ? AND id_noticia = ?');
    else { http_response_code(400); echo json_encode(['erro' => 'Ação inválida.']); exit; }
    $stmt->bind_param('ii', $idUsuario, $idNoticia); $stmt->execute();
}
$curtidas = $conexao->prepare('SELECT COUNT(*) AS total FROM curtidas_noticias WHERE id_noticia = ?');
$curtidas->bind_param('i', $idNoticia); $curtidas->execute();
$total = (int) $curtidas->get_result()->fetch_assoc()['total']; $curtido = false;
if (usuarioLogado()) { $idUsuario = (int) $_SESSION['id_usuario']; $estado = $conexao->prepare('SELECT 1 FROM curtidas_noticias WHERE id_usuario = ? AND id_noticia = ?'); $estado->bind_param('ii', $idUsuario, $idNoticia); $estado->execute(); $curtido = (bool) $estado->get_result()->fetch_assoc(); }
echo json_encode(['ok' => true, 'curtidas' => $total, 'curtido' => $curtido], JSON_UNESCAPED_UNICODE);
