<?php
require_once __DIR__ . '/autorizacao.php';
require_once __DIR__ . '/conexao.php';
exigirTipo(['admin', 'editor']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = array_values(array_filter(array_map('intval', $_POST['ids'] ?? []), static fn ($id) => $id > 0));
    $acao = $_POST['acao'] ?? '';
    if ($ids && $acao === 'excluir') {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $tipos = str_repeat('i', count($ids));
        $imagens = [];
        $buscar = $conexao->prepare("SELECT imagem FROM noticias WHERE id_noticia IN ($placeholders)");
        $buscar->bind_param($tipos, ...$ids);
        $buscar->execute();
        $resultadoImagens = $buscar->get_result();
        while ($noticia = $resultadoImagens->fetch_assoc()) {
            $imagens[] = $noticia['imagem'];
        }

        $conexao->begin_transaction();
        try {
            $stmt = $conexao->prepare("DELETE FROM noticias WHERE id_noticia IN ($placeholders)");
            $stmt->bind_param($tipos, ...$ids);
            if (!$stmt->execute()) {
                throw new RuntimeException('Não foi possível excluir as notícias.');
            }
            $conexao->commit();
        } catch (Throwable) {
            $conexao->rollback();
            header('Location: ../pages/gerenciar-noticias.php?erro=excluir');
            exit;
        }

        $diretorioImagens = realpath(dirname(__DIR__) . '/assets/images');
        foreach (array_unique($imagens) as $imagem) {
            $uso = $conexao->prepare('SELECT COUNT(*) AS total FROM noticias WHERE imagem = ?');
            $uso->bind_param('s', $imagem);
            $uso->execute();
            if ((int) $uso->get_result()->fetch_assoc()['total'] > 0) {
                continue;
            }

            $arquivo = str_starts_with($imagem, 'news-upload/')
                ? $diretorioImagens . '/news-upload/' . basename($imagem)
                : $diretorioImagens . '/' . basename($imagem);
            if (is_file($arquivo)) {
                unlink($arquivo);
            }
        }
    } elseif ($ids && $acao === 'atualizar') {
        $autores = $_POST['autor'] ?? [];
        $datas = $_POST['data_publicacao'] ?? [];
        $stmt = $conexao->prepare('UPDATE noticias SET autor = ?, data_publicacao = ? WHERE id_noticia = ?');
        foreach ($ids as $id) {
            $autor = trim($autores[$id] ?? '');
            $data = trim($datas[$id] ?? '');
            if ($autor !== '' && $data !== '') {
                $stmt->bind_param('ssi', $autor, $data, $id);
                $stmt->execute();
            }
        }
    }
}
header('Location: ../pages/gerenciar-noticias.php');
exit;
