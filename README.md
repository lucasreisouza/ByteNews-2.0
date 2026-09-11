# ByteNews 2.0

Portal de notícias sobre tecnologia, inteligência artificial, games e hardware. O projeto foi desenvolvido para praticar front-end, PHP e MySQL.

## Funcionalidades

- Catálogo de notícias com busca e filtros por categoria
- Autenticação, perfil e níveis de acesso (leitor, editor e administrador)
- Comentários, curtidas e favoritos
- Painel editorial para publicar e gerenciar notícias
- Tema claro/escuro e layout responsivo

## Tecnologias

- HTML, CSS e JavaScript
- PHP 8+
- MySQL/MariaDB
- XAMPP (ambiente local sugerido)

## Como executar localmente

1. Copie ou clone o repositório para `C:\xampp\htdocs\ByteNews-2.0`.
2. Inicie o Apache e o MySQL no XAMPP.
3. Importe `sistemabytenews.sql` no phpMyAdmin, criando o banco `sistemabytenews`.
4. Ajuste host, porta, usuário e senha locais em `src/php/conexao.php` conforme sua instalação.
5. Acesse `http://localhost/ByteNews-2.0/`.

## Estrutura principal

- `index.php`: página inicial
- `src/pages`: telas da aplicação
- `src/php`: autenticação, regras de negócio e endpoints
- `src/assets`: estilos, scripts, ícones e imagens
- `sistemabytenews.sql`: estrutura e dados de demonstração

## Observações

- Notícias novas recebem um slug único e são acessadas por `src/pages/news/noticia.php?slug=...`.
- O dump preenche os slugs das notícias legadas e mantém o acesso por ID como compatibilidade.
- O botão **Sair** encerra a sessão PHP em `src/php/logout.php`.

## Autores

[Luís Henrique](https://github.com/lh-luiii), [Lucas Reis Souza](https://github.com/lucasreisouza) e [Gustavo Ítalo](https://github.com/GustavoI7) — Senac DF, Técnico em Informática para Internet.
