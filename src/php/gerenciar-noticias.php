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
        $stmt = $conexao->prepare("DELETE FROM noticias WHERE id_noticia IN ($placeholders)");
        $stmt->bind_param($tipos, ...$ids);
        $stmt->execute();
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