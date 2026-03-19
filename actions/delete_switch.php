<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}

// Recebe o id do servidor a remover
$id = $_GET['id'] ?? null;

$file = "../dados/switches.json";

if(file_exists($file) && $id !== null){
    $servidores = json_decode(file_get_contents($file), true);
    unset($servidores[$id]);
    $servidores = array_values($servidores); // Reindexa o array
    file_put_contents($file, json_encode($servidores, JSON_PRETTY_PRINT));
}

// Redireciona de volta para a página de servidores
header("Location: ../switches.php");
exit;
?>