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
    <title>Meta finalmente apresenta plano para futuro da IA na empresa</title>
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
            <div class="news-title">
                <h1>Meta finalmente apresenta plano para futuro da IA na empresa</h1><!-- titulo da noticia-->
                <p>O lançamento mais importante da Meta em anos pode não ser seus novos óculos Ray-Ban ou seu aplicativo de IA. Em vez disso, pode ser o novo modelo de IA apresentado na quarta-feira (8), sinalizando como seus bilhões em investimentos no setor poderão, um dia, transformar seus produtos.</p>
                <p>Por <a href="https://www.cnnbrasil.com.br/autor/lisa-eadicicco/" target="_blank">Lisa Eadicicco</a>, da CNN | 10/04/26 às 12:07</p>
            </div>

            <!-- imagem -->
            <figure class="news-image">
                <img src="../../assets/images/meta-ai.png" alt="Meta IA">
            </figure><!-- imagem da noticia-->
       

            <!-- conteúdo -->
            <article class="news-content">
                <!-- noticia-->
                <p>O Muse Spark, o primeiro modelo de IA do laboratório de superinteligência da Meta, alimenta o aplicativo de IA da empresa e será integrado ao Instagram, WhatsApp, Facebook e aos óculos Ray-Ban Meta nas próximas semanas, informou a companhia em comunicado à imprensa.</p>
                <p>A Meta descreve o modelo como "feito sob medida" para seus produtos, projetado para agilizar tarefas como compras e planejamento de viagens — atividades que as pessoas já realizam no Instagram.</p>
                <p>O lançamento pareceu ser exatamente o que Wall Street queria ouvir, após a Meta injetar bilhões em suas ambições de IA com poucos detalhes sobre como esses valores impactariam seus lucros. As ações subiram mais de 9% logo após o anúncio e fecharam em alta de 6%.</p>

                <h2>Investimentos Pesados e Aquisições</h2>
                <p>Em junho passado, a Meta investiu US$ 14,3 bilhões (cerca de R$ 726.654.500) na startup de rotulagem de dados Scale AI e contratou seu ex-CEO, Alexandr Wang, como Diretor de IA (CAIO). A empresa também adquiriu as promissoras startups Manus e Moltbook. Sam Altman, CEO da OpenAI, afirmou no ano passado que Mark Zuckerberg chegou a oferecer bônus de contratação de US$ 100 milhões para atrair talentos da criadora do ChatGPT. Além disso, a controladora do Facebook gastou mais de US$ 72 bilhões (aproximadamente R$ 141.673.717) em despesas de capital (infraestrutura de IA) em 2025.</p>
                <p>Analistas e investidores querem saber como esses investimentos darão retorno. Em uma teleconferência de resultados em janeiro, Zuckerberg foi vago ao ser questionado sobre o retorno financeiro (ROI), admitindo que sua resposta poderia ser "um pouco insatisfatória". Ele acrescentou que a empresa está em um "período interessante de reconstrução do esforço de IA" e que está satisfeito com o progresso de seis meses.</p>

                <h2>A Estratégia do Muse Spark</h2>
                <p>O Muse Spark é a resposta mais clara da Meta até agora. A empresa delineou casos de uso semelhantes aos do ChatGPT e Gemini: como criar um jogo através de um comando de texto, responder a perguntas de saúde e analisar fotos de prateleiras de lanches para fornecer informações nutricionais.</p>
                <p>O lançamento sinaliza uma estratégia concreta para desafiar a OpenAI e o Google, após uma confusão inicial sobre a direção do aplicativo de IA da Meta. No passado, a Meta posicionou o app tanto como um destino para vídeos gerados por IA quanto como um centro para seus óculos inteligentes. Alguns usuários chegaram a postar perguntas públicas por acidente no ano passado acreditando serem privadas, indicando que o público não tinha certeza de como usar o produto.</p>
                <p>A Meta também deu pistas de como suas redes sociais podem dar vantagem ao seu app de IA sobre os rivais:</p>
                <p>O app Meta AI consultará conteúdos das redes sociais da empresa para responder sobre compras, tendências e localizações.</p>
                <p>Utilizará posts públicos para fornecer "contexto das suas pessoas, exatamente onde você precisa".</p>
                <p>Planeja incorporar Reels, fotos e publicações do Instagram diretamente nas respostas.</p>
                
                <h2>Um Cenário Competitivo</h2>
                <p>O momento é crítico, pois a Meta enfrenta concorrência crescente:</p>
                <p>OpenAI: Expansão agressiva para replicar o sucesso do ChatGPT em outras áreas da vida.</p>
                <p>Google: Previsão de lançamento de óculos com Android ainda este ano e novos anúncios de IA em sua conferência de desenvolvedores no próximo mês.</p>
                <p>Apple: A nova Siri deve ser lançada este ano após atrasos, focando em usar as preferências do usuário para personalizar respostas.</p>
                <p>A Meta precisa de uma vitória. O metaverso não revolucionou a internet como esperado. Os óculos inteligentes enfrentam preocupações de privacidade. E o surgimento do ChatGPT pegou a indústria — incluindo a Meta — de surpresa, forçando as gigantes de tecnologia a uma corrida de recuperação nos últimos três anos.</p>
                <p>Ainda não se sabe se os novos modelos de IA levarão os produtos da Meta a novos patamares, repetindo o sucesso dos primeiros dias do Facebook e Instagram. Mas o lançamento de um modelo feito especificamente para seus produtos sugere que a Meta está construindo uma visão clara.</p>
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