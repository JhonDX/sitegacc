<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}

// Recebe os dados do formulário
$ponto = $_POST['ponto'];
$patch = $_POST['patch'];
$switch = $_POST['switch'];
$numero_vlan = $_POST['numero_vlan'];
$nome_vlan = $_POST['nome_vlan'];

// Caminho do arquivo JSON
$file = "../dados/pontos.json";

if(!file_exists($file)){
    file_put_contents($file,"[]");
}

$pontos = json_decode(file_get_contents($file), true);

// Adiciona novo ponto
$pontos[] = [
    "ponto" => $ponto,
    "patch" => $patch,
    "switch" => $switch,
    "numero_vlan" => $numero_vlan,
    "nome_vlan" => $nome_vlan
];

// Salva de volta no JSON
file_put_contents($file, json_encode($pontos, JSON_PRETTY_PRINT));

// Redireciona de volta para a página de pontos
header("Location: ../pontos.php");
exit;
?>