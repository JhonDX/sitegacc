<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login_noticias.php");
    exit;
}

// Carregar notícias
$arquivo = __DIR__ . '/dados/noticias.json';

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, '[]');
}

$noticias = json_decode(file_get_contents($arquivo), true);
if (!$noticias) $noticias = [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Admin Notícias</title>

<link rel="stylesheet" href="css/style-global.css">
<link rel="stylesheet" href="css/admin-noticias.css">

<style>
.noticia {
    border: 1px solid #ddd;
    padding: 15px;
    margin-top: 15px;
    border-radius: 8px;
    background: #fff;
}

.noticia img {
    width: 200px;
    border-radius: 6px;
    margin-top: 10px;
}

.btn-delete {
    display: inline-block;
    margin-top: 10px;
    background: #e74c3c;
    color: #fff;
    padding: 6px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
}

.btn-delete:hover {
    background: #c0392b;
}
</style>

</head>

<body>

<div class="container">

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Gerenciar Notícias</h2>

    <div>
        <a href="logout.php" class="btn logout">Sair</a>
    </div>
</div>

<!-- FORM -->
<form action="actions/salvar_noticia.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titulo" placeholder="Título" required>
    
    <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
    
    <input type="file" name="imagem" required>
    
    <button type="submit">Salvar</button>
</form>

<hr>

<h3>Notícias cadastradas</h3>

<?php if (!empty($noticias)): ?>
    <?php foreach (array_reverse($noticias) as $n): ?>
        <div class="noticia">
            
            <h4><?= htmlspecialchars($n['titulo']) ?></h4>

            <?php if (!empty($n['imagem'])): ?>
                <img src="<?= $n['imagem'] ?>">
            <?php endif; ?>

            <p><?= htmlspecialchars($n['conteudo']) ?></p>

            <p>
                <strong>Autor:</strong> <?= $n['autor'] ?? 'N/A' ?><br>
                <strong>Data:</strong> <?= $n['data'] ?? 'N/A' ?>
            </p>

            <!-- 🔥 BOTÃO EXCLUIR -->
            <a href="actions/deletar_noticia.php?id=<?= $n['id'] ?>"
               class="btn-delete"
               onclick="return confirm('Tem certeza que deseja excluir esta notícia?')">
               🗑 Excluir
            </a>

        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhuma notícia cadastrada.</p>
<?php endif; ?>

</div>

</body>
</html>