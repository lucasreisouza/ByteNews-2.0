<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
exigirTipo(['leitor']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/solicitar-moderador.php');
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];
$stmt = $conexao->prepare("SELECT id_solicitacao FROM solicitacoes_moderador WHERE id_usuario = ? AND status = 'pendente' LIMIT 1");
$stmt->bind_param('i', $idUsuario);
$stmt->execute();

if (!$stmt->get_result()->fetch_assoc()) {
    $insert = $conexao->prepare("INSERT INTO solicitacoes_moderador (id_usuario) VALUES (?)");
    $insert->bind_param('i', $idUsuario);
    $insert->execute();
}

header('Location: ../pages/solicitar-moderador.php');
exit;