<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="description" content="ByteNews - Seu portal de tecnologia, games e inovações. As últimas notícias sobre IA, smartphones, games e hardware.">
    <meta property="og:title" content="ByteNews - Portal de Tecnologia e Games">
    <meta property="og:description" content="Fique por dentro das últimas notícias de tecnologia, IA e games.">
    <meta property="og:image" content="https://lucasreisouza.github.io/ByteNews-2.0/src/assets/icons/logo-padrao.png">
    <meta property="og:url" content="https://lucasreisouza.github.io/ByteNews-2.0/">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Meta revela primeiro modelo de IA da equipe de superinteligência</title>
    <link rel="icon" type="image/png" href="../../assets/icons/icone.png">
    <link rel="stylesheet" href="../../assets/CSS/style.css">
</head>

<body class="dark">
    <!-- Cabeçalho -->
    <header id="nav">
        <div class="logo">
            <a href="../../../index.php"><img id="logoHeader" src="../../assets/icons/logo-padrao.png" alt="ByteNews"></a>
        </div>

        <input type="checkbox" id="menu-toggle" hidden>

        <nav class="menu">
            <a href="#Home">INÍCIO</a>
            <a href="#Destaques">DESTAQUES</a>
            <a href="#Rodape">CONTATO</a>
            <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin'): ?>
                <a href="cadastrarNoticia.php" class="nav-link <?php echo ($pagina_atual === 'cadastrarNoticia.php') ? 'ativo' : ''; ?>">Cadastrar Noticia</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['id_usuario'])): ?>
                <a href="../painel.php" class="nav-link <?php echo ($pagina_atual === '../painel.php') ? 'ativo' : ''; ?>">MEU PERFIL</a>
                <a href="./src/php/logout.php" class="nav-link">SAIR</a>
            <?php else: ?>
                <a href="../account/login.php" class="nav-link <?php echo ($pagina_atual === '../account/login.php') ? 'ativo' : ''; ?>">ENTRAR</a>
                <a href="../account/cadastro.php" class="nav-link <?php echo ($pagina_atual === '../account/cadastro.php') ? 'ativo' : ''; ?>">CADASTRAR-SE</a>
            <?php endif; ?>
        </nav>

        <div class="button-menu">
            <button type="button" id="tema" onclick="toggleStyle()">
                <img id="iconTema" src="../../assets/icons/sun.png" alt="">
            </button>
            <div class="dropdown">
                <div class="dropdown-content"></div>
            </div>
            <label for="menu-toggle" class="hamburger"><span></span><span></span><span></span></label>
        </div>
    </header>



    <!-- Conteudo Principal -->
     <main>
        <section class="news-article">
            <div class="news-title">
                <h1>Meta revela primeiro modelo de IA da equipe de superinteligência</h1><!-- titulo da noticia-->
                <p>Muse Spark é o resultado de reestruturação interna e alta disputa por talentos</p>
                <p>Por <a href="https://www.cnnbrasil.com.br/autor/aditya-soni/" target="_blank">Aditya Soni</a> e <a href="https://www.cnnbrasil.com.br/autor/katie-paul/"> Katie Paul</a>, da Reuters | 08/04/26 às 14:55</p>
            </div>

            <!-- imagem -->
            <figure class="news-image">
                <img src="../../assets/images/modelo-ia.png" alt=" Modelo IA">
            </figure><!-- imagem da noticia-->


            <!-- conteúdo -->
            <article class="news-content">
                <!-- noticia-->
                <p>A Meta apresentou nesta quarta-feira (8) o Muse Spark, o primeiro modelo de inteligência artificial de uma equipe formada no ano passado após uma cara disputa por talentos e uma ampla reestruturação interna para alcançar os concorrentes na corrida da IA.</p>
                <p>As gigantes de tecnologia dos EUA estão sob pressão para provar que seus enormes investimentos em IA vão compensar. As apostas são especialmente altas para a Meta depois que a empresa contratou o CEO da Scale AI, Alex Wang, no ano passado, em um acordo de US$ 14,3 bilhões (cerca de R$ 73 bilhões), além de oferecer a alguns engenheiros pacotes de remuneração de centenas de milhões de dólares para montar uma nova equipe de superinteligência.</p>
                <p>O Muse Spark é o primeiro de uma nova série de modelos dessa equipe, que busca desenvolver máquinas capazes de superar o raciocínio humano.</p>
                <p>Inicialmente, ele estará disponível apenas no aplicativo Meta AI e no site, que ainda têm uso limitado, e nas próximas semanas substituirá os modelos Llama atualmente usados nos chatbots do WhatsApp, Instagram, Facebook e nos óculos inteligentes da Meta.</p>
                <p>“Este modelo inicial foi projetado para ser pequeno e rápido, mas ainda assim capaz de raciocinar sobre questões complexas em áreas como ciência, matemática e saúde. É uma base poderosa, e a próxima geração já está em desenvolvimento”, afirmou a empresa em uma publicação no blog.</p>
            </article>

            <!-- Comentários -->
            <section class="news-comments" aria-labelledby="commentsTitle">
                <h2 id="commentsTitle" class="news-comments-title">Vejam o que os usuários estão comentando</h2>

                <div id="commentsList" class="comments-list" aria-live="polite"></div>

                <form id="commentForm" class="comment-form">
                    <label for="commentText">Seu comentário</label>
                    <textarea id="commentText" name="comment" placeholder="Escreva seu comentário..."></textarea>
                    <p id="commentError" class="comment-error" role="alert"></p>
                    <p class="comment-login-message">Seu nome será exibido junto ao comentário.</p>
                    <button id="commentButton" class="comment-button" type="submit">Comentar</button>
                </form>
            </section>
        </section>  
    </main>


    <!-- rodapé -->
    <footer id="Rodape">
        <div class="box-footer">
            <div class="first-footer">
                <!-- logo do footer -->
                <div class="logo-footer">
                    <img id="logoFooter" src="../../assets/icons/logo-padrao.png" alt="Logo ByteNews">
                </div>
                <!-- frase do footer -->
                <div class="phrase">
                    <p>Seu portal de tecnologia, games e inovações</p>
                </div>
                <div class="social-media"><!-- redes sociais-->
                    <a href="#nav"><img src="../../assets/icons/instagram.png" alt="Instagram"></a>
                    <a href="#nav"><img src="../../assets/icons/whatsapp.png" alt="Whatsapp"></a>
                    <a href="#nav"><img src="../../assets/icons/facebook.png" alt="Facebook"></a>
                    <a href="#nav"><img src="../../assets/icons/tiktok.png" alt="Tiktok"></a>
                </div>
            </div>
            <!-- caixa de navegação -->
            <div class="navegacao-footer">
                <h2>Navegação</h2>
                <ul>
                    <li><a href="#nav">Sobre Nós</a></li>
                    <li><a href="#nav">Contato</a></li>
                    <li><a href="#nav">Anuncie</a></li>
                    <li><a href="#nav">Trabalhe Conosco</a></li>
                </ul>
            </div>
            <!-- caixa de categorias -->
            <div class="categories-footer">
                <h2>Categorias</h2>
                <ul>
                    <li><a href="#nav">Smartphones</a></li>
                    <li><a href="#nav">Games</a></li>
                    <li><a href="#nav">IA & Machine Learning</a></li>
                    <li><a href="#nav">Hardware</a></li>
                </ul>
            </div>
            <!-- caixa legal -->
            <div class="legal-footer">
                <h2>Legal</h2>
                <ul>
                    <li><a href="#nav">Política de Privacidade</a></li>
                    <li><a href="#nav">Termos de Uso</a></li>
                    <li><a href="#nav">Cookies</a></li>
                    <li><a href="#nav">LGPD</a></li>
                </ul>
            </div>
        </div>
        <!-- caixa do footer final -->
        <div class="end-footer">
            <p>&copy;2025 ByteNews • Todos os direitos reservados</p>
        </div>
    </footer>
<script src="../../assets/JS/script.js"></script>
</body>
</html>