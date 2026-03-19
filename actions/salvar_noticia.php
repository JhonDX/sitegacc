<?php
session_start();

if (!isset($_SESSION['user'])) {
    exit("Acesso negado");
}

// Caminho correto (evita erro)
$arquivo = __DIR__ . '/../dados/noticias.json';

// Garante pasta e arquivo
if (!is_dir(__DIR__ . '/../dados')) {
    mkdir(__DIR__ . '/../dados', 0777, true);
}

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, '[]');
}

// Carrega notícias
$noticias = json_decode(file_get_contents($arquivo), true);
if (!$noticias) $noticias = [];

// Dados do form
$titulo = $_POST['titulo'] ?? '';
$conteudo = $_POST['conteudo'] ?? '';
$autor = $_SESSION['user']; // pega usuário logado

// ===== UPLOAD IMAGEM =====
$pastaUploads = __DIR__ . '/../uploads';

if (!is_dir($pastaUploads)) {
    mkdir($pastaUploads, 0777, true);
}

$nomeImagem = time() . "_" . basename($_FILES['imagem']['name']);
$caminhoRelativo = "uploads/" . $nomeImagem;
$caminhoFisico = $pastaUploads . "/" . $nomeImagem;

if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoFisico)) {
    die("Erro ao enviar imagem");
}

// Nova notícia
$noticias[] = [
    "id" => uniqid(),
    "titulo" => $titulo,
    "conteudo" => $conteudo,
    "imagem" => $caminhoRelativo,
    "autor" => $autor,
    "data" => date("d/m/Y H:i")
];

// Salva
file_put_contents($arquivo, json_encode($noticias, JSON_PRETTY_PRINT));

// Redireciona
header("Location: ../admin_noticias.php");
exit;