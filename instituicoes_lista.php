<?php
include "inc_conn.php";

$sql = "select * from instituicao where id_usuario=$id_logado order by nome_instituicao";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

if ($total == 0): ?>
    <div class="container">
        <div class="col">
            <div class="row justify-content-center">
                <p class="h6">&nbsp;<br>Nenhuma instituição cadastrada.</p>
            </div>
        </div>
    </div>
<? endif; ?>

<div class="container">&nbsp;</div>
<div class="container">&nbsp;</div>
<div class="container" style="width: 100%;">


<?
$color = "bg-light";
while ($row =  mysqli_fetch_array($dados)) {

    $id_instituicao = $row['id'];
    $nome_instituicao = $row['nome_instituicao'];

    if ($color == "bg-secondary") {
        $color = "bg-light";
    } else {
        $color = "bg-secondary";
    }
    ?>
    <div class="row <?=$color;?> align-items-center p-1">
        <div class="col-md-8">
            <div class="row">
            <p class="h6"><?=$nome_instituicao;?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><input type="submit" onclick="editar('<?=$id_instituicao;?>')" class="btn btn-warning" value="Editar"></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><input type="submit" onclick="remover('<?=$id_instituicao;?>')" class="btn btn-danger" value="Excluir"></p>
            </div>
        </div>
    </div>

    
<? } ?>
</div>
<?
include "inc_conn_close.php";
?>

