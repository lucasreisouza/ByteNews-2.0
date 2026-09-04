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
    <title>Grécia proibirá redes sociais para menores de 15 anos a partir de 2027</title>
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
                <a href="../painel.php" class="nav-link <?php echo ($pagina_atual === '../painel.php') ? 'ativo' : ''; ?>">Meu Perfil</a>
                <a href="./src/php/logout.php" class="nav-link">Sair</a>
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
            <!--titulo  -->
            <div class="news-title">
                <h1>Grécia proibirá redes sociais para menores de 15 anos a partir de 2027</h1><!-- titulo da noticia-->
                <p>Medida busca reduzir impactos digitais entre jovens e pressionar União Europeia por regras similares</p>
                <p>Por <a href="https://www.cnnbrasil.com.br/autor/antonis-pothitos/" target="_blank">Antonis Pothitos</a> e <a href="https://www.cnnbrasil.com.br/autor/renee-maltezou/" target="_blank"> Renee Maltezou, da Reuters</a> | 08/04/26 às 23:02</p>
            </div>

            <!-- imagem -->
            <figure class="news-image">
                <img src="../../assets/images/grecias-redes-sociais.png" alt="Grecia proibirá redes sociais">
            </figure>


            <!-- conteúdo -->
            <article class="news-content">
                <!-- noticia-->
                <p>A Grécia proibirá o acesso às redes sociais para crianças menores de 15 anos a partir de 1º de janeiro de 2027, disse o primeiro-ministro Kyriákos Mitsotákis nesta quarta-feira (8), citando o aumento da ansiedade, problemas de sono e o design viciante das plataformas online.</p>
                <p>Uma pesquisa de opinião da Alco publicada em fevereiro mostrou que cerca de 80% dos entrevistados aprovavam a proibição. O governo grego já proibiu os telefones celulares nas escolas e criou plataformas de controle dos pais para limitar o tempo de tela dos adolescentes.</p>
                <p>"A Grécia estará entre os primeiros países a tomar essa iniciativa", disse Mitsotákis em uma mensagem de vídeo, acrescentando que conversou com os pais antes de tomar a decisão. "No entanto, tenho certeza de que não será o último. Nosso objetivo é pressionar a União Europeia nessa direção também."</p>
                <p>A Austrália se tornou o primeiro país do mundo a proibir rede social para menores de 16 anos em dezembro, bloqueando o acesso a plataformas como TikTok, YouTube, Instagram e Facebook.</p>
                <p>Meta, Snapchat e TikTok disseram que continuavam acreditando que a proibição da Austrália não protegeria os jovens, mas se comprometeram a cumprí-la.</p>
                <p>A Grécia ainda não pode forçar essas plataformas de mídia social a verificar a idade de seus usuários, mas recomenda que as plataformas usem os mecanismos que a UE e a Grécia já definiram, disse o governo, pedindo aos pais que também ajudem no esforço.</p>
                <p>A partir de 1º de janeiro de 2027, as plataformas precisarão ser capazes de restringir os usuários ou enfrentarão multas descritas na Lei de Serviços Digitais da UE (DSA), que podem chegar a 6% de seu faturamento global, disse o ministro da Governança Digital, Dimitris Papastergiou.</p>
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