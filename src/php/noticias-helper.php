<?php

function normalizarTituloNoticia(string $titulo): string
{
    $titulo = html_entity_decode(strip_tags($titulo), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return mb_strtolower(trim((string) preg_replace('/\s+/u', ' ', $titulo)), 'UTF-8');
}

/** Resolve uma notícia pelo ID, slug ou título de uma página legada. */
function resolverIdNoticia(mysqli $conexao, int $idNoticia, string $slug): int
{
    if ($idNoticia > 0) {
        $stmt = $conexao->prepare('SELECT id_noticia FROM noticias WHERE id_noticia = ? LIMIT 1');
        $stmt->bind_param('i', $idNoticia);
        $stmt->execute();
        return (int) ($stmt->get_result()->fetch_assoc()['id_noticia'] ?? 0);
    }

    if ($slug === '') {
        return 0;
    }

    $stmt = $conexao->prepare('SELECT id_noticia FROM noticias WHERE slug = ? LIMIT 1');
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $idResolvido = (int) ($stmt->get_result()->fetch_assoc()['id_noticia'] ?? 0);
    if ($idResolvido > 0) {
        return $idResolvido;
    }

    $arquivoLegado = dirname(__DIR__) . '/pages/news/' . $slug . '.php';
    $html = is_file($arquivoLegado) ? file_get_contents($arquivoLegado) : false;
    if ($html === false || !preg_match('/<h1[^>]*>(.*?)<\/h1>/si', $html, $tituloLegado)) {
        return 0;
    }

    $titulo = normalizarTituloNoticia($tituloLegado[1]);
    $resultado = $conexao->query('SELECT id_noticia, titulo FROM noticias');
    while ($noticia = $resultado->fetch_assoc()) {
        if (normalizarTituloNoticia($noticia['titulo']) === $titulo) {
            return (int) $noticia['id_noticia'];
        }
    }

    return 0;
}
