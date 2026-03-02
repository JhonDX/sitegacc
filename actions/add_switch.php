<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Caminho do arquivo JSON
$file = "../dados/switches.json";

// Cria o arquivo se não existir
if (!file_exists($file)) {
    file_put_contents($file, "[]");
}

// Lê os dados existentes
$switches = json_decode(file_get_contents($file), true);

// Recebe os dados do formulário (COM VALIDAÇÃO)
$nome  = $_POST['nome']  ?? null;
$ip    = $_POST['ip']    ?? null;
$local = $_POST['local'] ?? null;

if (!$nome || !$ip || !$local) {
    header("Location: ../switches.php?erro=campos");
    exit;
}

// Adiciona novo switch
$switches[] = [
    "nome"  => $nome,
    "ip"    => $ip,
    "local" => $local
];

// Salva de volta no JSON
file_put_contents($file, json_encode($switches, JSON_PRETTY_PRINT));

// Redireciona
header("Location: ../switches.php?sucesso=1");
exit;