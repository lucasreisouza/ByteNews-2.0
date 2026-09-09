<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    header('Location: ../../../index.php');
    exit;
}
$erro = $_GET['erro'] ?? '';
$redirect = $_GET['redirect'] ?? '';
$mensagem = $erro === 'preencha' ? 'Preencha e-mail e senha.' : ($erro === 'credenciais' ? 'E-mail ou senha incorretos.' : '');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Entrar | ByteNews</title>
    <link rel="stylesheet" href="../../assets/CSS/style.css">
    <link rel="icon" type="image/png" href="../../assets/icons/icone.png">
</head>
<body class="acount clear">
<?php $headerBasePath = '../../../'; require __DIR__ . '/../../php/header.php'; ?>
<main class="account-main">
<form id="formUsuario" method="POST" action="../../php/login.php">
    <img src="../../assets/icons/logo-padrao.png" alt="Logo ByteNews">
    <div class="container">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required autocomplete="email">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required autocomplete="current-password">
        <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect, ENT_QUOTES, 'UTF-8') ?>">
        <?php if ($mensagem): ?><p class="comment-error" style="display:block"><?= htmlspecialchars($mensagem) ?></p><?php endif; ?>
        <?php if (isset($_GET['cadastro'])): ?><p class="comment-login-message">Cadastro realizado! Agora faça login.</p><?php endif; ?>
        <div class="botoes"><button type="submit">Entrar</button></div>
        <p>Não tem conta? <a href="./cadastro.php">Cadastrar-se</a></p>
    </div>
</form>
</main>
<script src="../../assets/JS/script.js"></script>
</body>
</html>
