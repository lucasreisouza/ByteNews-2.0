<?php
    include('conexao.php');
    # Captura os dados do formulário de cadastro
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $pergunta = $_POST['pergunta_seguranca'];
    $resposta = $_POST['resposta_seguranca'];
    # Valida dados vazios 
    if(empty($nome) || empty($email) || empty($senha) || empty($pergunta) || empty($resposta)){
        echo "<p>Preencha todos os campos!</p>"; exit(); }
    # Aplica criptografia na senha
    $senha_segura = password_hash($senha, PASSWORD_DEFAULT);
    # Cria comando SQL de inserção usando Prepared Statements (Seguro)
    $stmt = $conexao->prepare("INSERT INTO usuarios(nome, email, senha_segura, pergunta_seguranca, resposta_seguranca) VALUES (?, ?, ?, ?, ?)");
    # "ssss" indica que os 4 parâmetros são strings
    $stmt->bind_param("sssss", $nome, $email, $senha_segura, $pergunta, $resposta);
    # Executa o comando
    if($stmt->execute()){
        # Redireciona o usuário para a página de login após o cadastro
        header("Location: ../pages/account/login.php");
} else { echo "Erro ao cadastrar: " . $conexao->error;}
$stmt->close();
$conexao->close();
?>