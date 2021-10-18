<?
header("Access-Control-Allow-Origin: *");
include_once 'inc_conn.php';

//Pesquisa cronograma de aulas
$sql = "select v.id as id_vinculo, t.nome_turma as turma, i.nome_instituicao as instituicao, a.nome_aula as aula, v.data_prevista as data_prevista from aulas as a INNER JOIN vinculos_aulas_turmas as v ON v.id_aula = a.id INNER JOIN turmas as t ON t.id = v.id_turma INNER JOIN instituicao as i ON i.id = t.id_instituicao where a.id_usuario=$id_logado and v.data_efetiva is null order by v.data_prevista";
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
    
<? else: ?>

    <div class="col">
    
    <p class="h2">Cronograma de aulas</p><br>

    <div class="row" id="formCronograma" style="display: none;">

    </div>

</div>
<? endif; ?>

<div class="container" style="width: 100%;">

<div class="row bg-light align-items-center p-1">
        <div class="col-md-3">
            <div class="row">
            <p class="h6">Turma</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">Instituição</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">Aula</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">Data</p>
            </div>
        </div>
        <div class="col-md-2">
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

</div>

<?
$color = "bg-light";
while ($row =  mysqli_fetch_array($dados)) {

    $id_vinculo = $row['id_vinculo'];
    $nome_turma = $row['turma'];
    $nome_aula = $row['aula'];
    $instituicao = $row['instituicao'];
    $data_prevista = $row['data_prevista'];

    if ($color == "bg-secondary") {
        $color = "bg-light";
    } else {
        $color = "bg-secondary";
    }
    ?>

<div class="container" style="width: 100%;">

<div class="row <?=$color;?> align-items-center p-1">
        <div class="col-md-3">
            <div class="row">
            <p class="h6"><?=$nome_turma;?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?=$instituicao;?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?=$nome_aula;?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?=inverteData($data_prevista);?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><input type="submit" onclick="editar('<?=$id_vinculo;?>')" class="btn btn-primary" value="Aula dada"></p>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
            <p class="h6"><input type="submit" onclick="remover('<?=$id_vinculo;?>')" class="btn btn-danger" value="Excluir"></p>
            </div>
        </div>
</div>

</div>
<?
}
include 'inc_conn_close.php';
?>