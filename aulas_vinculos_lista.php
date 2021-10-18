<?php
include "inc_conn.php";

$id = $_POST['id'];
//$id = 1;

$sql = "select t.nome_turma as nome_turma, a.nome_aula as nome_aula, v.id as id_vinculo, v.data_prevista as data_prevista, v.data_efetiva as data_efetiva from turmas as t INNER JOIN vinculos_aulas_turmas as v ON t.id = v.id_turma INNER JOIN aulas as a ON a.id = v.id_aula where a.id=$id and a.id_usuario=$id_logado order by t.nome_turma";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

if ($total == 0): ?>
    <div class="container">
        <div class="col">
            <div class="row justify-content-center">
                <p class="h6">&nbsp;<br>Nenhuma turma vinculada nesta aula.</p>
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

    $nome_turma = $row['nome_turma'];
    $nome_aula = $row['nome_aula'];
    $id_vinculo = $row['id_vinculo'];
    $data_prevista = $row['data_prevista'];
    $data_efetiva = $row['data_efetiva'];

    if ($color == "bg-secondary") {
        $color = "bg-light";
    } else {
        $color = "bg-secondary";
    }
    ?>
    <div class="row <?=$color;?> align-items-center p-1">
        <div class="col-md-5">
            <div class="row">
            <p class="h6"><?=$nome_turma;?></font></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
            <p class="h6"><?=inverteData($data_prevista);?></font></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
            <p class="h6"><?=inverteData($data_efetiva);?></font></p>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
            <p class="h6"><input type="submit" onclick="remover('<?=$id_vinculo;?>')" class="btn btn-danger" value="Excluir"></p>
            </div>
        </div>
    </div>
    
<? } ?>
</div>
<?
include "inc_conn_close.php";
?>