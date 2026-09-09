<?php
require_once __DIR__ . '/../php/autorizacao.php';
require_once __DIR__ . '/../php/conexao.php';
exigirTipo(['leitor']);

$idUsuario = (int) $_SESSION['id_usuario'];
$stmt = $conexao->prepare("SELECT status FROM solicitacoes_moderador WHERE id_usuario = ? ORDER BY id_solicitacao DESC LIMIT 1");
$stmt->bind_param('i', $idUsuario);
$stmt->execute();
$solicitacao = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solicitar moderador | ByteNews</title>
<link rel="stylesheet" href="../assets/CSS/style.css">
</head>
<body class="dark">
<?php $headerBasePath = '../../'; require __DIR__ . '/../php/header.php'; ?>
<main style="max-width:700px;margin:50px auto;padding:20px;">
  <section class="comment-form">
    <h1>Solicitar cargo de moderador</h1>
    <?php if ($solicitacao && $solicitacao['status'] === 'pendente'): ?>
      <p>Sua solicitação está aguardando análise do ADM.</p>
    <?php elseif ($solicitacao && $solicitacao['status'] === 'aprovada'): ?>
      <p>Sua solicitação foi aprovada. Atualize a sessão para acessar as permissões de editor.</p>
    <?php else: ?>
      <?php if ($solicitacao && $solicitacao['status'] === 'recusada'): ?><p>A solicitação anterior foi recusada. Você pode enviar uma nova.</p><?php endif; ?>
      <form method="post" action="../php/solicitar-moderador.php">
        <button class="comment-button" type="submit">Enviar solicitação</button>
      </form>
    <?php endif; ?>
    <p><a href="./painel.php">Voltar ao painel</a></p>
  </section>
</main>
</body>
</html>