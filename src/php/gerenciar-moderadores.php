<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
exigirTipo(['admin']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/gerenciar-moderadores.php');
    exit;
}

$idAdmin = (int) $_SESSION['id_usuario'];
$idSolicitacao = (int) ($_POST['id_solicitacao'] ?? 0);
$decisao = $_POST['decisao'] ?? '';
$idUsuario = (int) ($_POST['id_usuario'] ?? 0);
$novoTipo = $_POST['novo_tipo'] ?? '';

if ($idSolicitacao > 0 && in_array($decisao, ['aprovada', 'recusada'], true)) {
    $conexao->begin_transaction();
    $stmt = $conexao->prepare('SELECT id_usuario FROM solicitacoes_moderador WHERE id_solicitacao = ? AND status = "pendente" FOR UPDATE');
    $stmt->bind_param('i', $idSolicitacao);
    $stmt->execute();
    $solicitacao = $stmt->get_result()->fetch_assoc();
    if ($solicitacao) {
        $update = $conexao->prepare('UPDATE solicitacoes_moderador SET status = ?, data_decisao = NOW(), id_admin_decisor = ? WHERE id_solicitacao = ?');
        $update->bind_param('sii', $decisao, $idAdmin, $idSolicitacao);
        $update->execute();
        if ($decisao === 'aprovada') {
            $promover = $conexao->prepare("UPDATE usuarios SET tipo_usuario = 'editor' WHERE id_usuario = ? AND tipo_usuario = 'leitor'");
            $promover->bind_param('i', $solicitacao['id_usuario']);
            $promover->execute();
        }
    }
    $conexao->commit();
} elseif ($idUsuario > 0 && in_array($novoTipo, ['leitor', 'editor'], true) && $idUsuario !== $idAdmin) {
    $conexao->begin_transaction();

    if ($novoTipo === 'leitor') {
        $resetStatus = $conexao->prepare('UPDATE solicitacoes_moderador SET status = "recusada", data_decisao = NOW(), id_admin_decisor = ? WHERE id_usuario = ? AND status IN ("pendente", "aprovada", "recusada")');
        $resetStatus->bind_param('ii', $idAdmin, $idUsuario);
        $resetStatus->execute();
    }

    $stmt = $conexao->prepare("UPDATE usuarios SET tipo_usuario = ? WHERE id_usuario = ? AND tipo_usuario <> 'admin'");
    $stmt->bind_param('si', $novoTipo, $idUsuario);
    $stmt->execute();

    $conexao->commit();
}

header('Location: ../pages/gerenciar-moderadores.php');
exit;