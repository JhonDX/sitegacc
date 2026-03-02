<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
?>

<h2>Lista de Servidores</h2>

<table border="1">
<tr>
<th>Nome</th>
<th>IP</th>
<th>Função</th>
</tr>

<tr>
<td>srv-ad01</td>
<td>10.10.10.1</td>
<td>Active Directory</td>
</tr>

<tr>
<td>srv-db01</td>
<td>10.10.10.2</td>
<td>Banco de Dados</td>
</tr>

</table>

<br>

<a href="logout.php">Sair</a>