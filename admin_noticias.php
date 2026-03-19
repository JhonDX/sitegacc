<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Admin Notícias</title>

<link rel="stylesheet" href="css/style-global.css">
<link rel="stylesheet" href="css/admin-noticias.css">
</head>

<body>

<div class="container">

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Gerenciar Notícias</h2>

    <div>
        <a href="logout.php" class="btn logout">Sair</a>
    </div>
</div>


<form action="actions/salvar_noticia.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titulo" placeholder="Título" required>
    
    <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
    
    <input type="file" name="imagem" required>
    
    <button type="submit">Salvar</button>
</form>

<hr>

<h3>Notícias cadastradas</h3>

<?php foreach ($noticias as $n): ?>
    <div class="noticia">
        <h4><?= htmlspecialchars($n['titulo']) ?></h4>
        <img src="<?= $n['imagem'] ?>">
        <p><?= htmlspecialchars($n['conteudo']) ?></p>
    </div>
<?php endforeach; ?>

</div>

</body>
</html>