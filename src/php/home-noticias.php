<?php
require_once __DIR__ . '/conexao.php';
header('Content-Type: application/json; charset=utf-8');
function prepararNoticias(mysqli $conexao, string $ordem, int $limite): array
{
    $sql = "SELECT n.id_noticia, n.slug, n.titulo, n.subtitulo, n.categoria, n.autor, n.data_publicacao, n.imagem, COUNT(DISTINCT c.id_comentario) comentarios, COUNT(DISTINCT l.id_usuario) curtidas FROM noticias n LEFT JOIN comentarios c ON c.id_noticia = n.id_noticia LEFT JOIN curtidas_noticias l ON l.id_noticia = n.id_noticia GROUP BY n.id_noticia ORDER BY {$ordem} LIMIT ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $limite);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
$mapear = static function (array $noticias): array {
    return array_map(static function (array $noticia): array {
        $noticia['imagem'] = str_starts_with($noticia['imagem'], 'news-upload/') ? $noticia['imagem'] : basename($noticia['imagem']);
        return $noticia;
    }, $noticias);
};
echo json_encode([
    'destaques' => $mapear(prepararNoticias($conexao, 'comentarios DESC, n.data_publicacao DESC', 4)),
    'ultimas' => $mapear(prepararNoticias($conexao, 'n.data_publicacao DESC', 4)),
    'alta' => $mapear(prepararNoticias($conexao, 'curtidas DESC, n.data_publicacao DESC', 7))
], JSON_UNESCAPED_UNICODE);
