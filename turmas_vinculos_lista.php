<?php
include "inc_conn.php";

$id = $_POST['id'];
//$id = 3;

//Busca aulas já vinculadas na turma
$sql = "select a.id as id_aula, a.nome_aula as nome_aula, v.id as id_vinculo, v.data_prevista as data_prevista from aulas as a INNER JOIN vinculos_aulas_turmas as v ON a.id = v.id_aula AND v.id_turma = '$id' order by a.nome_aula";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

//Busca aulas disponíveis para vínculo com a turma selecionada
$sql2 = "select a.id as id_aula, a.nome_aula as nome_aula from aulas as a WHERE NOT EXISTS (select * from vinculos_aulas_turmas where id_aula=a.id and id_turma=$id)";
$dados2 = mysqli_query($conn,$sql2) or die(' Erro na query:' . $sql2 . ' ' . mysqli_error($conn) ); 
$total2 = mysqli_num_rows($dados2);

if ($total == 0 and $total2 == 0): ?>
    <div class="container">
        <div class="col">
            <div class="row justify-content-center">
                <p class="h6">&nbsp;<br>Nenhuma aula disponível para vínculo.</p>
            </div>
        </div>
    </div>
<? endif; ?>


<div class="container">&nbsp;</div>
<div class="container">&nbsp;</div>
<div class="container" style="width: 60%;">

<?
$color = "bg-light";

$count = 0;
while ($row =  mysqli_fetch_array($dados)) {

    $count = $count + 1;

    $id_vinculo = $row['id_vinculo'];
    $nome_aula = $row['nome_aula'];
    $id_aula = $row['id_aula'];
    $data_prevista = $row['data_prevista'];

    if ($color == "bg-secondary") {
        $color = "bg-light";
    } else {
        $color = "bg-secondary";
    }
    ?>

    <? if ($count == 1): ?>
    <div class="container">
        <div class="col">
            <div class="row justify-content-center">
                <p class="h6">&nbsp;<br>Aulas já vinculadas na turma:</p>
            </div>
        </div>
    </div>
    <div class="row bg-light align-items-center p-1">
        <div class="col-md-6">
            <div class="row">
            <p class="h6">Aula</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            <p class="h6">Data Prevista</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">&nbsp;</p>
            </div>
        </div>
    </div>
    <? endif; ?>

    <div class="row <?=$color;?> align-items-center p-1">
        <div class="col-md-6">
            <div class="row">
            <p class="h6"><?=$nome_aula;?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            <p class="h6"><?=inverteData($data_prevista);?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><input type="submit" onclick="remover('<?=$id_vinculo;?>')" class="btn btn-danger" value="Excluir"></p>
            </div>
        </div>
    </div>
    
<? } ?>
</div>

<div class="container">&nbsp;</div>
<div class="container">&nbsp;</div>
<div class="container" style="width: 60%;">

<?
$color = "bg-light";

$count = 0;
while ($row =  mysqli_fetch_array($dados2)) {

    $count = $count + 1;

    $nome_aula = $row['nome_aula'];
    $id_aula = $row['id_aula'];

    if ($color == "bg-secondary") {
        $color = "bg-light";
    } else {
        $color = "bg-secondary";
    }
    ?>

    <? if ($count == 1): ?>
    <div class="container">
        <div class="col">
            <div class="row justify-content-center">
                <p class="h6">&nbsp;<br>Aulas disponíveis para vínculo na turma:</p>
            </div>
        </div>
    </div>
    <? endif; ?>

    <div class="row <?=$color;?> align-items-center p-1">
        <div class="col-md-10">
            <div class="row">
            <p class="h6"><?=$nome_aula;?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><input type="submit" onclick="incluir('<?=$id_aula;?>', '<?=$id;?>')" class="btn btn-primary" value="Vincular"></p>
            </div>
        </div>
    </div>
    
<? } ?>
</div>
<?
include "inc_conn_close.php";
?>