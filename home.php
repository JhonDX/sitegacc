<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}
?>

<html lang="pt-br">
<head>
    <title>Painel TI</title>
    <link rel="stylesheet" href="css/style-home.css">
</head>

<body>

<?php include 'navbar.php'; ?> <!-- Navbar centralizada -->

<div class="container">
    <h1>Portal de Infraestrutura</h1>
    <p>Bem-vindo ao painel de documentação e inventário da infraestrutura.</p>
</div>

</body>
</html>