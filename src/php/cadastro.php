<?php
session_start();
require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/account/cadastro.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';
$pergunta = trim($_POST['pergunta_seguranca'] ?? '');
$resposta = trim($_POST['resposta_seguranca'] ?? '');

if ($nome === '' || $email === '' || $senha === '' || $confirmarSenha === '' || $pergunta === '' || $resposta === '') {
    header('Location: ../pages/account/cadastro.php?erro=preencha');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../pages/account/cadastro.php?erro=email');
    exit;
}

if (strlen($senha) < 6) {
    header('Location: ../pages/account/cadastro.php?erro=senha');
    exit;
}

if ($senha !== $confirmarSenha) {
    header('Location: ../pages/account/cadastro.php?erro=confirmacao');
    exit;
}

$stmt = $conexao->prepare('SELECT id_usuario FROM usuarios WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    header('Location: ../pages/account/cadastro.php?erro=existente');
    exit;
}
$stmt->close();

$senha_segura = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha_segura, tipo_usuario, pergunta_seguranca, resposta_seguranca) VALUES (?, ?, ?, 'leitor', ?, ?)");
$stmt->bind_param('sssss', $nome, $email, $senha_segura, $pergunta, $resposta);

if (!$stmt->execute()) {
    header('Location: ../pages/account/cadastro.php?erro=banco');
    exit;
}

header('Location: ../pages/account/login.php?cadastro=ok');
exit;
