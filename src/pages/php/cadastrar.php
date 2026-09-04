<?php
// inclui o arquivo conexao
include('conexao.php');

// Capturando os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if (empty($nome) || empty($email) || empty($senha)) {
    die("Preencha todos os campos!");
}

// Criptografando a senha
$senha_segura = password_hash($senha,PASSWORD_DEFAULT);

// Criando o comando SQL
$sql = "INSERT INTO usuarios (nome, email, senha_segura) 
VALUES ('$nome', '$email', '$senha_segura)";

//Executando no banco de dados
$conexao->query($sql);
header("Location: ../pages/login.html");
exit();
?>