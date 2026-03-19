<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}

$file="dados/servidores.json";

if(!file_exists($file)){
    file_put_contents($file,"[]");
}

$servidores=json_decode(file_get_contents($file),true);
?>

<html lang="pt-br">
<head>
    <title>Inventário de Servidores</title>
    <link rel="stylesheet" href="css/style-servidores.css">
</head>

<body>

<?php include 'navbar.php'; ?> <!-- Navbar adicionada -->

<div class="container">

    <h1>Inventário de Servidores GACC-BA</h1>

    <form action="actions/add_servidores.php" method="post" class="form-add">
        <input name="nome" placeholder="Nome do servidor" required>
        <input name="ip" placeholder="IP" required>
        <input name="funcao" placeholder="Função" required>
        <button type="submit">Adicionar</button>
    </form>

    <br>

    <table>
        <tr>
            <th>Nome</th>
            <th>IP</th>
            <th>Função</th>
            <th>Ação</th>
        </tr>
        <?php foreach($servidores as $id=>$srv){ ?>
        <tr>
            <td><?php echo $srv['nome']?></td>
            <td><?php echo $srv['ip']?></td>
            <td><?php echo $srv['funcao']?></td>
            <td>
            <a class="delete" href="actions/delete_servidores.php?id=<?php echo $id ?>">Remover</a>
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