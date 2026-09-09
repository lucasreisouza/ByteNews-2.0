<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
exigirLogin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../pages/perfil.php'); exit; }
$idUsuario = (int) $_SESSION['id_usuario'];
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senhaAtual = $_POST['senha_atual'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';
$pergunta = trim($_POST['pergunta_seguranca'] ?? '');
$resposta = trim($_POST['resposta_seguranca'] ?? '');
if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $pergunta === '') { header('Location: ../pages/perfil.php?erro=validacao'); exit; }
$stmt = $conexao->prepare('SELECT senha_segura FROM usuarios WHERE id_usuario = ? LIMIT 1');
$stmt->bind_param('i', $idUsuario);
$stmt->execute();
$usuarioAtual = $stmt->get_result()->fetch_assoc();
if (!$usuarioAtual) { header('Location: ../pages/perfil.php?erro=banco'); exit; }
$stmt = $conexao->prepare('SELECT id_usuario FROM usuarios WHERE email = ? AND id_usuario <> ?');
$stmt->bind_param('si', $email, $idUsuario);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) { header('Location: ../pages/perfil.php?erro=email'); exit; }
if ($senha !== '') {
    if ($senhaAtual === '' || !password_verify($senhaAtual, $usuarioAtual['senha_segura'])) { header('Location: ../pages/perfil.php?erro=senha_atual'); exit; }
    if (strlen($senha) < 6) { header('Location: ../pages/perfil.php?erro=senha'); exit; }
    if ($senha !== $confirmarSenha) { header('Location: ../pages/perfil.php?erro=confirmacao'); exit; }
    $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);
    if ($resposta !== '') { $stmt = $conexao->prepare('UPDATE usuarios SET nome = ?, email = ?, senha_segura = ?, pergunta_seguranca = ?, resposta_seguranca = ? WHERE id_usuario = ?'); $stmt->bind_param('sssssi', $nome, $email, $senhaSegura, $pergunta, $resposta, $idUsuario); }
    else { $stmt = $conexao->prepare('UPDATE usuarios SET nome = ?, email = ?, senha_segura = ?, pergunta_seguranca = ? WHERE id_usuario = ?'); $stmt->bind_param('ssssi', $nome, $email, $senhaSegura, $pergunta, $idUsuario); }
} elseif ($resposta !== '') { $stmt = $conexao->prepare('UPDATE usuarios SET nome = ?, email = ?, pergunta_seguranca = ?, resposta_seguranca = ? WHERE id_usuario = ?'); $stmt->bind_param('ssssi', $nome, $email, $pergunta, $resposta, $idUsuario); }
else { $stmt = $conexao->prepare('UPDATE usuarios SET nome = ?, email = ?, pergunta_seguranca = ? WHERE id_usuario = ?'); $stmt->bind_param('sssi', $nome, $email, $pergunta, $idUsuario); }
if (!$stmt->execute()) { header('Location: ../pages/perfil.php?erro=banco'); exit; }
$_SESSION['nome'] = $nome;
$_SESSION['email'] = $email;
header('Location: ../pages/perfil.php?ok=1');
exit;
