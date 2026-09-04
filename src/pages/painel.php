<?php
session_start();

// 1. LOGIC: SAIR DA CONTA (Logout)
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    // Redireciona para a página inicial (index.php) na raiz do projeto
    header("Location: ../../index.php");
    exit;
}

// 2. LOGIC: SALVAR ALTERAÇÕES DO PERFIL
$mensagem = '';
$tipo_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'salvar_perfil') {
    $novo_nome = trim($_POST['nome'] ?? '');
    $novo_email = trim($_POST['email'] ?? '');

    if (!empty($novo_nome) && !empty($novo_email)) {
        $_SESSION['usuario_nome'] = $novo_nome;
        $_SESSION['usuario_email'] = $novo_email;

        $mensagem = "Perfil atualizado com sucesso!";
        $tipo_mensagem = "sucesso";
    } else {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
        $tipo_mensagem = "erro";
    }
}

// Valores padrão do usuário
$nome = $_SESSION['usuario_nome'] ?? 'Usuário ByteNews';
$email = $_SESSION['usuario_email'] ?? 'usuario@bytenews.com';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - ByteNews</title>
    <link rel="icon" type="image/png" href="../assets/icons/icone.png">
    <link rel="stylesheet" href="../style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            /* Fundo */
            --bg-primary: rgb(0, 7, 24);
            --bg-secondary: rgb(14, 20, 32);
            --bg-card: rgb(0, 4, 29);
            --bg-body: rgb(1, 6, 38);

            /* Neon / Destaque */
            --neon-blue: rgb(0, 229, 255);
            --neon-purple: rgb(193, 126, 255);
            --neon-purple2: rgb(149, 35, 255);
            --neon-pink: rgb(255, 45, 154);
            --neon-green: rgb(0, 255, 156);
            --neon-red: rgb(247, 58, 0);

            --neon-blue-transp: rgba(0, 229, 255, 0.60);
            --neon-purple-transp: rgba(193, 126, 255, 0.77);
            --neon-purple2-transp: rgba(149, 35, 255, 0.80);
            --neon-pink-transp: rgba(255, 45, 154, 0.75);
            --neon-green-transp: rgba(0, 255, 157, 0.52);

            --neon-blue-rgb: 0, 229, 255;
            --neon-purple-rgb: 193, 126, 255;
            --neon-purple2-rgb: 149, 35, 255;
            --neon-pink-rgb: 255, 45, 154;
            --neon-green-rgb: 0, 255, 156;
            --neon-red-rgb: 247, 58, 0;

            /* Texto */
            --text-white: rgb(255, 255, 255);
            --text-primary: rgb(228, 228, 228);
            --text-secondary: rgb(156, 163, 175);
            --text-muted: rgb(107, 114, 128);

            /* Bordas / detalhes */
            --border-color: rgb(31, 41, 55);
            --glow-blue: rgba(0, 229, 255, 0.5);
            --glow-purple: rgba(168, 85, 247, 0.5);

            /* Botões */
            --btn-primary: rgb(0, 229, 255);
            --btn-hover: rgb(0, 196, 214);

            /* Tema Claro */
            --bg-clear-primary: #f5f7fb;
            --bg-clear-secondary: #ffffff;

            --text-clear-primary: #0f172a;
            --text-clear-secondary: #64748b;
            --text-clear-muted: #94a3b8;

            --neon-clear-blue: #3b82f6;
            --neon-clear-purple: #8b5cf6;

            --bg-clear-primary-rgb: 245, 247, 251;
            --neon-clear-purple-rgb: 139, 92, 246;

            --border-clear-color: #e5e7eb;

            /* Gradiente */
            --gradient-primary: linear-gradient(135deg, #00E5FF, #A855F7);
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-white);
            min-height: 100vh;
        }

        /* Header / Navbar Mantido Inalterado */
        header {
            backdrop-filter: blur(10px);
            background-color: var(--bg-primary);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0 0 20px 0;
            padding: 5px 15px;
            height: 60px;
            position: relative;
            border-bottom: 1px solid transparent;
            border-image: linear-gradient(90deg,
                    var(--neon-blue-transp),
                    var(--neon-purple-transp),
                    var(--neon-purple2-transp)) 1;
        }

        header #logoHeader {
            width: 200px;
        }

        header .menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        header .menu a {
            text-decoration: none;
            color: var(--text-primary);
            font-family: "Inter", sans-serif;
            font-weight: 600;
        }

        .menu a:hover {
            border-bottom: 2px solid var(--neon-blue);
            color: var(--neon-blue);
        }

        header .button-menu {
            display: flex;
            justify-content: space-around;
            width: 130px;
        }

        header .button-menu #tema {
            width: 40px;
            background: none;
            border: none;
        }

        header .button-menu #tema img {
            width: 25px;
        }

        header .button-menu #login {
            background: transparent;
            color: var(--btn-primary);
            border: 2px solid var(--btn-primary);
            border-radius: 8px;
            font-family: "Inter", sans-serif;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 5px;
            width: 75px;
            box-shadow: 0 0 10px #00f0ff50;
        }

        /* Novo Estilo do Painel alinhado ao site */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 30px;
        }

        .sidebar {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            height: fit-content;
        }

        .sidebar h3 {
            font-size: 13px;
            text-transform: uppercase;
            color: var(--neon-blue);
            margin-bottom: 20px;
            letter-spacing: 1.5px;
            font-weight: 700;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            display: block;
            padding: 12px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: var(--bg-secondary);
            color: var(--text-white);
            border-color: var(--neon-blue-transp);
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.15);
        }

        .sidebar a.logout {
            color: var(--neon-red);
            margin-top: 20px;
            border-top: 1px solid var(--border-color);
            border-radius: 0 0 8px 8px;
            padding-top: 16px;
        }

        .sidebar a.logout:hover {
            background-color: rgba(247, 58, 0, 0.1);
            border-color: rgba(247, 58, 0, 0.3);
            box-shadow: 0 0 15px rgba(247, 58, 0, 0.2);
        }

        .content-card {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 35px;
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        .content-card h2 {
            font-size: 26px;
            margin-bottom: 8px;
            color: var(--text-white);
            font-weight: 700;
        }

        .content-card p.subtitle {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .alert.sucesso {
            background-color: rgba(0, 255, 156, 0.1);
            border: 1px solid var(--neon-green);
            color: var(--neon-green);
            box-shadow: 0 0 10px rgba(0, 255, 156, 0.2);
        }

        .alert.erro {
            background-color: rgba(247, 58, 0, 0.1);
            border: 1px solid var(--neon-red);
            color: var(--neon-red);
            box-shadow: 0 0 10px rgba(247, 58, 0, 0.2);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-primary);
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-white);
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--neon-blue);
            box-shadow: 0 0 12px rgba(0, 229, 255, 0.3);
        }

        .btn-submit {
            background: var(--gradient-primary);
            color: var(--text-white);
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.2);
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 0 20px rgba(0, 229, 255, 0.4);
        }
    </style>
