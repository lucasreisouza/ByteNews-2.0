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
    <title>OpenAI, dona do ChatGPT, vê ameaça da IA ao emprego e defende semana de 4 dias</title>
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
            <a href="#Ultimas">ÚLTIMAS NOTÍCIAS</a>
            <a href="#EmAlta">EM ALTA</a>
            <a href="#Rodape">CONTATO</a>
        </nav>

        <div class="button-menu">
            <button type="button" id="tema" onclick="toggleStyle()">
                <img id="iconTema" src="../../assets/icons/sun.png" alt="Trocar tema">
            </button>
            <a id="login" href="../../pages/account/login.php">ENTRAR</a>
            <label for="menu-toggle" class="hamburger"><span></span><span></span><span></span></label>
        </div>
    </header>


    <!-- Conteudo Principal -->
    <main>
        <section class="news-article">
            <!-- titulo -->
            <div class="news-title">
                <h1>OpenAI, dona do ChatGPT, vê ameaça da IA ao emprego e defende semana de 4 dias</h1>
                <p>Relatório da OpenAI discute impactos da IA no trabalho</p>
                <p>Por <a href="https://g1.globo.com/autores/redacao-g1/" target="_blank">Redação g1</a> | 11/04/2026 03h00</p>
            </div>

            <!-- imagem -->
            <figure class="news-image">
                <img src="../../assets/images/modelo-ia.png" alt="OpenAI IA">
            </figure>


            <!-- conteúdo -->
            <article class="news-content">
                <!-- noticia-->
                <p>Documento da OpenAI defende que a IA deve gerar ganhos sociais, como redução da jornada de trabalho sem corte salarial e participação dos trabalhadores nas decisões sobre o uso da tecnologia.</p>
                <p>Um relatório da OpenAI, dona do ChatGPT, propõe que o avanço da inteligência artificial não seja usado apenas para aumentar lucros, mas também para ampliar o bem-estar da população.</p>
                <p>O documento da bigtech, intitulado "Política Industrial para a Era da Inteligência", foi divulgado neste mês.</p>
                <p>Nele, a empresa afirma que, enquanto novas formas de trabalho surgirão, "alguns empregos desaparecerão" e indústrias inteiras serão remodeladas em uma velocidade sem precedentes históricos.</p>
                <p>Entre as propostas apresentadas, a OpenAI defende a redução da jornada de trabalho sem corte de salários. A sugestão é incentivar testes com semanas de quatro dias (32 horas), mantendo os níveis de produção e serviço.</p>
                <p>Segundo o relatório, o tempo economizado com a automação de tarefas poderia ser convertido em folgas ou em uma jornada menor.</p>
                <p>A empresa argumenta que a automação de atividades repetitivas e administrativas tende a liberar tempo, que deveria ser "devolvido" aos trabalhadores. O documento também sugere ampliar contribuições para aposentadoria e oferecer apoio para cuidados com filhos e idosos.</p>
                <p>Outro ponto destacado é a participação dos funcionários na adoção da IA nas empresas.</p>
                <p>A OpenAI diz que trabalhadores deveriam ter voz formal nesse processo, ajudando a definir como a tecnologia será usada, com foco na redução de tarefas perigosas ou exaustivas, e não apenas no aumento da produtividade ou da vigilância.</p>
                <p>O relatório também menciona a criação de um fundo para distribuir parte dos ganhos econômicos gerados pela IA à população, independentemente da renda.</p>
                <p>Por fim, a empresa afirma que a IA deve ser tratada como infraestrutura essencial, semelhante à eletricidade e à internet, e defende a oferta de versões acessíveis da tecnologia para pequenos negócios e comunidades de baixa renda.</p>
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