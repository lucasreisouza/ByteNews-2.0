<?php
session_start();
require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/account/login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$redirect = trim($_POST['redirect'] ?? '');

if ($email === '' || $senha === '') {
    header('Location: ../pages/account/login.php?erro=preencha&redirect=' . urlencode($redirect));
    exit;
}

$stmt = $conexao->prepare('SELECT id_usuario, nome, email, senha_segura, tipo_usuario FROM usuarios WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario || !password_verify($senha, $usuario['senha_segura'])) {
    header('Location: ../pages/account/login.php?erro=credenciais&redirect=' . urlencode($redirect));
    exit;
}

session_regenerate_id(true);
$_SESSION['id_usuario'] = (int) $usuario['id_usuario'];
$_SESSION['nome'] = $usuario['nome'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

// Aceita somente caminhos internos para evitar redirecionamento externo.
if ($redirect !== '' && str_starts_with($redirect, '/')) {
    header('Location: ' . $redirect);
} else {
    header('Location: ../pages/painel.php');
}
exit;
