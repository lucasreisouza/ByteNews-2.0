<?php
require_once __DIR__ . '/autorizacao.php';
iniciarSessao();

$headerBasePath = $headerBasePath ?? '';
$isLoggedIn = isset($_SESSION['id_usuario']);
$accountUrl = $isLoggedIn
    ? $headerBasePath . 'src/pages/painel.php'
    : $headerBasePath . 'src/pages/account/login.php';
$secondaryUrl = $isLoggedIn
    ? $headerBasePath . 'src/php/logout.php'
    : $headerBasePath . 'src/pages/account/cadastro.php';
$canManageNews = podeGerenciarNoticias();
$hideHeaderTheme = ($hideHeaderTheme ?? false) || $isLoggedIn;
?>
<header id="nav">
    <div class="logo">
        <a href="<?= htmlspecialchars($headerBasePath) ?>index.php"><img id="logoHeader" src="<?= htmlspecialchars($headerBasePath) ?>src/assets/icons/logo-padrao.png" alt="ByteNews"></a>
    </div>
    <input type="checkbox" id="menu-toggle" hidden>
    <nav class="menu">
        <a href="<?= htmlspecialchars($headerBasePath) ?>index.php#Home">HOME</a>
        <a href="<?= htmlspecialchars($headerBasePath) ?>src/pages/noticias.php">NOTÍCIAS</a>
        <a href="<?= htmlspecialchars($canManageNews ? $headerBasePath . 'src/pages/cadastrar-noticia.php' : $headerBasePath . 'src/pages/contato.php') ?>"><?= $canManageNews ? 'CADASTRAR NOTÍCIA' : 'CONTATO' ?></a>
        <a id="login" href="<?= htmlspecialchars($accountUrl) ?>"><?= $isLoggedIn ? 'PAINEL' : 'ENTRAR' ?></a>
        <a id="account-secondary" href="<?= htmlspecialchars($secondaryUrl) ?>"><?= $isLoggedIn ? 'SAIR' : 'CADASTRAR' ?></a>
    </nav>
    <div class="button-menu">
        <?php if (!$hideHeaderTheme): ?><button type="button" id="tema" onclick="toggleStyle()"><img id="iconTema" src="<?= htmlspecialchars($headerBasePath) ?>src/assets/icons/sun.png" alt="Alternar tema"></button><?php endif; ?>
        <label for="menu-toggle" class="hamburger"><span></span><span></span><span></span></label>
    </div>
</header>
<script src="<?= htmlspecialchars($headerBasePath) ?>src/assets/JS/script.js"></script>
