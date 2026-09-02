<?php
session_start();

include('../../php/conexao.php');

if (isset($_SESSION['id_usuario'])) {
    header("Location: ../../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta ByteNews</title>
    <link rel="stylesheet" href="../../assets/CSS/style.css">
    <link rel="icon" type="image/png" href="../../assets/icons/icone.png">
<body class="acount">
<form id="formUsuario" method="POST" action="../../php/cadastro.php">
    <img src="../../assets/icons/logo-padrao.png" alt="Logo ByteNews">
    <div class="container">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" placeholder="informe seu nome completo">
        <label for="e-mail">Informe seu e-mail:</label>
        <input type="text" id="e-mail" name="e-mail" placeholder="ex:@gmail">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="informe a senha">
        <label>Pergunta de Segurança:</label>
        <select name="pergunta_seguranca" required>
            <option value="">Selecione uma pergunta...</option>
            <option value="Qual é o nome do seu primeiro pet?">Qual é o nome do seu primeiro pet?</option>
            <option value="Qual é o nome da sua cidade natal?">Qual é o nome da sua cidade natal?</option>
            <option value="Qual o nome do seu filme favorito?">Qual o nome do seu filme favorito?</option>
        </select>
        <label>Resposta da Pergunta:</label>
        <input type="text" name="resposta_seguranca" required placeholder="Sua resposta secreta">
        <div class="botoes">
            <button type="submit">Cadastrar</button>
        </div>
        <p class="login">Ja tem uma conta?<a href="./login.php">Entrar</a></p>
    </div>
</form>
<script src="../../assets/JS/script.js"></script>
<script>
document.getElementById("formUsuario").addEventListener("submit", function(event) {
    event.preventDefault();
    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("e-mail").value.trim();
    const senha = document.getElementById("senha").value;
    const confirmar = document.getElementById("confirme-senha").value;

    if (!nome || !email || !senha || !confirmar) {
        alert("Preencha todos os campos.");
        return;
    }

    if (senha !== confirmar) {
        alert("As senhas não coincidem.");
        return;
    }

    localStorage.setItem("byteNewsAccount", JSON.stringify({
        nome: nome,
        email: email,
        senha: senha,
        role: "leitor"
    }));

    alert("Cadastro realizado! Agora faça login.");
    window.location.href = "./login.php";
});
</script>
</body>
</html>