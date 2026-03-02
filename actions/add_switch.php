<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}

// Recebe os dados do formulário
$nome = $_POST['nome'];
$ip = $_POST['ip'];
$funcao = $_POST['funcao'];

// Caminho do arquivo JSON
$file = "../dados/switches.json";

// Cria o arquivo se não existir
if(!file_exists($file)){
    file_put_contents($file, "[]");
}

// Lê os dados existentes
$servidores = json_decode(file_get_contents($file), true);

// Adiciona novo servidor
$servidores[] = [
    "nome" => $nome,
    "ip" => $ip,
    "funcao" => $funcao
];

// Salva de volta no JSON
file_put_contents($file, json_encode($servidores, JSON_PRETTY_PRINT));

// Redireciona de volta para a página de servidores
header("Location: ../switches.php");
exit;
?>