<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'] ?? null;
$file = "../dados/pontos.json";

if(file_exists($file) && $id !== null){
    $pontos = json_decode(file_get_contents($file), true);

    if(isset($pontos[$id])){
        unset($pontos[$id]);
        $pontos = array_values($pontos); // Reindexa
        file_put_contents($file, json_encode($pontos, JSON_PRETTY_PRINT));
    } else {
        die("Erro: ID não encontrado no JSON");
    }
}

// Redireciona de volta para a página de pontos
header("Location: ../pontos.php");
exit;
?>