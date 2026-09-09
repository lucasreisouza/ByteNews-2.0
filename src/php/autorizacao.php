<?php
function iniciarSessao(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function usuarioLogado(): bool
{
    return isset($_SESSION['id_usuario']);
}

function tipoUsuario(): string
{
    return $_SESSION['tipo_usuario'] ?? 'leitor';
}

function exigirLogin(string $redirect = ''): void
{
    iniciarSessao();
    if (!usuarioLogado()) {
        $destino = $redirect !== '' ? $redirect : ($_SERVER['REQUEST_URI'] ?? '/src/pages/painel.php');
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $srcPosicao = strpos($script, '/src/');
        $baseProjeto = $srcPosicao === false ? '' : substr($script, 0, $srcPosicao);
        header('Location: ' . $baseProjeto . '/src/pages/account/login.php?redirect=' . urlencode($destino));
        exit;
    }
}

function exigirTipo(array $tipos): void
{
    iniciarSessao();
    exigirLogin();
    if (!in_array(tipoUsuario(), $tipos, true)) {
        http_response_code(403);
        exit('Acesso não autorizado.');
    }
}

function podeGerenciarNoticias(): bool
{
    return usuarioLogado() && in_array(tipoUsuario(), ['admin', 'editor'], true);
}

function podeGerenciarModeradores(): bool
{
    return usuarioLogado() && tipoUsuario() === 'admin';
}