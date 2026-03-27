<?php
session_start();
require_once 'env.php';

$arquivoNoticias = __DIR__ . '/dados/noticias.json';

if (!file_exists($arquivoNoticias)) {
    file_put_contents($arquivoNoticias, '[]');
}

$noticias = json_decode(file_get_contents($arquivoNoticias), true);
if (!$noticias) $noticias = [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Painel de Infraestrutura</title>

<link rel="stylesheet" href="css/style-global.css">
<link rel="stylesheet" href="css/style-dashboard.css">

<style>
.noticia-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
}

/* 🔥 Corrige somente as notícias (sem afetar sistemas) */
.cards .card a {
    display: block;
    text-decoration: none;
    color: inherit;
    background: transparent;
}

.cards .card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: 0.2s;
}

.cards .card:hover {
    transform: translateY(-3px);
}
</style>

</head>

<body>

<div class="topbar">
    <div><strong>Painel do Gacc-BA</strong></div>
    
    <div class="menu">
        <a href="#">Home</a>
        <a href="<?php echo $_ENV['CHAMADOS_URL']; ?>" target="_blank">Chamados</a>
        <a href="login_noticias.php">Administrar Notícias</a>
        <a href="login.php">Administradores</a>
    </div>
</div>

<div class="container">

    <!-- BOAS VINDAS -->
    <div class="info-box">
        <h2>Bem-vindo</h2>
        <p>Este é o portal da infraestrutura. Para acessar sistemas internos, entre na área da TI.</p>
    </div>

    <!-- SISTEMAS -->
    <h2>Sistemas</h2>

    <div class="cards">
        <div class="card">
            <h3>GLPI</h3>
            <p>Gestão de chamados</p>
            <a href="<?php echo $_ENV['CHAMADOS_URL']; ?>" target="_blank" class="btn">Acessar</a>
        </div>

        <div class="card">
            <h3>Agenda</h3>
            <p>Gestão de Eventos</p>
            <a href="<?php echo $_ENV['EVENTOS_URL']; ?>" target="_blank" class="btn">Acessar</a>
        </div>

        <div class="card">
            <h3>Biblioteca</h3>
            <p>Biblioteca</p>
            <a href="<?php echo $_ENV['BIBLIOTECA_URL']; ?>" target="_blank" class="btn">Acessar</a>
        </div>

    </div>

    <!-- NOTÍCIAS -->
    <h2 style="margin-top:40px;">Notícias</h2>

    <div class="cards">

        <?php if (!empty($noticias)): ?>
            <?php foreach (array_reverse($noticias) as $n): ?>
                <div class="card">

                    <a href="noticia.php?id=<?php echo $n['id']; ?>">

                        <?php if (!empty($n['imagem'])): ?>
                            <img src="<?php echo $n['imagem']; ?>" class="noticia-img">
                        <?php endif; ?>

                        <h3><?php echo htmlspecialchars($n['titulo']); ?></h3>

                    </a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma notícia cadastrada.</p>
        <?php endif; ?>

    </div>

    <!-- INFORMATIVOS -->
    <h2 style="margin-top:40px;">Informativos</h2>

    <div class="info-box">
        <ul>
            <li>Manutenção programada dia 20/03 às 22h</li>
            <li>Novo procedimento de backup implantado</li>
            <li>Atualização de segurança nos servidores Linux</li>
        </ul>
    </div>

</div>

</body>
</html>