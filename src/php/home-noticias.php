<?php
require_once __DIR__ . '/conexao.php';
header('Content-Type: application/json; charset=utf-8');
$slugs = [1=>'ameaca-ia',2=>'carro-voador',3=>'grecia-redes-sociais',4=>'gta-6',5=>'guerra-eua',6=>'hacker-reino-unido',7=>'hackers-ira',8=>'iphone-dobravel',9=>'meta-ia',10=>'modelo-ia',11=>'produto-apple',12=>'tratamento-ia',13=>'treinar-robos',14=>'vicio-redes-sociais',15=>'voz-clonada'];
function prepararNoticias(mysqli $conexao, string $ordem, int $limite): array
{
    $sql = "SELECT n.id_noticia, n.slug, n.titulo, n.subtitulo, n.categoria, n.autor, n.data_publicacao, n.imagem, n.visualizacoes, COUNT(c.id_comentario) comentarios FROM noticias n LEFT JOIN comentarios c ON c.id_noticia = n.id_noticia GROUP BY n.id_noticia ORDER BY {$ordem} LIMIT ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $limite);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
$mapear = static function (array $noticias) use ($slugs): array {
    return array_map(static function (array $noticia) use ($slugs): array {
        $noticia['slug'] = $noticia['slug'] ?: ($slugs[(int) $noticia['id_noticia']] ?? '');
        $noticia['imagem'] = basename($noticia['imagem']);
        return $noticia;
    }, $noticias);
};
echo json_encode([
    'destaques' => $mapear(prepararNoticias($conexao, 'comentarios DESC, n.data_publicacao DESC', 4)),
    'ultimas' => $mapear(prepararNoticias($conexao, 'n.data_publicacao DESC', 4)),
    'alta' => $mapear(prepararNoticias($conexao, 'n.visualizacoes DESC, n.data_publicacao DESC', 7))
], JSON_UNESCAPED_UNICODE);
