<?php
require_once __DIR__ . '/conexao.php';
header('Content-Type: application/json; charset=utf-8');

$slug = preg_replace('/[^a-z0-9-]/', '', strtolower(trim($_GET['slug'] ?? '')));
$slugs = [
    'ameaca-ia' => 1, 'carro-voador' => 2, 'grecia-redes-sociais' => 3,
    'gta-6' => 4, 'guerra-eua' => 5, 'hacker-reino-unido' => 6,
    'hackers-ira' => 7, 'iphone-dobravel' => 8, 'meta-ia' => 9,
    'modelo-ia' => 10, 'produto-apple' => 11, 'tratamento-ia' => 12,
    'treinar-robos' => 13, 'vicio-redes-sociais' => 14, 'voz-clonada' => 15
];
$idNoticia = $slugs[$slug] ?? (int) ($_GET['id_noticia'] ?? 0);
if ($idNoticia < 1) {
    http_response_code(400);
    echo json_encode(['erro' => 'Notícia inválida']);
    exit;
}
$stmt = $conexao->prepare('UPDATE noticias SET visualizacoes = visualizacoes + 1 WHERE id_noticia = ?');
$stmt->bind_param('i', $idNoticia);
$stmt->execute();
echo json_encode(['ok' => true]);
