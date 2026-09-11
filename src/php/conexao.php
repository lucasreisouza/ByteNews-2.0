<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "sistemabytenews";
$porta = 3306;

$conexao = new mysqli($servidor, $usuario, $senha, $banco, $porta);

if ($conexao->connect_error) {
    http_response_code(500);
    die("Falha na conexão com o banco de dados.");
}

$conexao->set_charset("utf8mb4");