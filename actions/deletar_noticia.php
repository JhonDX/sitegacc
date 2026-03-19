<?php
session_start();

if (!isset($_SESSION['user'])) {
    exit("Acesso negado");
}

$arquivo = __DIR__ . '/../dados/noticias.json';

if (!file_exists($arquivo)) {
    exit("Arquivo não encontrado");
}

$noticias = json_decode(file_get_contents($arquivo), true);
if (!$noticias) $noticias = [];

$id = $_GET['id'] ?? null;

if (!$id) {
    exit("ID inválido");
}

// 🔥 Remove imagem também
foreach ($noticias as $n) {
    if ($n['id'] == $id && !empty($n['imagem'])) {
        $caminho = __DIR__ . '/../' . $n['imagem'];
        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }
}

// Remove do array
$noticias = array_filter($noticias, function ($n) use ($id) {
    return $n['id'] != $id;
});

// Reorganiza array
$noticias = array_values($noticias);

// Salva
file_put_contents($arquivo, json_encode($noticias, JSON_PRETTY_PRINT));

// Volta pro admin
header("Location: ../admin_noticias.php");
exit;