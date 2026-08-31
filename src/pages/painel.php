<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Painel</title>
    <link rel="stylesheet" href="../css/style.css>
</head>
<body>
    <div class="container">
        <!-- O conteúdo virá aqui --> 
        <aside class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#">Meu Perfil</a></li>
                <li><a href="#">Meus Favoritos</a></li>
                <li><a href="#">Minhas Compras/a></li>
                <li><a href="../php/logout.php">Sair</a></li>
            </ul>
        </aside>
    </div> 
</body>
    <main class="content">
        <h1>Meu Perfil</h1>
        <p>Gerencie suas informações abaixo:</p>
        <!-- O formulário virá aqui -->
        <!-- Iniciando o formulário de atualização -->
         <form action="../php/dashboard.php" method="POST">

           <!-- Campos virão aqui -->

           <label>Nome:</label>
           <input type="text">
         </form>
    </main>
</html>