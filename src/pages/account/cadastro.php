<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    header('Location: ../../../index.php');
    exit;
}
$erro = $_GET['erro'] ?? '';
$mensagens = [
    'preencha'=>'Preencha todos os campos.', 'email'=>'Informe um e-mail válido.',
    'senha'=>'A senha deve ter pelo menos 6 caracteres.', 'confirmacao'=>'As senhas informadas não conferem.',
    'existente'=>'Este e-mail já está cadastrado.', 'banco'=>'Não foi possível concluir o cadastro.'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta | ByteNews</title>
    <link rel="stylesheet" href="../../assets/CSS/style.css">
    <link rel="icon" type="image/png" href="../../assets/icons/icone.png">
</head>
<body class="acount clear">
<?php $headerBasePath = '../../../'; require __DIR__ . '/../../php/header.php'; ?>
<main class="account-main">
<form id="formUsuario" method="POST" action="../../php/cadastro.php">
    <img src="../../assets/icons/logo-padrao.png" alt="Logo ByteNews">
    <div class="container">
        <label for="nome">Nome completo:</label>
        <input type="text" id="nome" name="nome" placeholder="Informe seu nome completo" required autocomplete="name">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="seu@email.com" required autocomplete="email">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Mínimo de 6 caracteres" required minlength="6" autocomplete="new-password">
        <label for="confirmar_senha">Confirmar senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Repita a senha" required minlength="6" autocomplete="new-password">
        <label for="pergunta">Pergunta de segurança:</label>
        <select id="pergunta" name="pergunta_seguranca" required>
            <option value="">Selecione uma pergunta...</option>
            <option>Qual é o nome do seu primeiro pet?</option>
            <option>Qual é o nome da sua cidade natal?</option>
            <option>Qual o nome do seu filme favorito?</option>
        </select>
        <label for="resposta">Resposta:</label>
        <input type="text" id="resposta" name="resposta_seguranca" required placeholder="Sua resposta secreta">
        <?php if ($erro && isset($mensagens[$erro])): ?><p class="comment-error" style="display:block"><?= htmlspecialchars($mensagens[$erro]) ?></p><?php endif; ?>
        <div class="botoes"><button type="submit">Cadastrar</button></div>
        <p>Já tem uma conta? <a href="./login.php">Entrar</a></p>
    </div>
</form>
</main>
</body>
</html>
