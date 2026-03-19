<?php
session_start();

if (!isset($_SESSION['user'])) {
    exit("Acesso negado");
}

$arquivo = 'dados/noticias.json';

// Garante que o arquivo existe
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, '[]');
}

// Carrega notícias
$noticias = json_decode(file_get_contents($arquivo), true);
if (!$noticias) $noticias = [];

// Dados do form
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];

// ===== UPLOAD IMAGEM =====
if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

$nomeImagem = time() . "_" . basename($_FILES['imagem']['name']);
$caminho = "uploads/" . $nomeImagem;

// Move arquivo
if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
    die("Erro ao enviar imagem");
}

// Nova notícia
$noticias[] = [
    "titulo" => $titulo,
    "conteudo" => $conteudo,
    "imagem" => $caminho
];

// Salva JSON
file_put_contents($arquivo, json_encode($noticias, JSON_PRETTY_PRINT));

header("Location: admin_noticias.php");
exit;