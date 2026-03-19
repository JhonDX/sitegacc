<?php
session_start();
require_once 'env.php';

// carregar notícias
$arquivoNoticias = 'dados/noticias.json';

if (!file_exists($arquivoNoticias)) {
    file_put_contents($arquivoNoticias, '[]');
}

$noticias = json_decode(file_get_contents($arquivoNoticias), true);
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
</style>

</head>

<body>

<div class="topbar">
    <div><strong>Painel de Infraestrutura</strong></div>
    
    <div class="menu">
        <a href="#">Home</a>
        <a href="<?php echo $_ENV['DOCUMENTACAO_URL']; ?>" target="_blank">Documentação</a>
        <a href="<?php echo $_ENV['CHAMADOS_URL']; ?>" target="_blank">Chamados</a>
        <a href="login_noticias.php">Administrar Notícias</a>
        <a href="login.php">Área da TI 🔐</a>
    </div>
</div>

<div class="container">

    <!-- BOAS VINDAS -->
    <div class="info-box">
        <h2>Bem-vindo 👋</h2>
        <p>Este é o portal da infraestrutura. Para acessar sistemas internos, entre na área da TI.</p>
    </div>

    <!-- SISTEMAS -->
    <h2>Sistemas</h2>

    <div class="cards">

        <div class="card">
            <h3>Zabbix</h3>
            <p>Monitoramento de infraestrutura</p>
            <a href="<?php echo $_ENV['ZABBIX_URL']; ?>" target="_blank">Acessar</a>
        </div>

        <div class="card">
            <h3>GLPI</h3>
            <p>Gestão de chamados</p>
            <a href="<?php echo $_ENV['CHAMADOS_URL']; ?>" target="_blank">Acessar</a>
        </div>

        <div class="card">
            <h3>Grafana</h3>
            <p>Dashboards e métricas</p>
            <a href="<?php echo $_ENV['GRAFANA_URL']; ?>" target="_blank">Acessar</a>
        </div>

        <div class="card">
            <h3>Backup</h3>
            <p>Gerenciamento de backups</p>
            <a href="<?php echo $_ENV['BACKUP_URL']; ?>" target="_blank">Acessar</a>
        </div>

    </div>

    <!-- NOTÍCIAS -->
    <h2 style="margin-top:40px;">📰 Notícias</h2>

    <div class="cards">

        <?php if (!empty($noticias)): ?>
            <?php foreach (array_reverse($noticias) as $n): ?>
                <div class="card">
                    
                    <?php if (!empty($n['imagem'])): ?>
                        <img src="<?php echo $n['imagem']; ?>" class="noticia-img">
                    <?php endif; ?>

                    <h3><?php echo htmlspecialchars($n['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($n['conteudo']); ?></p>
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
            <li>🔧 Manutenção programada dia 20/03 às 22h</li>
            <li>📢 Novo procedimento de backup implantado</li>
            <li>⚠️ Atualização de segurança nos servidores Linux</li>
        </ul>
    </div>

</div>

</body>
</html>