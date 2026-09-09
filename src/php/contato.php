<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../pages/contato.php'); exit; }
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$assunto = trim($_POST['assunto'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');
if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $assunto === '' || $mensagem === '') { header('Location: ../pages/contato.php?erro=1'); exit; }
$linha = sprintf("[%s] %s <%s> | %s\n%s\n\n", date('Y-m-d H:i:s'), $nome, $email, $assunto, $mensagem);
file_put_contents(__DIR__ . '/../../contatos.txt', $linha, FILE_APPEND | LOCK_EX);
header('Location: ../pages/contato.php?enviado=1');
exit;
