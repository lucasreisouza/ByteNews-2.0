<?php
session_start();
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id_usuario, nome_completo, senha_segura, tipo_usuario FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        
        // Verifica se a senha bate com o hash salvo
        if (password_verify($senha, $usuario['senha_segura'])) {
            $_SESSION['id'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome_completo'];
            $_SESSION['tipo'] = $usuario['tipo_usuario'];
            
            echo "Login realizado com sucesso! Bem-vindo, " . $usuario['nome_completo'];
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "E-mail não encontrado!";
    }
}
?>