</head>
<body class="dark">
    <!-- Cabeçalho -->
    <header id="nav">
        <div class="logo">
            <a href="../../index.php"><img id="logoHeader" src="../assets/icons/logo-padrao.png" alt="ByteNews"></a>
        </div>

        <input type="checkbox" id="menu-toggle" hidden>

        <nav class="menu">
    
            <a href="../../index.php#Home" class="nav-link <?php echo ($pagina_atual === '../../index.php#Home') ? 'ativo' : ''; ?>">
                HOME
            </a>

            <a href="../../index.php#Destaques" class="nav-link <?php echo ($pagina_atual === '../../index.php#Destaques') ? 'ativo' : ''; ?>">
                DESTAQUES
            </a>

            <a href="../../index.php#Rodape" class="nav-link <?php echo ($pagina_atual === '../../index.php#Rodape') ? 'ativo' : ''; ?>">
                CONTATO
            </a>

            <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin'): ?>
                <a href="cadastrarNoticia.php" class="nav-link <?php echo ($pagina_atual === 'cadastrarNoticia.php') ? 'ativo' : ''; ?>">
                    CADASTRAR NOTÍCIA
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['id_usuario'])): ?>
                <a href="painel.php" class="nav-link <?php echo ($pagina_atual === 'painel.php') ? 'ativo' : ''; ?>">
                    MEU PERFIL
                </a>

                <a href="../../src/php/logout.php" class="nav-link <?php echo ($pagina_atual === 'logout.php') ? 'ativo' : ''; ?>">
                    SAIR
                </a>
            <?php else: ?>
                <a href="./account/login.php" class="nav-link <?php echo ($pagina_atual === 'login.php') ? 'ativo' : ''; ?>">
                    ENTRAR
                </a>

                <a href="./account/cadastro.php" class="nav-link <?php echo ($pagina_atual === 'cadastro.php') ? 'ativo' : ''; ?>">
                    CADASTRAR-SE
                </a>
            <?php endif; ?>

        </nav>

        <div class="button-menu">
            <button type="button" id="tema" onclick="toggleStyle()">
                <img id="iconTema" src="../assets/icons/sun.png" alt="">
            </button>
            <div class="dropdown">
                <div class="dropdown-content"></div>
            </div>
            <label for="menu-toggle" class="hamburger"><span></span><span></span><span></span></label>
        </div>
    </header>


    <!-- Estrutura do Painel -->
    <div class="container">
        
        <!-- Menu Lateral do Perfil -->
        <aside class="sidebar">
            <h3>Navegação</h3>
            <ul>
                <li><a href="painel.php?secao=perfil" class="active">Meu Perfil</a></li>
                <li><a href="painel.php?secao=salvos">Meus Comentários</a></li>
                <li><a href="painel.php?action=logout" class="logout">Sair da Conta</a></li>
            </ul>
        </aside>

        <!-- Formulário do Perfil -->
        <main class="content-card">
            <h2>Meu Perfil</h2>
            <p class="subtitle">Gerencie suas informações abaixo:</p>

            <?php if (!empty($mensagem)): ?>
                <div class="alert <?php echo $tipo_mensagem; ?>">
                    <?php echo htmlspecialchars($mensagem); ?>
                </div>
            <?php endif; ?>

            <form action="painel.php" method="POST">
                <input type="hidden" name="acao" value="salvar_perfil">

                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>

                <div class="form-group">
                    <label for="senha">Nova Senha (deixe em branco para não alterar)</label>
                    <input type="password" id="senha" name="senha" placeholder="••••••••">
                </div>

                <button type="submit" class="btn-submit">Salvar Alterações</button>
            </form>
        </main>

    </div>

</body>
</html>