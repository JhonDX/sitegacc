<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$file="dados/switches.json";

if(!file_exists($file)){
    file_put_contents($file,"[]");
}

$switches=json_decode(file_get_contents($file),true);
?>

<html lang="pt-br">
<head>
    <title>Inventário de Switches</title>
    <link rel="stylesheet" href="css/style-switches.css"> <!-- mesmo CSS dos servidores -->
</head>

<body>

<?php include 'navbar.php'; ?> <!-- Navbar reutilizável -->

<div class="container">

    <h1>Inventário de Switches GACC-BA</h1>

    <form action="actions/add_switch.php" method="post" class="form-add">
        <input name="nome" placeholder="Nome do Switch" required>
        <input name="ip" placeholder="IP" required>
        <input name="local" placeholder="Local / Sala" required>
        <button type="submit">Adicionar</button>
    </form>

    <br>

    <table>
        <tr>
            <th>Nome</th>
            <th>IP</th>
            <th>Local / Sala</th>
            <th>Ação</th>
        </tr>
        <?php foreach($switches as $id=>$sw){ ?>
        <tr>
            <td><?php echo $sw['nome']?></td>
            <td><?php echo $sw['ip']?></td>
            <td><?php echo $sw['local']?></td>
            <td>
                <a class="delete" href="actions/delete_switch.php?id=<?php echo $id ?>">Remover</a>
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