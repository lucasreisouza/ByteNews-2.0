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
<title>Solicitar acesso | ByteNews</title>
<link rel="stylesheet" href="../assets/CSS/style.css">
<link rel="icon" type="image/png" href="../assets/icons/icone.png">
</head>
<body class="dark">
<?php $headerBasePath = '../../'; require __DIR__ . '/../php/header.php'; ?>
<main class="access-request-page">
  <section class="access-request-card">
    <div class="access-request-intro">
      <span class="eyebrow">ACESSO EDITORIAL</span>
      <span class="access-request-mark" aria-hidden="true">↗</span>
      <h1>Faça parte da equipe ByteNews</h1>
      <p>Solicite acesso de moderador para ajudar a manter as notícias organizadas e a comunidade bem informada.</p>
    </div>
    <div class="access-request-flow" aria-label="Etapas da solicitação">
      <div class="access-step active"><span>01</span><strong>Solicitação</strong></div>
      <div class="access-step-line"></div>
      <div class="access-step"><span>02</span><strong>Análise do ADM</strong></div>
      <div class="access-step-line"></div>
      <div class="access-step"><span>03</span><strong>Acesso liberado</strong></div>
    </div>
    <div class="access-request-status">
    <?php if ($solicitacao && $solicitacao['status'] === 'pendente'): ?>
      <span class="status-icon pending" aria-hidden="true">⏳</span>
      <div><span class="status-label">Em análise</span><p>Sua solicitação está aguardando análise do ADM.</p></div>
    <?php elseif ($solicitacao && $solicitacao['status'] === 'aprovada'): ?>
      <span class="status-icon approved" aria-hidden="true">✓</span>
      <div><span class="status-label">Acesso aprovado</span><p>Sua solicitação foi aprovada. Atualize a sessão para acessar as permissões de editor.</p></div>
    <?php else: ?>
      <span class="status-icon ready" aria-hidden="true">!</span>
      <div><span class="status-label">Tudo pronto?</span><p><?= $solicitacao && $solicitacao['status'] === 'recusada' ? 'A solicitação anterior foi recusada. Você pode enviar uma nova análise.' : 'Envie sua solicitação e aguarde o retorno da administração.' ?></p></div>
    <?php endif; ?>
    </div>
    <?php if (!$solicitacao || $solicitacao['status'] === 'recusada'): ?>
      <form class="access-request-actions" method="post" action="../php/solicitar-moderador.php">
        <button class="primary-action" type="submit">Enviar solicitação <span>→</span></button>
      </form>
    <?php endif; ?>
    <a class="text-link access-back-link" href="./painel.php">← Voltar ao painel</a>
  </section>
</main>
</body>
</html>