<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
header('Content-Type: application/json; charset=utf-8');
iniciarSessao();
if (!usuarioLogado()) { http_response_code(401); echo json_encode(['erro' => 'Faça login para favoritar']); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['erro' => 'Método inválido']); exit; }
$idUsuario = (int) $_SESSION['id_usuario'];
$idNoticia = (int) ($_POST['id_noticia'] ?? 0);
$acao = $_POST['acao'] ?? 'adicionar';
if ($idNoticia < 1 || !in_array($acao, ['adicionar', 'remover'], true)) { http_response_code(400); echo json_encode(['erro' => 'Dados inválidos']); exit; }
if ($acao === 'adicionar') { $stmt = $conexao->prepare('INSERT IGNORE INTO favoritos_noticias (id_usuario, id_noticia) VALUES (?, ?)'); }
else { $stmt = $conexao->prepare('DELETE FROM favoritos_noticias WHERE id_usuario = ? AND id_noticia = ?'); }
$stmt->bind_param('ii', $idUsuario, $idNoticia);
$stmt->execute();
echo json_encode(['ok' => true, 'favorito' => $acao === 'adicionar']);
