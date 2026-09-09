-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 04, 2026 at 09:21 PM
-- Server version: 8.0.44
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bytenewsteste`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int NOT NULL,
  `comentario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `id_noticia` int NOT NULL,
  `data_comentario` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentario`, `id_usuario`, `id_noticia`, `data_comentario`, `status`) VALUES
(4, 'Excelente notícia!!!!', 3, 3, '2026-08-26 11:27:08', 'ativo'),
(8, 'Matéria excelente!!', 1, 1, '2026-08-28 11:24:10', 'ativo');

-- --------------------------------------------------------

--
-- Table structure for table `curtidas_comentarios`
--

CREATE TABLE `curtidas_comentarios` (
  `id_curtida` int NOT NULL,
  `id_comentario` int NOT NULL,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curtidas_comentarios`
--

INSERT INTO `curtidas_comentarios` (`id_curtida`, `id_comentario`, `id_usuario`) VALUES
(10, 4, 1),
(4, 4, 3),
(11, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitulo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `conteudo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_publicacao` datetime NOT NULL,
  `imagem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `titulo`, `subtitulo`, `conteudo`, `categoria`, `autor`, `data_publicacao`, `imagem`) VALUES
(1, 'OpenAI, dona do ChatGPT, vê ameaça da IA ao emprego e defende semana de 4 dias', 'Relatório da OpenAI discute impactos da IA no trabalho', 'Documento da OpenAI defende que a IA deve gerar ganhos sociais, como redução da jornada de trabalho sem corte salarial e participação dos trabalhadores nas decisões sobre o uso da tecnologia...', 'IA & Machine Learning', 'Redação g1', '2026-04-11 03:00:00', '../../assets/images/modelo-ia.png'),
(2, 'Protótipo de \'carro voador\' da Embraer completa 50 voos de teste', 'Versão de teste já soma mais de duas horas de voo desde dezembro, enquanto empresa prepara produção de unidades para certificação junto à Anac.', 'A Eve Air Mobility, empresa subsidiária da Embraer, informou nesta quinta-feira (9) que realizou 50 voos de teste com seu protótipo de \"carro voador\"...', 'Hardware', 'Reuters', '2026-04-09 11:15:00', '../../assets/images/carro-voador.png'),
(3, 'Grécia proibirá redes sociais para menores de 15 anos a partir de 2027', 'Medida busca reduzir impactos digitais entre jovens e pressionar União Europeia por regras similares', 'A Grécia proibirá o acesso às redes sociais para crianças menores de 15 anos a partir de 1º de janeiro de 2027, disse o primeiro-ministro Kyriákos Mitsotákis...', 'Smartphones', 'Antonis Pothitos e Renee Maltezou', '2026-04-08 23:02:00', '../../assets/images/grecias-redes-sociais.png'),
(4, 'GTA 6: lançamento, trailer e o que esperar do jogo', 'Saiba o que esperar de Grand Theft Auto VI (GTA 6), o jogo mais aguardado da última década', 'Grand Theft Auto VI, ou GTA 6, é um dos jogos mais aguardados dos últimos anos; afinal, já se passaram mais de 12 anos desde o lançamento de seu antecessor...', 'Games', 'Lucas Guimarães', '2025-12-01 05:00:00', '../../assets/images/gta-6.png'),
(5, '\'Project Maven\': como os EUA usam IA como tecnologia de guerra para lançar ataques letais em minutos', 'Pentágono afirma que ferramenta acelera a identificação de alvos e reduz o tempo entre a identificação de um alvo e a execução do ataque.', 'Os Estados Unidos têm recorrido a um aliado não convencional na campanha contra o Irã: a inteligência artificial. No centro dessa estratégia está o Project Maven...', 'IA & Machine Learning', 'Aline Freitas', '2026-04-07 00:01:00', '../../assets/images/guerra-eua.png'),
(6, 'Ataque hacker desvia pagamento e causa prejuízo milionário a empresa de energia no Reino Unido', 'Empresa faria pagamento para outra companhia, mas a invasão redirecionou cerca de R$ 4,7 milhões para um terceiro que não estava envolvido na negociação.', 'Uma empresa de energia no Reino Unido sofreu um prejuízo de 700 mil libras esterlinas (cerca de R$ 4,7 milhões) após um ataque hacker desviar o destino de um pagamento...', 'Hardware', 'Redação g1', '2026-04-10 19:27:00', '../../assets/images/hackers-reino-unido.png'),
(7, 'Hackers ligados ao Irã invadem e-mail de diretor do FBI e vazam fotos e mensagens; o que se sabe', 'O e-mail pessoal do diretor do FBI, Kash Patel, foi invadido por hackers ligados ao Irã nesta sexta-feira (27/3).', 'O grupo, conhecido como Handala Hack Team, publicou em seu site o currículo de Patel e fotos dele, junto com a seguinte declaração: \"Isso é só o começo.\"', 'Hardware', 'Grace Eliza Goodwine e Kwasi Gyamfi Asiedu', '2026-03-27 00:00:00', '../../assets/images/hackers-ira.png'),
(8, 'iPhone dobrável enfrenta problemas de engenharia e lançamento pode atrasar, diz jornal', 'Modelo em teste enfrenta mais problemas do que o esperado, e lançamento previsto para 2026 pode atrasar, segundo o Nikkei Asia.', 'A Apple tem enfrentado problemas na fase de testes de engenharia de seu primeiro iPhone dobrável, o que pode atrasar em meses a produção em massa...', 'Smartphones', 'Redação g1', '2026-04-07 11:19:00', '../../assets/images/iphone-dobravel.png');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_segura` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_usuario` enum('admin','usuario','moderador') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'usuario',
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `pergunta_seguranca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `resposta_seguranca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha_segura`, `tipo_usuario`, `data_criacao`, `pergunta_seguranca`, `resposta_seguranca`) VALUES
(1, 'Admin', 'admin@exemplo.com', '123', 'admin', '2026-08-31 17:35:16', '', ''),
(3, 'Usuario Exemplo', 'usuario@exemplo.com', '$2y$10$abcdefghijklmnopqrstuv', 'usuario', '2026-08-31 17:35:16', '', ''),
(4, 'Lucas dos Santos Camilo', 'lucas.6161@df.senac.br', '$2y$10$RYcoMl2uoZ3zFXuRVMULUOoSZPqo8xr7DJ8MW6TuW2.NUtyBFdAgS', 'usuario', '2026-09-02 15:16:00', 'Qual é o nome do seu primeiro pet?', 'Pudim'),
(5, 'Gustavo Italo', 'gustavoi7@gmail.com', '$2y$10$yyFt.ACvfHkS31ELxIdwT.GrTc4XiFeVDGTwFsYee0VEAGP6kCUfC', 'usuario', '2026-09-02 15:40:21', 'Qual o nome do seu filme favorito?', 'Homem Aranha'),
(6, 'Luis Henrique Moreira Araújo', 'luismaraujo28@gmail.com', '$2y$10$KLzn/b06K7n9eSex/g.LUONkeFBGHnN/Acx4B2VEtdQn4VdOPDZ6y', 'usuario', '2026-09-04 15:05:16', 'Qual é o nome do seu primeiro pet?', 'belinha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Indexes for table `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  ADD PRIMARY KEY (`id_curtida`),
  ADD UNIQUE KEY `comentario_usuario_unico` (`id_comentario`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  MODIFY `id_curtida` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_noticias` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comentarios_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Constraints for table `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  ADD CONSTRAINT `fk_curtidas_comentarios` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id_comentario`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_curtidas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
