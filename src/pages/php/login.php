<?php
include('conexao.php');
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '?'";

$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    die("E-mail não cadastrado!");
}

if (password_verify($senha, $usuario['senha_segura'])) {
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nome'] = $usuario['nome'];
    header("Location: ../../index.php");
    exit();
} else {
    die("Senha incorreta!");
}
?>