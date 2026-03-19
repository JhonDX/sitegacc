<?php

$arquivo = __DIR__ . '/dados/noticias.json';
$noticias = json_decode(file_get_contents($arquivo), true);

$id = $_GET['id'] ?? null;
$noticia = null;

foreach ($noticias as $n) {
    if ($n['id'] == $id) {
        $noticia = $n;
        break;
    }
}

if (!$noticia) {
    echo "Notícia não encontrada";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title><?php echo $noticia['titulo']; ?></title>
</head>

<body style="font-family: Arial; max-width:800px; margin:auto;">

<a href="index.php">⬅ Voltar</a>

<h1><?php echo $noticia['titulo']; ?></h1>

<img src="<?php echo $noticia['imagem']; ?>" style="width:100%; border-radius:10px;">

<p style="margin-top:20px;">
<?php echo nl2br(htmlspecialchars($noticia['conteudo'])); ?>
</p>

<hr>

<p><strong>Autor:</strong> <?php echo $noticia['autor']; ?></p>
<p><strong>Data:</strong> <?php echo $noticia['data']; ?></p>

</body>
</html>