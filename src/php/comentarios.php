<?php
session_start();
require_once __DIR__ . '/conexao.php';
header('Content-Type: application/json; charset=utf-8');

$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['noticia'] ?? $_POST['noticia'] ?? ''));
$mapa = [
    'ameaca-ia'=>1, 'carro-voador'=>2, 'grecia-redes-sociais'=>3, 'gta-6'=>4,
    'guerra-eua'=>5, 'hacker-reino-unido'=>6, 'hackers-ira'=>7, 'iphone-dobravel'=>8,
    'meta-ia'=>9, 'modelo-ia'=>10, 'produto-apple'=>11, 'tratamento-ia'=>12,
    'treinar-robos'=>13, 'vicio-redes-sociais'=>14, 'voz-clonada'=>15
];

$idNoticia = (int) ($_GET['id_noticia'] ?? $_POST['id_noticia'] ?? 0);
if (!$idNoticia) {
    $stmtNoticia = $conexao->prepare('SELECT id_noticia FROM noticias WHERE slug = ? LIMIT 1');
    $stmtNoticia->bind_param('s', $slug);
    $stmtNoticia->execute();
    $idNoticia = (int) ($stmtNoticia->get_result()->fetch_assoc()['id_noticia'] ?? 0);
}
$idNoticia = $idNoticia ?: ($mapa[$slug] ?? 0);

if (!$idNoticia) {
    http_response_code(404);
    echo json_encode(['erro'=>'Notícia não encontrada.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conexao->prepare('SELECT c.id_comentario, c.comentario, c.data_comentario, u.nome FROM comentarios c INNER JOIN usuarios u ON u.id_usuario = c.id_usuario WHERE c.id_noticia = ? AND c.status = "ativo" ORDER BY c.data_comentario DESC');
    $stmt->bind_param('i', $idNoticia);
    $stmt->execute();
    $result = $stmt->get_result();
    $comentarios = [];
    while ($row = $result->fetch_assoc()) {
        $comentarios[] = $row;
    }
    echo json_encode(['comentarios' => $comentarios]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['erro'=>'Faça login para comentar.']);
    exit;
}

$comentario = trim($_POST['comentario'] ?? '');
if ($comentario === '' || mb_strlen($comentario) > 2000) {
    http_response_code(422);
    echo json_encode(['erro'=>'O comentário deve ter entre 1 e 2000 caracteres.']);
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];
$stmt = $conexao->prepare('INSERT INTO comentarios (comentario, id_usuario, id_noticia, status) VALUES (?, ?, ?, "ativo")');
$stmt->bind_param('sii', $comentario, $idUsuario, $idNoticia);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['erro'=>'Não foi possível salvar o comentário.']);
    exit;
}

echo json_encode(['sucesso'=>true]);
