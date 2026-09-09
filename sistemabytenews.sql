-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Set-2026 às 11:20
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemabytenews`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `data_comentario` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentario`, `id_usuario`, `id_noticia`, `data_comentario`, `status`) VALUES
(4, 'Excelente notícia!!!!', 3, 3, '2026-08-26 11:27:08', 'ativo'),
(8, 'Matéria excelente!!', 1, 1, '2026-08-28 11:24:10', 'ativo'),
(12, 'Gostei bastante', 7, 1, '2026-09-07 17:37:46', 'ativo'),
(13, 'Muito interessante como isso nos alerta sobre invasões', 7, 6, '2026-09-07 18:16:18', 'ativo'),
(14, 'Interessante como a tecnologia evoliui tanto!!', 7, 2, '2026-09-07 18:45:39', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas_comentarios`
--

CREATE TABLE `curtidas_comentarios` (
  `id_curtida` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `curtidas_comentarios`
--

INSERT INTO `curtidas_comentarios` (`id_curtida`, `id_comentario`, `id_usuario`) VALUES
(10, 4, 1),
(4, 4, 3),
(11, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas_noticias`
--

CREATE TABLE `curtidas_noticias` (
  `id_usuario` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `data_curtida` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_noticias`
--

CREATE TABLE `favoritos_noticias` (
  `id_usuario` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `data_favorito` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `favoritos_noticias`
--

INSERT INTO `favoritos_noticias` (`id_usuario`, `id_noticia`, `data_favorito`) VALUES
(7, 1, '2026-09-07 18:31:47'),
(7, 6, '2026-09-07 18:15:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `subtitulo` text DEFAULT NULL,
  `conteudo` longtext NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `data_publicacao` datetime NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `visualizacoes` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `titulo`, `subtitulo`, `conteudo`, `categoria`, `autor`, `data_publicacao`, `imagem`, `visualizacoes`, `slug`) VALUES
(1, 'OpenAI, dona do ChatGPT, vê ameaça da IA ao emprego e defende semana de 4 dias', 'Relatório da OpenAI discute impactos da IA no trabalho', 'Documento da OpenAI defende que a IA deve gerar ganhos sociais, como redução da jornada de trabalho sem corte salarial e participação dos trabalhadores nas decisões sobre o uso da tecnologia...', 'IA & Machine Learning', 'Gustavo', '2026-04-11 03:00:00', '../../assets/images/modelo-ia.png', 4, NULL),
(2, 'Protótipo de \'carro voador\' da Embraer completa 50 voos de teste', 'Versão de teste já soma mais de duas horas de voo desde dezembro, enquanto empresa prepara produção de unidades para certificação junto à Anac.', 'A Eve Air Mobility, empresa subsidiária da Embraer, informou nesta quinta-feira (9) que realizou 50 voos de teste com seu protótipo de \"carro voador\"...', 'Hardware', 'Luis', '2026-04-09 11:15:00', '../../assets/images/carro-voador.png', 5, NULL),
(3, 'Grécia proibirá redes sociais para menores de 15 anos a partir de 2027', 'Medida busca reduzir impactos digitais entre jovens e pressionar União Europeia por regras similares', 'A Grécia proibirá o acesso às redes sociais para crianças menores de 15 anos a partir de 1º de janeiro de 2027, disse o primeiro-ministro Kyriákos Mitsotákis...', 'Smartphones', 'Gustavo', '2026-04-08 23:02:00', '../../assets/images/grecias-redes-sociais.png', 3, NULL),
(4, 'GTA 6: lançamento, trailer e o que esperar do jogo', 'Saiba o que esperar de Grand Theft Auto VI (GTA 6), o jogo mais aguardado da última década', 'Grand Theft Auto VI, ou GTA 6, é um dos jogos mais aguardados dos últimos anos; afinal, já se passaram mais de 12 anos desde o lançamento de seu antecessor...', 'Games', 'Gustavo', '2025-12-01 05:00:00', '../../assets/images/gta-6.png', 3, NULL),
(5, '\'Project Maven\': como os EUA usam IA como tecnologia de guerra para lançar ataques letais em minutos', 'Pentágono afirma que ferramenta acelera a identificação de alvos e reduz o tempo entre a identificação de um alvo e a execução do ataque.', 'Os Estados Unidos têm recorrido a um aliado não convencional na campanha contra o Irã: a inteligência artificial. No centro dessa estratégia está o Project Maven...', 'IA & Machine Learning', 'Gustavo', '2026-04-07 00:01:00', '../../assets/images/guerra-eua.png', 0, NULL),
(6, 'Ataque hacker desvia pagamento e causa prejuízo milionário a empresa de energia no Reino Unido', 'Empresa faria pagamento para outra companhia, mas a invasão redirecionou cerca de R$ 4,7 milhões para um terceiro que não estava envolvido na negociação.', 'Uma empresa de energia no Reino Unido sofreu um prejuízo de 700 mil libras esterlinas (cerca de R$ 4,7 milhões) após um ataque hacker desviar o destino de um pagamento...', 'Hardware', 'Lucas', '2026-04-10 19:27:00', '../../assets/images/hackers-reino-unido.png', 5, NULL),
(7, 'Hackers ligados ao Irã invadem e-mail de diretor do FBI e vazam fotos e mensagens; o que se sabe', 'O e-mail pessoal do diretor do FBI, Kash Patel, foi invadido por hackers ligados ao Irã nesta sexta-feira (27/3).', 'O grupo, conhecido como Handala Hack Team, publicou em seu site o currículo de Patel e fotos dele, junto com a seguinte declaração: \"Isso é só o começo.\"', 'Hardware', 'Luis', '2026-03-27 00:00:00', '../../assets/images/hackers-ira.png', 0, NULL),
(8, 'iPhone dobrável enfrenta problemas de engenharia e lançamento pode atrasar, diz jornal', 'Modelo em teste enfrenta mais problemas do que o esperado, e lançamento previsto para 2026 pode atrasar, segundo o Nikkei Asia.', 'A Apple tem enfrentado problemas na fase de testes de engenharia de seu primeiro iPhone dobrável, o que pode atrasar em meses a produção em massa...', 'Smartphones', 'Lucas', '2026-04-07 11:19:00', '../../assets/images/iphone-dobravel.png', 1, NULL),
(9, 'Meta finalmente apresenta plano para futuro da IA na empresa', 'O lançamento mais importante da Meta em anos pode não ser seus novos óculos Ray-Ban ou seu aplicativo de IA. Em vez disso, pode ser o novo modelo de IA apresentado na quarta-feira (8), sinalizando como seus bilhões em investimentos no setor poderão, um dia, transformar seus produtos.', 'O Muse Spark, o primeiro modelo de IA do laboratório de superinteligência da Meta, alimenta o aplicativo de IA da empresa e será integrado ao Instagram, WhatsApp, Facebook e aos óculos Ray-Ban Meta nas próximas semanas, informou a companhia em comunicado à imprensa.\nA Meta descreve o modelo como \"feito sob medida\" para seus produtos, projetado para agilizar tarefas como compras e planejamento de viagens — atividades que as pessoas já realizam no Instagram.\nO lançamento pareceu ser exatamente o que Wall Street queria ouvir, após a Meta injetar bilhões em suas ambições de IA com poucos detalhes sobre como esses valores impactariam seus lucros. As ações subiram mais de 9% logo após o anúncio e fecharam em alta de 6%.\nInvestimentos Pesados e Aquisições\nEm junho passado, a Meta investiu US$ 14,3 bilhões (cerca de R$ 726.654.500) na startup de rotulagem de dados Scale AI e contratou seu ex-CEO, Alexandr Wang, como Diretor de IA (CAIO). A empresa também adquiriu as promissoras startups Manus e Moltbook. Sam Altman, CEO da OpenAI, afirmou no ano passado que Mark Zuckerberg chegou a oferecer bônus de contratação de US$ 100 milhões para atrair talentos da criadora do ChatGPT. Além disso, a controladora do Facebook gastou mais de US$ 72 bilhões (aproximadamente R$ 141.673.717) em despesas de capital (infraestrutura de IA) em 2025.\nAnalistas e investidores querem saber como esses investimentos darão retorno. Em uma teleconferência de resultados em janeiro, Zuckerberg foi vago ao ser questionado sobre o retorno financeiro (ROI), admitindo que sua resposta poderia ser \"um pouco insatisfatória\". Ele acrescentou que a empresa está em um \"período interessante de reconstrução do esforço de IA\" e que está satisfeito com o progresso de seis meses.\nA Estratégia do Muse Spark\nO Muse Spark é a resposta mais clara da Meta até agora. A empresa delineou casos de uso semelhantes aos do ChatGPT e Gemini: como criar um jogo através de um comando de texto, responder a perguntas de saúde e analisar fotos de prateleiras de lanches para fornecer informações nutricionais.\nO lançamento sinaliza uma estratégia concreta para desafiar a OpenAI e o Google, após uma confusão inicial sobre a direção do aplicativo de IA da Meta. No passado, a Meta posicionou o app tanto como um destino para vídeos gerados por IA quanto como um centro para seus óculos inteligentes. Alguns usuários chegaram a postar perguntas públicas por acidente no ano passado acreditando serem privadas, indicando que o público não tinha certeza de como usar o produto.\nA Meta também deu pistas de como suas redes sociais podem dar vantagem ao seu app de IA sobre os rivais:\nO app Meta AI consultará conteúdos das redes sociais da empresa para responder sobre compras, tendências e localizações.\nUtilizará posts públicos para fornecer \"contexto das suas pessoas, exatamente onde você precisa\".\nPlaneja incorporar Reels, fotos e publicações do Instagram diretamente nas respostas.\nUm Cenário Competitivo\nO momento é crítico, pois a Meta enfrenta concorrência crescente:\nOpenAI: Expansão agressiva para replicar o sucesso do ChatGPT em outras áreas da vida.\nGoogle: Previsão de lançamento de óculos com Android ainda este ano e novos anúncios de IA em sua conferência de desenvolvedores no próximo mês.\nApple: A nova Siri deve ser lançada este ano após atrasos, focando em usar as preferências do usuário para personalizar respostas.\nA Meta precisa de uma vitória. O metaverso não revolucionou a internet como esperado. Os óculos inteligentes enfrentam preocupações de privacidade. E o surgimento do ChatGPT pegou a indústria — incluindo a Meta — de surpresa, forçando as gigantes de tecnologia a uma corrida de recuperação nos últimos três anos.\nAinda não se sabe se os novos modelos de IA levarão os produtos da Meta a novos patamares, repetindo o sucesso dos primeiros dias do Facebook e Instagram. Mas o lançamento de um modelo feito especificamente para seus produtos sugere que a Meta está construindo uma visão clara.', 'Tecnologia', 'Gustavo', '2026-04-01 00:00:00', '../../assets/images/meta-ai.png', 0, NULL),
(10, 'Meta revela primeiro modelo de IA da equipe de superinteligência', 'Muse Spark é o resultado de reestruturação interna e alta disputa por talentos', 'A Meta apresentou nesta quarta-feira (8) o Muse Spark, o primeiro modelo de inteligência artificial de uma equipe formada no ano passado após uma cara disputa por talentos e uma ampla reestruturação interna para alcançar os concorrentes na corrida da IA.\nAs gigantes de tecnologia dos EUA estão sob pressão para provar que seus enormes investimentos em IA vão compensar. As apostas são especialmente altas para a Meta depois que a empresa contratou o CEO da Scale AI, Alex Wang, no ano passado, em um acordo de US$ 14,3 bilhões (cerca de R$ 73 bilhões), além de oferecer a alguns engenheiros pacotes de remuneração de centenas de milhões de dólares para montar uma nova equipe de superinteligência.\nO Muse Spark é o primeiro de uma nova série de modelos dessa equipe, que busca desenvolver máquinas capazes de superar o raciocínio humano.\nInicialmente, ele estará disponível apenas no aplicativo Meta AI e no site, que ainda têm uso limitado, e nas próximas semanas substituirá os modelos Llama atualmente usados nos chatbots do WhatsApp, Instagram, Facebook e nos óculos inteligentes da Meta.\n“Este modelo inicial foi projetado para ser pequeno e rápido, mas ainda assim capaz de raciocinar sobre questões complexas em áreas como ciência, matemática e saúde. É uma base poderosa, e a próxima geração já está em desenvolvimento”, afirmou a empresa em uma publicação no blog.', 'Tecnologia', 'Luis', '2026-04-01 00:00:00', '../../assets/images/modelo-ia.png', 0, NULL),
(11, 'Produto mais cobiçado da Apple pode te surpreender; veja qual', 'Entusiastas de tecnologia estão comprando o pequeno computador da empresa para executar agentes de inteligência artificial como o OpenClaw', 'A configuração do computador doméstico de Matt Shumer é um pouco mais estranha que a maioria.\nEle e seu colega de quarto têm cada um um mini computador Apple na cozinha, ambos os dispositivos trabalhando silenciosamente. Tudo o que Shumer precisa fazer é dar uma tarefa ao assistente virtual programado em seu Mac Mini, e ele cuida do resto. Isso inclui ações que normalmente exigiriam digitar, clicar e rolar, como navegar em sites e fazer login em contas.\nPode ser estranho para seus amigos fora da área de tecnologia, mas para \"hobbistas\" como ele, a atividade é comum.\nShumer, um investidor em IA e autor de um ensaio viral sobre IA e empregos em fevereiro, é um dos muitos entusiastas de tecnologia que recentemente compraram um Mac mini para executar o comentado agente de IA OpenClaw.\nOs entusiastas de IA têm adquirido o pequeno desktop prateado da Apple porque ele tem todos os ingredientes certos para executar agentes de IA: um design conveniente, poder de processamento e um preço relativamente acessível em um momento em que os preços de memória estão aumentando.\nA Apple se recusou a comentar para esta matéria, mas analistas disseram à CNN que os envios de Mac cresceram no ano passado.\nO Mac Mini se tornou um símbolo de status entre os experimentadores de IA, e alguns analistas dizem que a crescente popularidade do dispositivo pode prenunciar uma mudança mais ampla na forma como as pessoas usam computadores.\n\"Acreditamos que estamos em uma fase altamente transformadora para a indústria de PCs\", disse Linn Huang, analista da International Data Corporation que acompanha o mercado de PCs.\nUma \"máquina OpenClaw\"\nO Mac mini em formato de disco da Apple, essencialmente uma versão minúscula de uma torre de computador que deve ser conectada a um teclado e monitor externos, existe há anos. A versão mais recente foi lançada em 2024.\nMas o entusiasmo com o OpenClaw, um agente de IA autônomo que pode operar o dispositivo de um usuário para realizar tarefas, transformou o pequeno desktop da Apple em um produto muito procurado nos últimos meses.\nAs estimativas de envio para certas configurações do Mac mini são de até 12 semanas, com a data mais próxima para retirada em uma Apple Store na cidade de Nova York em meados de julho.\nShumer disse que um funcionário da Apple Store chegou a se referir ao Mac mini como uma \"máquina OpenClaw\" quando ele visitou recentemente uma loja em Nova York.\nÉ difícil dizer se o OpenClaw impulsionou os resultados financeiros da Apple, já que a gigante da tecnologia não discrimina as vendas por produto individual e o OpenClaw só foi lançado em novembro.\nAinda assim, a empresa de pesquisa de mercado de tecnologia Omdia estimou que os envios do Mac mini cresceram em dois dígitos em 2025 em comparação com 2024.\nKieren Jessop, gerente de pesquisa da Omdia, descreveu a popularidade do Mac Mini nos círculos tecnológicos como \"real\" e \"duradoura\" em um e-mail para a CNN.\nHuang também disse que as vendas de desktops Mac da Apple cresceram mais do que as vendas de laptops em 2025.\nPor que o Mac Mini está recebendo tanto amor agora?\nUm Mac mini não é obrigatório para o OpenClaw, mas existem algumas razões pelas quais muitos o preferem.\nExecutar modelos de IA em um computador ai invés de na nuvem geralmente é mais particular, já que as informações não precisam sair do dispositivo. Usar um computador separado para o OpenClaw também é mais seguro, já que os usuários podem optar por pré-carregar o dispositivo apenas com as informações que desejam que o agente tenha acesso.\nComeçando em 599 dólares, o valor também é relativamente acessível em um momento em que os preços de memória estão disparando.\nO design do Mac Mini também atrai alguns usuários do OpenClaw. O agente de IA pode realizar tarefas de forma autônoma sem perguntas ou comandos constantes, então não precisa de um computador com uma tela e teclado acoplados como um laptop.\nA maioria das pessoas conecta seu agente OpenClaw a serviços que podem acessar de seus telefones, como um aplicativo de mensagens.\nRoy Derks, gerente de produto principal na IBM, tem o OpenClaw configurado em seu Mac Mini doméstico e se comunica com ele através de um aplicativo como WhatsApp ou Telegram.\nEle usa principalmente o agente de IA para pesquisar coisas relacionadas à sua vida pessoal enquanto está no escritório, como brinquedos para seu filho.\n\"Está rodando em segundo plano, fazendo coisas que eu não estou fazendo no trabalho\", disse ele.\nO desenvolvedor de aplicativos Clément Sauvage disse à CNN que tem três Mac minis executando o OpenClaw: um para gerenciar operações pessoais, como seus e-mails e lista de tarefas; outro para desenvolvimento e projetos; e um terceiro que atua como um \"cérebro central\" para coordenar tarefas entre as máquinas.\nUm símbolo de status\nO fervor em torno do OpenClaw se transformou em uma comunidade global de desenvolvedores e entusiastas de tecnologia. Conferências do OpenClaw estão surgindo em todo o mundo. Derks participou de uma em São Francisco, onde ele disse que as pessoas ainda estavam na fila para entrar mesmo duas horas após o início do evento.\nEnquanto a lagosta se tornou o mascote principal do agente, o Mac Mini se tornou um símbolo por si só.\nNo Etsy, você encontrará suportes para Mac Mini em forma de garra de lagosta. Sauvage criou um conjunto de pins colecionáveis para a próxima Conferência Mundial de Desenvolvedores da Apple; um mostra uma lagosta empoleirada em cima de um Mac Mini.\nO interesse no Mac Mini pode parecer de nicho hoje. Mas é parte do que alguns analistas veem como uma tendência mais ampla em torno do papel dos computadores no mundo da IA. É exatamente o público que a fabricante de chips Nvidia está mirando com seu computador DGX Spark, embora esse dispositivo seja muito mais caro e tenha mais poder computacional.\nO CEO da Nvidia, Jensen Huang, destacou a capacidade dos modelos de IA executados no DGX Spark de controlar um robô doméstico durante sua apresentação na conferência de tecnologia CES em janeiro. O OpenClaw também foi uma área importante de foco durante a conferência GTC da Nvidia em março.\n\"Ainda estamos na fase de inovadores dessa tendência, mas a trajetória é clara\", disse Jessop por e-mail.\nShumer gosta de ter uma representação física de seu assistente pessoal de IA em sua casa. \"Isso muda a forma como você pensa sobre ele, a maneira como você o usa, as tarefas que você dá a ele\", disse ele.', 'Tecnologia', 'Gustavo', '2026-04-01 00:00:00', '../../assets/images/produto-apple.png', 2, NULL),
(12, 'As doenças antes incuráveis que estão ganhando tratamentos graças à IA', 'Há cerca de um século, a humanidade vem perdendo lentamente a batalha contra as bactérias.', 'Nossas armas mais poderosas nesta luta são os antibióticos. Mas a resistência vem se espalhando, fazendo com que eles se tornem cada vez menos eficazes.\nAtualmente, cerca de 1,1 milhão de pessoas morrem todos os anos de infecções que, até recentemente, eram facilmente tratadas. E este número deve aumentar para mais de oito milhões até 2050, a menos que sejam tomadas medidas urgentes.\nMas o desenvolvimento de novos antibióticos é um processo lento, caro e frustrante.\nEntre 2017 e 2022, apenas 12 novos antibióticos foram aprovados para uso. A maioria deles é similar a tipos já existentes, aos quais as bactérias já estão desenvolvendo resistência.\nA falta de financiamento e de interesse das companhias farmacêuticas fez com que este campo fosse cronicamente negligenciado.\nMas, agora, os pesquisadores estão tentando solucionar este problema. E alguns deles apostam na inteligência artificial (IA) para ajudá-los.\n\"Em questão de dias ou horas, podemos examinar imensas bibliotecas\" de compostos químicos para identificar quais exibem atividade antibacteriana\", afirma o professor de ciências e engenharia médica James Collins, do Instituto de Tecnologia de Massachusetts (MIT, na sigla em inglês) na cidade de Cambridge, nos Estados Unidos.\nCom a ajuda da IA, Collins e sua equipe já descobriram dois novos compostos que poderão se tornar armas vitais contra a gonorreia e a Staphylococcus aureus resistente à meticilina (SARM), duas infecções altamente resistentes aos medicamentos atuais.\nEste é apenas um exemplo de como a IA vem abrindo uma nova era de descoberta de medicamentos, que promete trazer progressos em relação a alguns dos problemas médicos de mais difícil tratamento dos tempos atuais.\nOs cientistas, agora, empregam a IA para examinar condições sem cura conhecida, como Parkinson, e milhares de doenças raras, na esperança de novas descobertas.\nCollins e sua equipe treinaram um modelo de IA generativa para reconhecer as estruturas químicas de antibióticos conhecidos. Isso permitiu que o algoritmo aprendesse o que causa a morte das bactérias.\nEm seguida, os pesquisadores usaram a IA para examinar mais de 45 milhões de estruturas químicas diferentes, determinando sua capacidade de combater as bactérias Neisseria gonorrhoeae, a causadora da gonorreia, e Staphylococcus aureus, uma fonte significativa de infecções na forma de SARM.\nEstas duas bactérias são altamente resistentes às drogas. A gonorreia, por exemplo, consegue escapar de quase todos os remédios usados para o seu tratamento.\nCom isso, o número de antibióticos disponíveis como último recurso contra cada uma delas é cada vez menor. E o método empregado por Collins usa a IA para criar compostos inteiramente novos para combatê-las.\nEm uma das técnicas, ele selecionou uma molécula como ponto de partida e empregou uma combinação de técnicas de IA generativa para desenvolvê-la, \"acrescentando ligações, átomos e subestruturas\", explica ele.\nA cada estágio crítico, o seu modelo de IA treinado avaliava o composto. \"Este composto se parece com um antibiótico? Está chegando perto de um possível antibiótico?\"\nOutra abordagem envolveu a eliminação do composto inicial, permitindo que a IA navegasse livremente desde o princípio.\nDesta forma, Collins e seus colegas projetaram 36 milhões de compostos com uso potencial contra as bactérias e selecionaram 24 deles para síntese em laboratório.\nDestes, sete apresentaram alguma atividade antimicrobiana e dois foram altamente eficazes para matar linhagens das duas bactérias resistentes a outros tipos de antibióticos.\nÉ importante destacar que os compostos aparentemente atacam as bactérias de formas diferentes dos antibióticos já existentes. Isso aumenta a esperança de que eles venham a formar uma nova classe de medicamentos, capaz de superar as defesas das bactérias resistentes a drogas.\nAs duas substâncias se encontram atualmente em fase de testes.\nCollins e seu laboratório já haviam empregado a IA para descobrir outros compostos antibióticos poderosos e inovadores, que matam uma ampla variedade de bactérias resistentes aos tratamentos. Elas incluem Clostridium difficile, uma infecção intestinal comum, e Mycobacterium tuberculosis, causadora da tuberculose.\nMas, para algumas doenças, os pesquisadores não têm a possibilidade de partir de remédios existentes para ajudá-los a descobrir novos tratamentos. Por isso, eles precisam se basear nos conhecimentos existentes sobre a doença.\nE, em alguns casos, estes conhecimentos oferecem poucos pontos de partida.\nProgresso sobre Parkinson\nA doença de Parkinson foi identificada pela primeira vez em 1871. E, mais de dois séculos depois, ainda não existe tratamento que reduza a sua progressão.\nExistem mais de 10 milhões de pacientes com Parkinson em todo o mundo e seu número vem aumentando em países que enfrentam o envelhecimento da população.\nNo Reino Unido, cerca de uma a cada 37 pessoas será diagnosticada em algum momento da vida. Nos Estados Unidos, até um milhão de pessoas vivem atualmente com a doença.\nNo Brasil, estima-se que 200 mil pessoas sofram da doença de Parkinson, segundo o Ministério da Saúde.\nAs contínuas tentativas de tratamento de Parkinson foram marcadas pelo fracasso. Parte do motivo é que ainda não conhecemos as causas da doença.\n\"Existem debates sem fim sobre a origem da doença\", segundo o professor de biofísica Michele Vendruscolo, um dos diretores do Centro de Doenças Causadas pelo Desdobramento Incorreto de Proteínas da Universidade de Cambridge, no Reino Unido.\n\"Se você for a uma conferência sobre Parkinson, ouvirá dezenas de hipóteses diferentes, todas elas sendo ativamente pesquisadas\", explica ele.\nIsso dificulta incrivelmente o desenvolvimento de um medicamento para evitar a doença.\nExiste uma enorme quantidade de testes clínicos investigando diferentes hipóteses. Mas, até o momento, não houve sucesso, segundo Vendruscolo.\n\"As pessoas realmente estão confusas sobre qual deve ser o objetivo\", afirma ele. \"E, mesmo se você souber qual é o alvo, costuma ser muito difícil tentar atingi-lo.\"\nMas, em 2024, Vendruscolo e seus colegas publicaram um estudo empregando aprendizado de máquina (uma forma de inteligência artificial) para buscar possíveis medicamentos capazes de agir sobre os grupos de proteínas desdobradas incorretamente no cérebro, encontradas em pacientes com Parkinson.\nAcredita-se que esses conjuntos de proteínas, conhecidos como corpos de Lewy, participem dos estágios iniciais da neurodegeneração em pacientes com Parkinson, eventualmente gerando sintomas que incluem tremores, lentidão de movimentos e rigidez muscular.\nAtualmente, o tratamento mais eficaz contra o Parkinson é o medicamento levodopa, que ajuda a melhorar os sintomas da doença. Mas ele também pode causar efeitos colaterais, como movimentos involuntários.\nVendruscolo trabalha para suspender a progressão da doença. Ele e sua equipe começaram com um conjunto de compostos que já havia sido identificado como potencialmente eficaz para o tratamento dos corpos de Lewy.\nO pesquisador alimentou esses compostos em um programa de aprendizado de máquina, que extrapolou suas estruturas químicas para propor novos compostos que também poderão ser eficazes.\nPara o tratamento de doenças neurodegenerativas, como Parkinson, os medicamentos precisam ser suficientemente pequenos para poderem atravessar a barreira hematoencefálica.\nMas, mesmo se os cientistas restringirem sua caça às moléculas pequenas, \"a quantidade de opções ainda será gigantesca\", explica Vendruscolo. \"O número de possíveis moléculas pequenas é muito maior que o número de átomos do Universo.\"\nO poder da IA pode reduzir esta busca com muita rapidez.\n\"Podemos analisar estes dados e fazer previsões muito precisas sobre a forma em que as possíveis moléculas se unem ao alvo em escala impensável até alguns anos atrás\", segundo Vendruscolo.\nCom os métodos mais tradicionais, os cientistas podem selecionar cerca de um milhão de moléculas em seis meses, ao custo de vários milhões de dólares.\n\"Agora, você pode fazer o mesmo em poucos dias e selecionar bilhões de moléculas, ao custo de alguns milhares de dólares\", explica ele.\nOs compostos de Vendruscolo, sugeridos por IA, foram testados em laboratório.\n\"Nós avaliamos quais dos candidatos realmente se ligam [aos corpos de Lewy] e retroalimentamos esta informação para o programa de aprendizado de máquina, para que ele possa aprender com seus próprios erros.\"\nPor fim, eles identificaram cinco novos compostos promissores com mais rapidez e eficácia do que as técnicas convencionais.\nOs compostos identificados pela IA também foram muito mais inovadores que os encontrados usando métodos de desenvolvimento mais tradicionais, segundo Vendruscolo.\nAgora, os compostos estão passando por novos testes para determinar se, um dia, eles poderão ser oferecidos como produtos terapêuticos para pacientes com Parkinson.\nVendruscolo espera que a IA possa ajudar a suspender a doença de Parkinson antes do seu início. Ele utiliza a tecnologia para encontrar moléculas pequenas que se liguem às proteínas individuais que formam os corpos de Lewy, ainda no seu estado normal.\n\"Se pudermos estabilizar as proteínas nesta forma, evitaremos o Parkinson, o que é melhor que sua cura\", afirma ele.\nNovos usos para medicamentos antigos\nO tratamento de doenças nem sempre significa criar novos medicamentos.\nO professor de medicina David Fajgenbaum, da Universidade da Pensilvânia, nos Estados Unidos, conseguiu salvar sua própria vida com um medicamento existente que os médicos nunca teriam receitado para ele.\nAos 25 anos de idade, Fajgenbaum foi diagnosticado com um raro subtipo de um transtorno conhecido como doença de Castleman, que aciona uma reação imunológica, causando mau funcionamento do fígado, dos rins e da medula óssea.\nEle não reagiu a nenhum dos tratamentos disponíveis e os médicos disseram que não sabiam o que fazer.\nDepois de semanas de testes com seu próprio sangue, pesquisando a literatura médica e tratando a si próprio como uma cobaia humana, ele acabou encontrando uma possível salvação: um modesto medicamento chamado sirolimo, normalmente administrado a pessoas que recebem doação de rins, para evitar a rejeição do novo órgão.\nPara surpresa dos seus médicos, ele usou o medicamento e fez retroceder sua doença de Castleman. Agora, ela está em remissão há mais de uma década.\nA experiência abriu seus olhos para o potencial existente nos milhares de medicamentos que já passaram pelos extensos testes de segurança necessários para sua comercialização. Adaptando essas drogas para outras condições, os pacientes obtêm tratamentos que não seriam disponíveis de outra forma.\nEm 2022, Fajgenbaum criou uma organização sem fins lucrativos chamada Every Cure.\nUsando aprendizado de máquina, ele compara milhares de medicamentos com milhares de doenças. E os mais promissores são testados em laboratório ou enviados para médicos dispostos a experimentar.\nFaigenbaum é o cientista mais conhecido a empregar a IA desta forma. Mas outros já estão fazendo descobertas.\nNa Faculdade de Medicina Harvard, nos Estados Unidos, um modelo de IA encontrou cerca de 8 mil substâncias aprovadas que poderão ser redirecionadas para tratar 17 mil doenças diferentes.\nA IA está se mostrando particularmente útil para encontrar tratamentos para doenças raras, frequentemente ignoradas pelas indústrias farmacêuticas, devido à falta de incentivo financeiro oferecido pela pequena quantidade de possíveis pacientes.\nO redirecionamento de medicamentos existentes também oferece outra oportunidade.\nNos últimos anos, a IA identificou o potencial de redirecionamento de tratamentos existentes para condições raras, como o transtorno cromossômico conhecido como síndrome de Pitt–Hopkins, a doença inflamatória chamada sarcoidose e um raro tipo de câncer renal que aflige crianças jovens, o tumor de Wilms.\nPesquisadores da Universidade McGill em Montreal, no Canadá, utilizaram IA recentemente para redirecionar medicamentos para o tratamento de fibrose pulmonar idiopática (FPI), uma rara e progressiva doença pulmonar, caracterizada por cicatrizes e espessamento do tecido pulmonar.\nSua técnica envolveu a modelagem da progressão da doença com um modelo de IA.\n\"As doenças complexas, em sua maioria, são dirigidas por uma mudança anormal do estado das células\", segundo um dos pesquisadores, o professor assistente Jun Ding, do Departamento de Medicina da Universidade McGill.\n\"Se pudermos descobrir como a célula passou de saudável para anormal, talvez possamos reverter ou retardar o processo\", explica ele.\nEm primeiro lugar, os pesquisadores extraíram células pulmonares de participantes saudáveis e pacientes em diferentes estágios de progressão da doença.\nEles empregaram sequenciamento de DNA de alta resolução para gerar grande quantidade de dados. Isso permitiu que eles observassem as mudanças das células ao longo do curso da doença.\nEm seguida, eles construíram um modelo de IA generativa que simulasse o processo, mapeando as transições de diversos estados e populações celulares, conforme o avanço da enfermidade.\nDurante o processo, a IA também destacaria eventuais biomarcadores que poderiam ser utilizados para diagnosticar a doença e possíveis objetivos terapêuticos.\n\"Chamamos isso de sistema de doença virtual\", segundo Ding.\nTradicionalmente, os medicamentos são testados em animais ou em células humanas isoladas. Eles pretendem usar este mesmo paradigma com a IA, basicamente simulando os efeitos da FPI sobre as células virtuais.\n\"Os pesquisadores podem então testar os impactos da aplicação de diferentes substâncias para o modelo, sem grandes custos\", explica ele.\nNo estudo de McGill, a IA sugeriu oito possíveis opções de tratamento para FPI. E um candidato promissor é um medicamento normalmente receitado para hipertensão, o que oferece uma opção de baixo custo e comprovadamente segura.\nDing afirma que a IA desenvolvida por ele e seus colegas também poderá ser empregada para outras doenças, como tipos de câncer e condições pulmonares. Sua equipe continua a aprimorar o modelo e diversificá-lo sob diferentes condições.\nA FPI teve outra inovação recente graças à IA.\nA empresa de descoberta de drogas por IA Insilico Medicine produziu uma possível substância chamada rentosertib. E. Nos testes clínicos de fase 2, a substância se mostrou promissora contra a FPI.\nA empresa usou IA para identificar possíveis fraquezas da doença e projetar um medicamento que pudesse combatê-las. A esperança é que, se os testes forem bem sucedidos, o medicamento possa estar disponível até o final da década.\nA Insilico Medicine não é a única. Outras empresas também buscam fazer avanços médicos com IA, como a Terray, Isomorphic Labs, Recursion Pharmaceuticals e Schrödinger.\n\"Acredito que, nos próximos cinco a 10 anos, a maior parte do desenvolvimento de novos medicamentos poderá ser orientada por IA ou até ser totalmente baseada em IA\", segundo Ding.\nRevolução limitada\nMas, apesar dos avanços oferecidos pela IA, existem limitações.\nMuitos dos conjuntos de dados sobre medicamentos são de propriedade das empresas farmacêuticas e de biotecnologia. Isso significa que eles não são disponíveis ao público.\n\"Você precisa obter os dados sobre as propriedades das substâncias, como absorção, distribuição, excreção e toxicidade\", segundo Collins. \"Não temos esses conjuntos de dados.\"\nAtualmente, a IA é mais útil no estágio de seleção inicial do processo de desenvolvimento de medicamentos: a identificação de objetivos e a busca de moléculas para atingir aquele propósito.\nEstas são apenas duas etapas do longo processo necessário para desenvolver novos medicamentos, o que indica que pode levar algum tempo até que algum desses possíveis tratamentos chegue aos pacientes, se é que isso irá acontecer.\n\"A IA está revolucionando a descoberta de medicamentos\", segundo Vendruscolo. \"Mas apenas de formas muito específicas.\"', 'Tecnologia', 'Gustavo', '2026-04-01 00:00:00', '../../assets/images/tratamento-ia.png', 0, NULL),
(13, 'Como gravar tarefas domésticas pode treinar robôs \"mordomos\" no futuro', 'Empresas contratam trabalhadores para filmar atividades domésticas e gerar dados que ajudam a treinar robôs com inteligência artificial', 'O sonho de implantar robôs humanoides em cada casa criou um novo tipo de emprego. Os únicos requisitos são uma faixa de cabeça, um smartphone e uma lista de tarefas.\nCom a evolução da inteligência artificial, os robôs humanoides tornaram-se a mais recente fronteira na corrida para dominar a tecnologia avançada. Os fabricantes de robôs estão lançando uma sucessão de novos modelos que podem andar, dançar e lutar com agilidade crescente.\nMas o santo graal da indústria em crescimento – um robô de uso geral que possa trabalhar em lojas, escritórios e residências – precisa de uma vasta quantidade de dados para aprender a substituir humanos com segurança e eficácia. Cada vez mais, esses dados estão sendo criados por pessoas que se filmam realizando tarefas domésticas mundanas.\nIsso criou um apetite voraz por filmagens em primeira pessoa que podem ser usadas para treinar robôs, também conhecidas como \"dados egocêntricos\" ou \"dados humanos\". Nos últimos meses, startups entraram em cena para atender essa demanda, coletando e anotando vídeos de milhares de trabalhadores contratados em todo o mundo.\n\"Manufatura, armazéns de fábricas, varejo, casas de repouso, hospitais – você vai precisar desse tipo de dados em basicamente todos os ambientes, e isso porque os movimentos são todos diferentes\", disse Arian Sadeghi, vice-presidente de dados de robótica da Micro1, que começou a recrutar seu próprio exército de videógrafos remotos no ano passado.\nCada pessoa recebe um equipamento de cabeça para fixar uma câmera, instruções de filmagem e uma lista de tarefas como cozinhar, limpar, jardinagem e cuidados com animais de estimação. Espera-se que os trabalhadores alternem entre as tarefas e enviem pelo menos 10 horas de vídeo por semana.\nEmbora as filmagens atualmente girem em torno de tarefas domésticas, Sadeghi disse que a empresa incentiva os contratados a experimentarem o que filmam, caso isso possa eventualmente ajudar os robôs a se adaptarem mais rapidamente a novos ambientes e responsabilidades.\n\"A coisa que dizemos a eles é: \"Se você acha que quer que um robô faça isso por você, vá em frente e grave\"\", disse Sadeghi.\n\"Bilhões de horas\"\nEmbora a Micro1 esteja sediada em Palo Alto, Califórnia, ela tem cerca de 4.000 \"generalistas de robótica\" em diferentes residências em 71 países, que enviam à empresa mais de 160.000 horas de vídeo por mês. Sadeghi disse que isso não é nem de longe o suficiente.\n\"Você provavelmente precisa de bilhões de horas\", ele disse. \"Ainda nem chegamos às interações humanas. Isso são apenas tarefas domésticas simples.\"\nEle disse que a crescente demanda por dados em robótica reflete a trajetória inicial do ChatGPT e outros chatbots de IA. Treinado em centenas de bilhões de palavras coletadas da internet, o ChatGPT usa o que aprendeu sobre padrões de texto para gerar as respostas mais prováveis às solicitações dos usuários.\nApós o texto, os modelos de IA evoluíram para produzir imagens e vídeos personalizados sob demanda, contando com conteúdo facilmente disponível online. Mas os desenvolvedores de robôs precisam de um conjunto muito mais específico de dados de treinamento e não dispõem do mesmo tipo de biblioteca instantânea que a internet forneceu anteriormente.\nIsso se tornou uma oportunidade multibilionária para startups como a Micro1, que também anotam os vídeos para que os robôs possam diferenciar objetos, distâncias e movimentos físicos. Empresas de pesquisa de mercado estimam que o setor de coleta e rotulagem de dados expandirá em média cerca de 30% anualmente, liderado pelo crescimento na Ásia, para atingir pelo menos US$ 10 bilhões até 2030.\nRavi Rajalingam, fundador da empresa de anotação de dados Objectways, forneceu dados de áudio e visuais para treinar assistentes virtuais com IA e carros autônomos, antes de mudar seu foco para a robótica no ano passado. Desde que começou a contratar pessoas para coletar dados humanos, ele descobriu que apenas cerca de metade das filmagens enviadas é utilizável.\nAinda assim, com 90% de seus clientes baseados nos EUA, e com a suposição deles de que os consumidores americanos têm o poder aquisitivo para adotar robôs humanoides precocemente, alguns estão dispostos a pagar mais por dados de residências americanas, mesmo que o salário por hora possa ser até três vezes maior que o de um trabalhador no Vietnã ou na Índia.\n\"A cozinha da Índia é muito diferente da cozinha dos EUA. Uma vassoura na Índia é muito diferente de uma vassoura nos EUA. Então a variedade é importante, mas depende de onde você vai colocar seus robôs primeiro\", disse Rajalingam. \"Essa é a razão pela qual estamos coletando dados em todo o mundo.\"\nComo treinar seu robô\nPor décadas, os robôs têm sido treinados principalmente para realizar tarefas por humanos usando controles remotos. Mas isso requer muito hardware caro.\nMais recentemente, uma opção mais barata tem sido usar software para simular cenários virtuais, embora geralmente seja menos eficaz para interações com objetos físicos, como pegar um copo.\n\"Com dados, é sempre uma questão de equilíbrio entre qualidade e quantidade\", disse Alicia Veneziani, vice-presidente de expansão de mercado da Sharpa, uma startup de androides com sede em Singapura que se especializa em mãos robóticas.\nA China, que está investindo recursos estatais em indústrias de alta tecnologia, anunciou planos para pelo menos 60 centros de treinamento de robôs em todo o país. A maioria dos robôs humanoides produzidos em massa na China até agora foi adquirida para treinamento e pesquisa, disse Marco Wang, um analista baseado em Xangai da Interact Analysis, uma empresa de pesquisa em tecnologia.\nMas até o final do ano passado, a indústria começou a adotar o uso de dados humanos como uma solução intermediária, já que os únicos custos são um dispositivo de gravação como um GoPro, óculos Meta ou smartphone, e salários por hora entre $5 e $20, dependendo da região.\n\"A ideia aqui é: Ok, eu não quero o robô fazendo a tarefa. Eu quero as pessoas fazendo a tarefa\", ele disse. \"Dessa forma, você não precisa pagar pelos robôs, você só precisa pagar pelo equipamento e pelas pessoas.\"\nWang disse que viu modelos de negócios no Japão e na Coreia do Sul semelhantes aos centros de coleta de dados na China, mas com bases no Sudeste Asiático para capitalizar mão de obra mais barata. A Tesla tem treinado seu robô humanoide Optimus em suas próprias instalações em Fremont, Califórnia, e planeja expandir para Austin, Texas. Wang disse que os EUA e a Europa tendem a favorecer o treinamento por simulação defendido pela Nvidia, que projeta os chips de computador mais avançados do mundo.\nNo entanto, em um relatório de fevereiro, a Nvidia disse que incorporar mais de 20.000 horas de vídeos em primeira pessoa no treinamento de robôs melhorou a taxa de sucesso de tarefas como enrolar camisetas, classificar cartas de baralho, desparafusar tampas de garrafas e usar uma seringa, em mais de 50%.\n\"Se você depender de apenas uma forma de coleta de dados, provavelmente não é a melhor abordagem\", disse Wang, que espera que as empresas combinem cada vez mais estratégias. \"No futuro, será uma mistura de diferentes abordagens.\"\nA última milha da automação\nO ponto de virada para robôs autônomos ocorreu há três anos, quando os grandes modelos de linguagem que possibilitaram o ChatGPT deram origem a um novo algoritmo que traduz sinais visuais em ação física, disse Puneet Jindal, cofundador da empresa de anotação de dados Labellerr AI. Robôs que antes eram programados para tarefas repetitivas puderam começar a perceber e navegar pelo mundo ao seu redor.\nSua empresa começou a coletar seus próprios vídeos em primeira pessoa este ano, de trabalhadores em instalações de manufatura na Índia. Pelos próximos três anos, Jindal disse, priorizar dados humanos é uma \"decisão óbvia\". Mas esse boom pode não durar. Em breve, esse conteúdo poderia melhorar o treinamento de simulação, ou se a IA conseguir converter vídeos do YouTube encontrados online em primeira pessoa, isso poderia se tornar um substituto, ele disse.\n\"Até os laboratórios de robótica estão sentindo que não sabem quais dados serão necessários daqui a 12 meses\", ele disse.\nParte da razão pela qual robôs de uso geral precisam de tanto treinamento é devido à extrema imprevisibilidade em ambientes domésticos, já que móveis, eletrodomésticos e humanos se movem constantemente, disse Rutav Shah, pesquisador de robótica na Universidade do Texas em Austin.\n\"O que realmente está faltando é uma intuição semelhante à humana sobre forças, fricção e incerteza que as pessoas adquirem ao longo de suas vidas\", disse Shah. \"Tornar os robôs geralmente úteis para tarefas domésticas cotidianas como cozinhar, limpar, isso vai ser a última milha da automação.\"\nAté agora, robôs humanoides foram principalmente implantados em ambientes controlados como fábricas, onde são capazes de completar suas tarefas 99,9% do tempo, disse Alexander Verl, presidente de pesquisa da Federação Internacional de Robótica. Mesmo em dobrar camisetas, a taxa de sucesso atual ainda é muito baixa para ser comercialmente viável, ele disse.\n\"A probabilidade de que tenha sucesso geralmente está em torno de 70 ou 80%. Vindo da manufatura, isso realmente não é algo que nossos parceiros da indústria queiram usar\", disse Verl.\nRajalingam da Objectways também enfatizou os riscos de segurança: se um robô estiver limpando um quarto de brinquedos, mas não conseguir distinguir entre uma boneca e um bebê humano, os resultados poderiam ser desastrosos.\n\"Se o robô pegar meu bebê e colocá-lo em uma lixeira, aí vem o processo de um milhão de dólares\", disse ele.\nTestar robôs com bebês ainda está muito distante, disse Rajalingam. No entanto, ele acrescentou, eles já começaram com cães.', 'Tecnologia', 'Luis', '2026-04-01 00:00:00', '../../assets/images/treinar-robos.png', 1, NULL),
(14, 'Meta deve enfrentar novo processo nos EUA por acusação de vício em redes sociais entre jovens', 'Empresa responsável pelo Facebook e Instagram já foi condenada a pagar US$ 6 milhões a uma mulher que afirma ter desenvolvido vício no uso das redes sociais.', 'A Meta, dona do Facebook, do Instagram e do WhatsApp, deve enfrentar uma ação judicial movida pela procuradora-geral do estado norte-americano de Massachusetts, que afirma que a empresa controladora do Facebook e do Instagram criou, de forma deliberada, produtos para viciar jovens.\nA Meta nega as acusações e afirma que adota uma série de medidas para garantir a segurança de adolescentes e jovens em suas plataformas.\nA decisão ocorre após um julgamento considerado histórico, no qual um júri da cidade norte-americana de Los Angeles concluiu, em março, que Meta e Google agiram de forma negligente ao criarem plataformas de mídia social prejudiciais aos jovens.\nO júri determinou o pagamento de US$ 6 milhões a uma mulher de 20 anos que afirmou ter desenvolvido dependência de redes sociais ainda na infância.\nUm júri diferente, um dia antes, decidiu que a Meta deveria pagar US$ 375 milhões em multas civis em um processo movido pelo procurador-geral do estado norte-americano do Novo México.\nA ação acusa a empresa de enganar os usuários sobre a segurança do Facebook e do Instagram e de permitir a exploração sexual infantil nessas plataformas.\nOutros 34 estados dos Estados Unidos movem processos semelhantes contra a Meta em um tribunal federal.\nA ação apresentada pela procuradora-geral de Massachusetts, Andrea Joy Campbell, do Partido Democrata, é uma de pelo menos nove abertas por procuradores-gerais desde 2023 em tribunais estaduais. Entre elas está uma ação protocolada na quarta-feira pela procuradora-geral de Iowa, Brenna Bird, do Partido Republicano.\nA ação afirma que recursos do Instagram, como notificações automáticas, \"curtidas\" em publicações e a rolagem infinita de conteúdo, foram desenvolvidos para explorar vulnerabilidades psicológicas dos adolescentes, especialmente o chamado \"medo de ficar de fora\".\nO processo afirma que os recursos do Instagram, como notificações push, \"curtidas\" de publicações de usuários e uma rolagem interminável, foram projetados para lucrar com as vulnerabilidades psicológicas dos adolescentes e seu \"medo de ficar de fora\".\nO estado afirma que dados internos da empresa indicam que a plataforma provoca dependência e causa prejuízos às crianças.\nA Meta tentou barrar o processo de Massachusetts com base na Seção 230 da Lei de Decência nas Comunicações de 1996, uma legislação federal dos EUA que, em geral, protege empresas de internet de ações judiciais relacionadas ao conteúdo publicado por usuários.\nO estado sustenta que a Seção 230 não se aplica a declarações consideradas falsas que, segundo a acusação, a Meta fez sobre a segurança do Instagram, as ações para proteger o bem-estar de usuários jovens e os sistemas de verificação de idade usados para impedir o acesso de crianças com menos de 13 anos.\nUm juiz de primeira instância concordou com o argumento e afirmou que a lei também não se aplica às acusações sobre os efeitos negativos do design do Instagram.\nSegundo o magistrado, o estado busca responsabilizar a Meta principalmente por sua própria conduta comercial, e não pelo conteúdo publicado por terceiros.', 'Tecnologia', 'Luis', '2026-04-01 00:00:00', '../../assets/images/vicios-redes-sociais.png', 0, NULL);
INSERT INTO `noticias` (`id_noticia`, `titulo`, `subtitulo`, `conteudo`, `categoria`, `autor`, `data_publicacao`, `imagem`, `visualizacoes`, `slug`) VALUES
(15, 'Sua voz pode ser clonada por IA! Saiba identificar e como se proteger', 'Especialistas fazem alerta sobre o crescimento de golpes com deepfake de áudio; entenda como reconhecer e se proteger de fraudes cada vez mais realistas', 'Golpes com voz clonada por inteligência artificial (IA) estão se tornando mais comuns e difíceis de identificar. Com poucos segundos de áudio, criminosos conseguem replicar vozes com alto nível de realismo para enganar familiares, aplicar fraudes financeiras e até burlar sistemas de autenticação. A técnica, conhecida como deepfake de áudio, já é usada em larga escala. Veja como esses golpes funcionam, sinais de alerta e dicas práticas para se proteger.\nÍndice\nComo a IA consegue copiar sua voz\nComo os golpes com voz clonada acontecem\nSinais de que a voz pode ser falsa\nComo se proteger de golpes com voz de IA\nDá para confiar na voz de alguém?\nPor que esse tipo de golpe está crescendo\n1. Como a IA consegue copiar sua voz\nA clonagem de voz é viabilizada por modelos de inteligência artificial generativa, capazes de analisar padrões como timbre, entonação e ritmo da fala. Com poucos segundos de áudio, muitas vezes coletados de redes sociais, vídeos ou mensagens de voz, esses sistemas conseguem reproduzir falas com alto grau de fidelidade.\nEssa técnica, chamada de deepfake de áudio, evoluiu rapidamente nos últimos anos e já permite gerar falas completas com naturalidade, o que amplia seu uso em fraudes digitais.\n2. Como funcionam os golpes com voz clonada\nApós obter a amostra de voz, criminosos utilizam a tecnologia em diferentes abordagens. As mais comuns incluem:\nLigações em que se passam pela própria vítima\nEnvio de áudios por aplicativos como o WhatsApp\nPedidos urgentes de dinheiro para familiares ou amigos\nTentativas de acesso a contas com autenticação por voz\nEm geral, os golpistas criam situações de emergência para gerar pressão emocional e acelerar decisões, reduzindo as chances de verificação — prática já observada em outros golpes digitais, como o SIM swap e o WhatsApp clonado.\n3. Sinais de que a voz pode ser falsa\nApesar do alto nível de realismo, áudios gerados por IA ainda apresentam indícios que podem levantar suspeitas:\nEntonação artificial ou “perfeita demais”\nFalta de emoção ou variação natural\nAusência de ruídos de fundo\nPequenos atrasos ou pausas incomuns\nPedidos urgentes fora do padrão\nInformações inconsistentes\nDiante desses sinais, a recomendação é interromper a conversa e confirmar a identidade por outro canal.\n4. Como se proteger de golpes com voz de IA\nÉ possível reduzir significativamente o risco com algumas medidas práticas:\nDesconfie de pedidos urgentes envolvendo dinheiro ou dados\nConfirme a situação por outro meio (ligação direta ou vídeo)\nCombine códigos ou palavras-chave com familiares\nEvite compartilhar áudios pessoais em redes sociais\nNão tome decisões sob pressão\nEssas práticas seguem recomendações gerais de especialistas em segurança digital e entidades do setor financeiro para prevenção de fraudes.\n5. Ainda dá para confiar na voz de alguém?\nCom o avanço dos deepfakes, a voz deixou de ser um método seguro de autenticação isolado. Criminosos já conseguem contornar sistemas baseados apenas nesse fator, o que tem levado empresas a adotarem múltiplas camadas de verificação, como biometria comportamental e autenticação em dois fatores.\nSegundo a McKinsey & Company, o custo total da fraude pode ser várias vezes maior do que as perdas diretas, considerando impactos como perda de clientes e danos à reputação.\nEmpresas especializadas também vêm investindo em soluções de detecção. A Blue6ix, por exemplo, afirma que suas tecnologias de análise de áudio e identificação de voz sintética já contribuíram para a redução de 40% nos falsos positivos em operações de um banco múltiplo. Entre as medidas adotadas estão a análise automatizada de áudios e revisão de processos de autenticação.\nSegundo Neiva Dourado Mendes, presidente do conselho da empresa, “o desafio não está apenas na atuação da equipe, mas na velocidade com que a tecnologia criminosa evolui em comparação aos processos internos das empresas”.\n6. Por que esse tipo de golpe está crescendo?\nO avanço dessas fraudes está diretamente ligado à popularização das ferramentas de inteligência artificial, que se tornaram mais acessíveis e fáceis de usar. Ao mesmo tempo, a grande quantidade de áudios disponíveis online facilita a coleta de material para clonagem.\nOutro fator relevante é a baixa maturidade de segurança em parte das empresas, que ainda utilizam métodos vulneráveis de autenticação. Isso amplia o alcance das fraudes e exige respostas mais rápidas do mercado.', 'Tecnologia', 'Luis', '2026-04-01 00:00:00', '../../assets/images/voz-clonada.png', 0, NULL),
(19, 'Dezenas de robôs \'protestam\' contra uso descontrolado da IA na PolôniaDezenas de robôs \'protestam\' contra uso descontrolado da IA na Polônia', 'Agitando bandeiras, entoando slogans e marchando em círculo, cerca de 30 robôs foram às ruas de Varsóvia nesta segunda-feira (7) para exigir que a Polônia regulamente a inteligência artificial (IA).', 'Agitando bandeiras, entoando slogans e marchando em círculo, cerca de 30 robôs foram às ruas de Varsóvia nesta segunda-feira (7) para exigir que a Polônia regulamente a inteligência artificial (IA).\n\nAgitando bandeiras, entoando slogans e marchando em círculo, cerca de 30 robôs foram às ruas de Varsóvia nesta segunda-feira (7) para exigir que a Polônia regulamente a inteligência artificial (IA).\n\n## Agitando bandeiras, entoando slogans e marchando em círculo\n\n\"Se não reagirmos agora, poderemos ter um problema em breve\", acrescentou, salientando a necessidade de \"regras e regulamentos que sirvam de escudo protetor para os trabalhadores\".\n\n\"Se não reagirmos agora, poderemos ter um problema em breve\", acrescentou, salientando a necessidade de \"regras e regulamentos que sirvam de escudo protetor para os trabalhadores\".\n\n\"Se não reagirmos agora, poderemos ter um problema em breve\", acrescentou, salientando a necessidade de \"regras e regulamentos que sirvam de escudo protetor para os trabalhadores\".\n\n\"Se não reagirmos agora, poderemos ter um problema em breve\", acrescentou, salientando a necessidade de \"regras e regulamentos que sirvam de escudo protetor para os trabalhadores\".\n\n## Agitando bandeiras, entoando slogans e marchando em círculo\n\n\"Se não reagirmos agora, poderemos ter um problema em breve\", acrescentou, salientando a necessidade de \"regras e regulamentos que sirvam de escudo protetor para os trabalhadores\".\n\n\"Se não reagirmos agora, poderemos ter um problema em breve\", acrescentou, salientando a necessidade de \"regras e regulamentos que sirvam de escudo protetor para os trabalhadores\".', 'IA', 'Lucas Reis Souza', '2026-09-07 21:22:26', '../../assets/images/dezenas-de-rob-os-protestam-contra-uso-descontrolado-da-ia-na-pol-oniadezenas-de-rob-os-protestam-contra-uso-descontrolado-da-ia-na-pol-onia-3318b612.png', 3, 'dezenas-de-rob-os-protestam-contra-uso-descontrolado-da-ia-na-pol-oniadezenas-de-rob-os-protestam-contra-uso-descontrolado-da-ia-na-pol-onia-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes_moderador`
--

CREATE TABLE `solicitacoes_moderador` (
  `id_solicitacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` enum('pendente','aprovada','recusada') NOT NULL DEFAULT 'pendente',
  `data_solicitacao` datetime NOT NULL DEFAULT current_timestamp(),
  `data_decisao` datetime DEFAULT NULL,
  `id_admin_decisor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `solicitacoes_moderador`
--

INSERT INTO `solicitacoes_moderador` (`id_solicitacao`, `id_usuario`, `status`, `data_solicitacao`, `data_decisao`, `id_admin_decisor`) VALUES
(2, 10, 'recusada', '2026-09-09 06:15:53', '2026-09-09 06:17:03', 7),
(3, 10, 'aprovada', '2026-09-09 06:17:30', '2026-09-09 06:17:51', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_segura` varchar(255) NOT NULL,
  `tipo_usuario` enum('admin','editor','leitor') NOT NULL DEFAULT 'leitor',
  `data_criacao` datetime DEFAULT current_timestamp(),
  `pergunta_seguranca` varchar(255) NOT NULL DEFAULT '',
  `resposta_seguranca` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha_segura`, `tipo_usuario`, `data_criacao`, `pergunta_seguranca`, `resposta_seguranca`) VALUES
(1, 'Admin', 'admin@exemplo.com', '$2y$12$ackSWnTTasMIkuEuO3eMnuGUcutFwaXaPxClGoWOa3GZEHwH/ywl6', 'admin', '2026-08-31 17:35:16', '', ''),
(3, 'Usuario Exemplo', 'usuario@exemplo.com', '$2y$12$ackSWnTTasMIkuEuO3eMnuGUcutFwaXaPxClGoWOa3GZEHwH/ywl6', 'leitor', '2026-08-31 17:35:16', '', ''),
(4, 'Lucas dos Santos Camilo', 'lucas.6161@df.senac.br', '$2y$12$ackSWnTTasMIkuEuO3eMnuGUcutFwaXaPxClGoWOa3GZEHwH/ywl6', 'leitor', '2026-09-02 15:16:00', 'Qual é o nome do seu primeiro pet?', 'Pudim'),
(5, 'Gustavo Italo', 'gustavoi7@gmail.com', '$2y$12$ackSWnTTasMIkuEuO3eMnuGUcutFwaXaPxClGoWOa3GZEHwH/ywl6', 'editor', '2026-09-02 15:40:21', 'Qual o nome do seu filme favorito?', 'Homem Aranha'),
(6, 'Luis Henrique Moreira Araújo', 'luismaraujo28@gmail.com', '$2y$12$ackSWnTTasMIkuEuO3eMnuGUcutFwaXaPxClGoWOa3GZEHwH/ywl6', 'editor', '2026-09-04 15:05:16', 'Qual é o nome do seu primeiro pet?', 'belinha'),
(7, 'Lucas Reis Souza', 'lucasreisrego@gmail.com', '$2y$10$LC3k9t7Y96wWxck1PHp.FuU/Gklrudpw3d4V0Z1fx9WVvlu1tDage', 'admin', '2026-09-07 16:09:35', 'Qual é o nome do seu primeiro pet?', 'boris'),
(9, 'Usuário Validação', 'validacao.temporaria@byte.news', '$2y$10$enCwVoyE1ZiJLsLVVsEijelgAtsZA9uot/KING.Mwpx0BdoDlWWAm', 'leitor', '2026-09-08 21:49:37', 'Qual é o nome do seu primeiro pet?', 'Rex'),
(10, 'João Pedro Reis Souza', 'joao84857022@gmail.com', '$2y$10$PNTX5ya2kIyobaaQCY3ndO0CQgIIKtw7NMEAESPBUIrvSEj43aLdi', 'editor', '2026-09-09 06:14:43', 'Qual o nome do seu filme favorito?', 'gran turismo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Índices para tabela `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  ADD PRIMARY KEY (`id_curtida`),
  ADD UNIQUE KEY `comentario_usuario_unico` (`id_comentario`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `curtidas_noticias`
--
ALTER TABLE `curtidas_noticias`
  ADD PRIMARY KEY (`id_usuario`,`id_noticia`),
  ADD KEY `fk_curtidas_noticias_noticia` (`id_noticia`);

--
-- Índices para tabela `favoritos_noticias`
--
ALTER TABLE `favoritos_noticias`
  ADD PRIMARY KEY (`id_usuario`,`id_noticia`),
  ADD KEY `fk_favoritos_noticia` (`id_noticia`);

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Índices para tabela `solicitacoes_moderador`
--
ALTER TABLE `solicitacoes_moderador`
  ADD PRIMARY KEY (`id_solicitacao`),
  ADD KEY `idx_solicitacao_usuario` (`id_usuario`),
  ADD KEY `fk_solicitacoes_admin` (`id_admin_decisor`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  MODIFY `id_curtida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `solicitacoes_moderador`
--
ALTER TABLE `solicitacoes_moderador`
  MODIFY `id_solicitacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_noticias` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comentarios_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  ADD CONSTRAINT `fk_curtidas_comentarios` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id_comentario`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_curtidas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `curtidas_noticias`
--
ALTER TABLE `curtidas_noticias`
  ADD CONSTRAINT `fk_curtidas_noticias_noticia` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_curtidas_noticias_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `favoritos_noticias`
--
ALTER TABLE `favoritos_noticias`
  ADD CONSTRAINT `fk_favoritos_noticia` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favoritos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `solicitacoes_moderador`
--
ALTER TABLE `solicitacoes_moderador`
  ADD CONSTRAINT `fk_solicitacoes_admin` FOREIGN KEY (`id_admin_decisor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_solicitacoes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
