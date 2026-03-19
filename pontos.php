<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}

// Arquivo JSON para salvar os pontos tecnológicos
$file = "dados/pontos.json";

if(!file_exists($file)){
    file_put_contents($file,"[]");
}

$pontos = json_decode(file_get_contents($file), true);
?>

<html lang="pt-br">
<head>
    <title>Inventário de Pontos Tecnológicos</title>
    <link rel="stylesheet" href="css/style-pontos.css"> <!-- mesmo CSS dos servidores -->
</head>

<body>

<?php include 'navbar.php'; ?> <!-- Navbar reutilizável -->

<div class="container">

    <h1>Inventário de Pontos Tecnológicos GACC-BA</h1>

    <form action="actions/add_ponto.php" method="post" class="form-add">
        <input name="ponto" placeholder="Nome do Ponto" required>
        <input name="patch" placeholder="Patch Panel" required>
        <input name="switch" placeholder="Switch" required>
        <input name="numero_vlan" placeholder="Número da VLAN" required>
        <input name="nome_vlan" placeholder="Nome da VLAN" required>
        <button type="submit">Adicionar</button>
    </form>

    <br>

    <table>
        <tr>
            <th>PONTO</th>
            <th>PATCH PANEL</th>
            <th>SWITCH</th>
            <th>NÚMERO DA VLAN</th>
            <th>NOME DA VLAN</th>
            <th>AÇÃO</th>
        </tr>
        <?php foreach($pontos as $id => $ponto){ ?>
        <tr>
            <td><?php echo $ponto['ponto']; ?></td>
            <td><?php echo $ponto['patch']; ?></td>
            <td><?php echo $ponto['switch']; ?></td>
            <td><?php echo $ponto['numero_vlan']; ?></td>
            <td><?php echo $ponto['nome_vlan']; ?></td>
            <td>
                <a class="delete" href="actions/delete_ponto.php?id=<?php echo $id ?>">Remover</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

<footer>
    <a class="logout" href="logout.php">Sair</a>
</footer>

</body>
</html>