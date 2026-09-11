<?php
session_start();
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/noticias-helper.php';
header('Content-Type: application/json; charset=utf-8');

$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['noticia'] ?? $_POST['noticia'] ?? ''));
$idNoticia = resolverIdNoticia($conexao, (int) ($_GET['id_noticia'] ?? $_POST['id_noticia'] ?? 0), $slug);
if (!$idNoticia) {
    http_response_code(404);
    echo json_encode(['erro' => 'Notícia não encontrada.'], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idUsuario = (int) ($_SESSION['id_usuario'] ?? 0);
    $stmt = $conexao->prepare('SELECT c.id_comentario, c.id_usuario, c.comentario, c.data_comentario, u.nome, COUNT(cc.id_curtida) AS curtidas, MAX(CASE WHEN cc.id_usuario = ? THEN 1 ELSE 0 END) AS curtido FROM comentarios c INNER JOIN usuarios u ON u.id_usuario = c.id_usuario LEFT JOIN curtidas_comentarios cc ON cc.id_comentario = c.id_comentario WHERE c.id_noticia = ? AND c.status = "ativo" GROUP BY c.id_comentario, c.id_usuario, c.comentario, c.data_comentario, u.nome ORDER BY c.data_comentario DESC');
    $stmt->bind_param('ii', $idUsuario, $idNoticia);
    $stmt->execute();
    echo json_encode(['comentarios' => $stmt->get_result()->fetch_all(MYSQLI_ASSOC)], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['erro' => 'Faça login para comentar.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];
$acao = $_POST['acao'] ?? '';
if (in_array($acao, ['curtir', 'remover_curtida'], true)) {
    $idComentario = (int) ($_POST['id_comentario'] ?? 0);
    if ($idComentario < 1) {
        http_response_code(400);
        echo json_encode(['erro' => 'Comentário inválido.'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($acao === 'curtir') {
        $stmt = $conexao->prepare('INSERT IGNORE INTO curtidas_comentarios (id_comentario, id_usuario) SELECT id_comentario, ? FROM comentarios WHERE id_comentario = ? AND id_noticia = ? AND status = "ativo"');
        $stmt->bind_param('iii', $idUsuario, $idComentario, $idNoticia);
    } else {
        $stmt = $conexao->prepare('DELETE cc FROM curtidas_comentarios cc INNER JOIN comentarios c ON c.id_comentario = cc.id_comentario WHERE cc.id_comentario = ? AND cc.id_usuario = ? AND c.id_noticia = ?');
        $stmt->bind_param('iii', $idComentario, $idUsuario, $idNoticia);
    }
    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['erro' => 'Não foi possível atualizar a curtida.'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    echo json_encode(['sucesso' => true], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($acao === 'excluir') {
    $idComentario = (int) ($_POST['id_comentario'] ?? 0);
    $stmt = $conexao->prepare('DELETE FROM comentarios WHERE id_comentario = ? AND id_usuario = ? AND id_noticia = ?');
    $stmt->bind_param('iii', $idComentario, $idUsuario, $idNoticia);
    $stmt->execute();
    if ($stmt->affected_rows !== 1) {
        http_response_code(403);
        echo json_encode(['erro' => 'Você só pode excluir seus próprios comentários.'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    echo json_encode(['sucesso' => true], JSON_UNESCAPED_UNICODE);
    exit;
}

$comentario = trim($_POST['comentario'] ?? '');
if ($comentario === '' || mb_strlen($comentario) > 2000) {
    http_response_code(422);
    echo json_encode(['erro' => 'O comentário deve ter entre 1 e 2000 caracteres.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$stmt = $conexao->prepare('INSERT INTO comentarios (comentario, id_usuario, id_noticia, status) VALUES (?, ?, ?, "ativo")');
$stmt->bind_param('sii', $comentario, $idUsuario, $idNoticia);
if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['erro' => 'Não foi possível salvar o comentário.'], JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode(['sucesso' => true], JSON_UNESCAPED_UNICODE);
