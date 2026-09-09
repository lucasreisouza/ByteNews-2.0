<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['logado' => false]);
    exit;
}

echo json_encode([
    'logado' => true,
    'id_usuario' => (int) $_SESSION['id_usuario'],
    'nome' => $_SESSION['nome'],
    'email' => $_SESSION['email'],
    'tipo_usuario' => $_SESSION['tipo_usuario'] ?? 'leitor'
]);
