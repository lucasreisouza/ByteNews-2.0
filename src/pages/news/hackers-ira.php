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
    <title>Hackers ligados ao Irã invadem e-mail de diretor do FBI e vazam fotos e mensagens; o que se sabe</title>
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
     <main class="news-container">
        <section class="news-article">
            <div class="news-header">
                <h1>Hackers ligados ao Irã invadem e-mail de diretor do FBI e vazam fotos e mensagens; o que se sabe</h1><!-- titulo da noticia-->
                <p>O e-mail pessoal do diretor do FBI, Kash Patel, foi invadido por hackers ligados ao Irã nesta sexta-feira (27/3).</p>
                <p>Por <a href="https://www.bbc.com/portuguese/articles/czd7ldv289go" target="_blank">Grace Eliza Goodwine Author,Kwasi Gyamfi Asiedu</a> | 27 março 2026</p>
            </div>

            <!-- imagem -->
            <figure class="news-image">
                <img src="../../assets/images/hackers-ira.png" alt="Hackers ligados ao Irã">
            </figure><!-- imagem da noticia-->


            <!-- conteúdo -->
            <section class="news-content">
                <!-- noticia-->
                <p>O grupo, conhecido como Handala Hack Team, publicou em seu site o currículo de Patel e fotos dele, junto com a seguinte declaração: "Isso é só o começo."</p>
                <p>O FBI afirmou estar ciente da ação de "agentes maliciosos" tentando acessar informações do e-mail de Patel. "As informações em questão são antigas e não envolvem nenhum dado do governo".</p>
                <p>A agência está oferecendo até US$ 10 milhões (R$ 52 milhões) por informações que ajudem a identificar membros do grupo Handala.</p>
                <p>Hackers apoiados pelo Irã já haviam invadido comunicações privadas de Patel em 2024, semanas antes dele ser nomeado para liderar o FBI.</p>
                <p>Ainda não está claro se a invasão é diferente da reivindicada pelo grupo Handala nesta sexta-feira.</p>
                <p>As fotos que o Handala afirma ter retirado do e-mail de Patel têm circulado nas redes sociais, com a logo do grupo adicionado como marca d'água.</p>
                <p>As imagens mostram Patel em vários lugares não identificados, como ao lado de um conversível antigo, sorrindo perto de um jato, fumando e cheirando charutos, tirando uma selfie ao lado de uma garrafa de bebida alcoólica, e posando em restaurantes e hotéis.</p>
                <p>A BBC não verificou de forma independente as fotos vazadas.</p>
                <p>Cynthia Kaiser, vice-presidente sênior do Halcyon Ransomware Research Center, disse à BBC que as fotos e documentos compartilhados nesta sexta provavelmente são decorrentes de uma invasão antiga.</p>
                <p>"Os e-mails parecem muito antigos, o que me leva a crer que vem de uma invasão feita por outros grupos em outro período, e que está sendo reutilizado hoje", afirmou Kaiser, que já trabalhou na Divisão Criminal, Cibernética, de Resposta e Serviços do FBI.</p>
                <p>Em sua declaração anunciando o vazamento, o Handala afirmou:</p>
                <p>"Os chamados sistemas 'impenetráveis' do FBI foram derrubados em poucas horas pelo nosso grupo. Esta é a segurança que o governo dos EUA tanto se orgulha? Este é o gigante cibernético que acha que ameaças e subornos podem silenciar a voz da resistência?!"</p>
                <p>Especialistas afirmam que ataques a contas pessoais de altos funcionários do governo dos EUA podem não exigir grande sofisticação.</p>
                <p>"Contas pessoais não têm o mesmo nível de proteção e monitoramento que os sistemas governamentais, por isso costumam ser um alvo atraente para hackers", explicou Dave Schroeder, diretor de Iniciativas de Segurança Nacional da University of Wisconsin–Madison.</p>
                <p>"O Handala busca constantemente esse tipo de acesso porque é do interesse dele reivindicar ataques a pessoas e organizações de destaque", acrescentou.</p>
                <p>Na semana passada, o Departamento de Justiça dos EUA apreendeu vários domínios do Handala que, segundo a agência, estavam envolvidos em esquemas de hacking ligados ao Irã.</p>
                <p>O departamento afirmou que o Ministério de Inteligência e Segurança do Irã (MOIS) vinha usando os sites do Handala para "espalhar propaganda terrorista", realizar "tentativas de operações psicológicas contra adversários do regime", reivindicar crédito por atividades de hacking e convocar o assassinato de jornalistas e dissidentes.</p>
                <p>O domínio usado para realizar o ataque contra Patel foi registrado no mesmo dia em que o Departamento de Justiça anunciou a apreensão dos quatro domínios associados ao grupo, em 19 de março, conforme noticiado pela CBS News, parceira da BBC nos EUA.</p>
                <p>O Handala afirmou que o ataque à conta de e-mail de Patel foi uma retaliação pela apreensão de seus sites pelo FBI e pela oferta de recompensa de US$ 10 milhões por informações sobre ataques semelhantes.</p>
                <p>No início de março, o grupo Handala também assumiu a responsabilidade pelo ataque cibernético à empresa americana de tecnologia médica Stryker.</p>
                <p>Na ocasião, a página de login dos funcionários da empresa foi alterada com uma mensagem afirmando que os dados haviam sido apagados em um ataque do tipo "wiper" pelo grupo de hackers apoiado pelo Irã.</p>
                <p>Em uma publicação na sua conta no X, atualmente suspensa, o Handala afirmou ter apagado "mais de 200 mil sistemas, servidores e dispositivos móveis" e extraído "50 terabytes de dados críticos".</p>
                <p>O grupo disse que o ataque cibernético à Stryker foi "em retaliação ao brutal ataque" a uma escola de meninas iraniana no início da guerra, no qual mais de 160 pessoas foram mortas, e também "em resposta aos ataques cibernéticos contínuos contra a infraestrutura" do Irã e de seus aliados.</p>
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