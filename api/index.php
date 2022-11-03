<?php
include '../inc_conn.php';

$sql = "SELECT * FROM usuario order by nome"; 
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) );
$total = mysqli_num_rows($dados);

while ($row =  mysqli_fetch_array($dados)) {

    $id = $row['id'];
    $nome = $row['nome'];
?>

<p align='center'><a href='../api.php?id=<?= $id; ?>'><?= $nome; ?></a></p>

<?
}
?>