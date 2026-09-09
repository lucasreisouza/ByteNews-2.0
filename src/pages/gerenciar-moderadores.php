<?php
require_once __DIR__ . '/../php/autorizacao.php';
require_once __DIR__ . '/../php/conexao.php';

exigirTipo(['admin']);

$solicitacoes = $conexao->query("SELECT s.id_solicitacao, s.status, s.data_solicitacao, u.id_usuario, u.nome, u.email FROM solicitacoes_moderador s INNER JOIN usuarios u ON u.id_usuario = s.id_usuario ORDER BY FIELD(s.status, 'pendente', 'aprovada', 'recusada'), s.data_solicitacao DESC")->fetch_all(MYSQLI_ASSOC);
$moderadores = $conexao->query("SELECT id_usuario, nome, email, tipo_usuario FROM usuarios WHERE tipo_usuario = 'editor' ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
$usuarios = $conexao->query("SELECT id_usuario, nome, email, tipo_usuario, data_criacao FROM usuarios ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar moderadores | ByteNews</title>
  <link rel="stylesheet" href="../assets/CSS/style.css">
  <link rel="icon" href="../assets/icons/icone.png">
</head>

<body class="dark">

  <?php
  $headerBasePath = '../../';
  require __DIR__ . '/../php/header.php';
  ?>

  <main class="page-shell admin-shell">

    <section class="admin-hero">
      <div>
        <span class="eyebrow">CONTROLE DA COMUNIDADE</span>
        <h1>Gerenciar usuários</h1>
        <p>Aprove solicitações, organize moderadores e mantenha os acessos do ByteNews sob controle.</p>
      </div>
      <div class="admin-counter">
        <strong><?= count($usuarios) ?></strong>
        <span>contas<br>ativas</span>
      </div>
    </section>

    <section class="admin-overview">
      <article>
        <span class="overview-label">SOLICITAÇÕES</span>
        <strong><?= count(array_filter($solicitacoes, static fn ($item) => $item['status'] === 'pendente')) ?></strong>
        <span>aguardando análise</span>
      </article>
      <article>
        <span class="overview-label">MODERADORES</span>
        <strong><?= count($moderadores) ?></strong>
        <span>editores ativos</span>
      </article>
      <article>
        <span class="overview-label">ACESSO</span>
        <strong>ADM</strong>
        <span>nível atual da sessão</span>
      </article>
    </section>

    <section class="admin-section">
      <div class="admin-section-heading">
        <div>
          <span class="section-kicker">01 / Revisão</span>
          <h2>Solicitações de moderador</h2>
        </div>
        <span class="section-count"><?= count($solicitacoes) ?> registros</span>
      </div>

      <div class="request-list">
        <?php if (!$solicitacoes): ?>
          <div class="admin-empty">Nenhuma solicitação registrada.</div>
        <?php endif; ?>

        <?php foreach ($solicitacoes as $solicitacao): ?>
          <article class="request-row">
            <div class="user-avatar">
              <?= htmlspecialchars(strtoupper(substr($solicitacao['nome'], 0, 1))) ?>
            </div>
            <div class="user-info">
              <strong><?= htmlspecialchars($solicitacao['nome']) ?></strong>
              <span><?= htmlspecialchars($solicitacao['email']) ?></span>
            </div>
            <span class="status-badge status-<?= htmlspecialchars($solicitacao['status']) ?>">
              <?= htmlspecialchars($solicitacao['status']) ?>
            </span>

            <?php if ($solicitacao['status'] === 'pendente'): ?>
              <form method="post" action="../php/gerenciar-moderadores.php" class="inline-actions">
                <input type="hidden" name="id_solicitacao" value="<?= (int) $solicitacao['id_solicitacao'] ?>">
                <button class="approve-action" name="decisao" value="aprovada" type="submit">Aprovar</button>
                <button class="deny-action" name="decisao" value="recusada" type="submit">Recusar</button>
              </form>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="admin-section">
      <div class="admin-section-heading">
        <div>
          <span class="section-kicker">02 / Equipe</span>
          <h2>Moderadores atuais</h2>
        </div>
        <span class="section-count"><?= count($moderadores) ?> editores</span>
      </div>

      <div class="moderator-grid">
        <?php foreach ($moderadores as $moderador): ?>
          <article class="moderator-card">
            <div class="user-avatar">✦</div>
            <div class="user-info">
              <strong><?= htmlspecialchars($moderador['nome']) ?></strong>
              <span><?= htmlspecialchars($moderador['email']) ?></span>
            </div>
            <form method="post" action="../php/gerenciar-moderadores.php">
              <input type="hidden" name="id_usuario" value="<?= (int) $moderador['id_usuario'] ?>">
              <button class="remove-action" name="novo_tipo" value="leitor" type="submit">Remover acesso</button>
            </form>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="admin-section">
      <div class="admin-section-heading">
        <div>
          <span class="section-kicker">03 / Permissões</span>
          <h2>Usuários cadastrados</h2>
        </div>
        <span class="section-count"><?= count($usuarios) ?> contas</span>
      </div>

      <div class="user-table">
        <div class="user-table-head">
          <span>USUÁRIO</span>
          <span>CADASTRO</span>
          <span>PERFIL</span>
          <span>AÇÃO</span>
        </div>

        <?php foreach ($usuarios as $usuario): ?>
          <div class="user-table-row">
            <div class="user-table-name">
              <div class="user-avatar small-avatar">
                <?= htmlspecialchars(strtoupper(substr($usuario['nome'], 0, 1))) ?>
              </div>
              <div class="table-name">
                <strong><?= htmlspecialchars($usuario['nome']) ?></strong>
                <span><?= htmlspecialchars($usuario['email']) ?></span>
              </div>
            </div>

            <span class="table-date"><?= date('d.m.Y', strtotime($usuario['data_criacao'])) ?></span>
            <span class="role-status role-<?= htmlspecialchars($usuario['tipo_usuario']) ?>"><?= htmlspecialchars($usuario['tipo_usuario']) ?></span>

            <?php if ($usuario['tipo_usuario'] !== 'admin' && (int) $usuario['id_usuario'] !== (int) $_SESSION['id_usuario']): ?>
              <form method="post" action="../php/gerenciar-moderadores.php" class="role-form">
                <input type="hidden" name="id_usuario" value="<?= (int) $usuario['id_usuario'] ?>">
                <select name="novo_tipo" aria-label="Novo perfil de <?= htmlspecialchars($usuario['nome']) ?>">
                  <option value="leitor" <?= $usuario['tipo_usuario'] === 'leitor' ? 'selected' : '' ?>>Leitor</option>
                  <option value="editor" <?= $usuario['tipo_usuario'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                </select>
                <button type="submit">Atualizar</button>
              </form>
            <?php else: ?>
              <span class="protected-label">Protegido</span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <a class="back-home" href="./painel.php">← Voltar ao painel</a>

  </main>

</body>
</html>