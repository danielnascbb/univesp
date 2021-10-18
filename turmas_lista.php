<?php
include "inc_conn.php";

$sql = "select t.id as id, t.nome_turma as nome, t.data_inicio_aulas as data_inicio, i.nome_instituicao as instituicao from turmas as t INNER JOIN instituicao as i ON t.id_instituicao = i.id where t.id_usuario=$id_logado order by i.nome_instituicao, t.nome_turma";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

if ($total == 0): ?>
    <div class="container">
        <div class="col">
            <div class="row justify-content-center">
                <p class="h6">&nbsp;<br>Nenhuma turma cadastrada.</p>
            </div>
        </div>
    </div>
<? endif; ?>

<div class="container">&nbsp;</div>
<div class="container">&nbsp;</div>
<div class="container" style="width: 100%;">

<div class="row justify-content-center">
    <p class="h6">&nbsp;<br>Clique no nome da turma para vincular aulas à ela.</p>
</div>

<div class="row bg-light align-items-center p-1">
        <div class="col-md-4">
            <div class="row">
            <p class="h6">Turma</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            <p class="h6">Instituição</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">Início das aulas</p>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
            <p class="h6">&nbsp;</p>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
            <p class="h6">&nbsp;</p>
            </div>
        </div>
</div>


<?
$color = "bg-light";
while ($row =  mysqli_fetch_array($dados)) {

    $id_turma = $row['id'];
    $nome_turma = $row['nome'];
    $data_inicio = $row['data_inicio'];
    $instituicao = $row['instituicao'];

    if ($color == "bg-secondary") {
        $color = "bg-light";
    } else {
        $color = "bg-secondary";
    }
    ?>
    <div class="row <?=$color;?> align-items-center p-1">
        <div class="col-md-4">
            <div class="row">
            <p class="h6"><a href="turmas_vinculos.php?id=<?=$id_turma;?>"><font color="black"><?=$nome_turma;?></font></a></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            <p class="h6"><?=$instituicao;?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?=inverteData($data_inicio);?></p>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
            <p class="h6"><input type="submit" onclick="editar('<?=$id_turma;?>')" class="btn btn-warning" value="Editar"></p>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
            <p class="h6"><input type="submit" onclick="remover('<?=$id_turma;?>')" class="btn btn-danger" value="Excluir"></p>
            </div>
        </div>
    </div>

    
<? } ?>
</div>
<?
include "inc_conn_close.php";
?>

