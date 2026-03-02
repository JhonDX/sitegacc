<?php
// navbar.php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
?>

<nav class="navbar">
    <div class="logo">Painel TI</div>
    <ul class="menu">
        <li><a href="home.php">Home</a></li>

        <!-- Menu Inventário -->
        <li class="dropdown">
            <a href="#">Inventário</a>
            <ul class="submenu">
                <li><a href="servidores.php">Servidores</a></li>
                <li><a href="switches.php">Switches</a></li>
                <li><a href="pontos.php">Pontos Tecnológicos</a></li>
                <li><a href="roteadores.php">Roteadores</a></li>
                <li><a href="vlans.php">VLANs</a></li>
            </ul>
        </li>

        <!-- Novo menu Tutoriais -->
        <li class="dropdown">
            <a href="#">Tutoriais</a>
            <ul class="submenu">
                <li><a href="#">Tutoriais Salus</a></li>
                <li><a href="#">Outro Tutorial 1</a></li>
                <li><a href="#">Outro Tutorial 2</a></li>
            </ul>
        </li>

        <li class="logout-menu"><a href="logout.php">Sair</a></li>
    </ul>
    <link rel="stylesheet" href="css/style-navbar.css">
</nav>