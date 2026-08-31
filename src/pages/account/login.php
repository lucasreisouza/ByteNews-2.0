<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="CSSheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Conta ByteNews</title>
    <link rel="stylesheet" href="../../assets/CSS/style.css">
    <link rel="icon" type="image/png" href="../../assets/icons/icone.png">
<body class="acount">
<form id="formUsuario">
    <img src="../../assets/icons/logo-padrao.png" alt="Logo ByteNews">
    <div class="container">
        <label for="email">email:</label>
        <input type="text" id="email" placeholder="Digite seu email">
        <label for="senha">senha:</label>
        <input type="password" id="senha" placeholder="Digite sua senha">
        <div class="botoes">
            <button type="submit">Entrar</button>
        </div>
        <p>Não tem conta?<a href="../account/cadastro.php">Cadastrar-se</a>
    </div>
</form>
<script src="../../assets/JS/script.js"></script>
<script>
document.getElementById("formUsuario").addEventListener("submit", function(event) {
    event.preventDefault();
    const email = document.getElementById("email").value.trim();
    const senha = document.getElementById("senha").value;
    const account = JSON.parse(localStorage.getItem("byteNewsAccount") || "null");

    if (!email || !senha) {
        alert("Preencha e-mail e senha.");
        return;
    }

    if (!account || account.email !== email || account.senha !== senha) {
        alert("E-mail ou senha incorretos.");
        return;
    }

    localStorage.setItem("byteNewsUser", JSON.stringify({
        name: account.nome,
        email: account.email,
        role: account.role || "leitor",
        loggedIn: true
    }));

    const params = new URLSearchParams(window.location.search);
    const redirect = params.get("redirect");
    window.location.href = redirect || "/index.php";
});
</script>
</body>
</html>