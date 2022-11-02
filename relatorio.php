<?
include_once 'inc_conn.php';
?>
<html>

<head>
    <?
    include_once 'inc_head.php';
    ?>
</head>
<?
    //Pesquisa cronograma de aulas
    $sql = "select v.id as id_vinculo, t.nome_turma as turma, i.nome_instituicao as instituicao, i.id as id_instituicao, a.nome_aula as aula, v.data_prevista as data_prevista, v.data_efetiva as data_efetiva from aulas as a INNER JOIN vinculos_aulas_turmas as v ON v.id_aula = a.id INNER JOIN turmas as t ON t.id = v.id_turma INNER JOIN instituicao as i ON i.id = t.id_instituicao where a.id_usuario=$id_logado order by data_prevista";
    
    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
    $total = mysqli_num_rows($dados);

    if ($total == 0) {
        echo "Nenhuma aula encontrada.";
        exit;
    }

    ?>
    
<br><br><br>
<p align="center">Imprimir</p>
<br>
<div class="container" style="width: 100%;">

    <div class="row bg-light align-items-center p-1">
        <div class="col-md-3">
            <div class="row">
            <p class="h6">Instituição</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
            <p class="h6">Turma</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">Aula</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">Data Prevista</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6">Data Efetiva</p>
            </div>
        </div>
    </div>

</div>


    <?
    $array_instituicao = array();
    while ($row =  mysqli_fetch_array($dados)) {

        $array_instituicao[] = $row['id_instituicao'];

        $id_vinculo = $row['id_vinculo'];
        $nome_turma = $row['turma'];
        $nome_aula = $row['aula'];
        $instituicao = $row['instituicao'];
        $id_instituicao = $row['id_instituicao'];
        $data_prevista = inverteData($row['data_prevista']);
        $data_efetiva = $row['data_efetiva'];

        if ($data_efetiva == null){
            $data_efetiva = '-';
        } else {
            $data_efetiva = inverteData($data_efetiva);
        }
    ?>

<div class="container" style="width: 100%;">

    <div class="row bg-light align-items-center p-1">
        <div class="col-md-3">
            <div class="row">
            <p class="h6"><?= $instituicao; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
            <p class="h6"><?= $nome_turma; ?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?= $nome_aula; ?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?= $data_prevista; ?></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?= $data_efetiva; ?></p>
            </div>
        </div>
    </div>

</div>

<?
    }
?>

Resumo<Br><br>



<div class="container" style="width: 40%">

    <div class="row bg-light align-items-center p-1">
        <div class="col-md-8">
            <div class="row">
            <p class="h6">Instituição</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            <p class="h6">Qtd. de Aulas</p>
            </div>
        </div>
    </div>

</div>

<?

sort($array_instituicao);
$i = 0;
$id_anterior = 0;
$valor_anterior = 0;
$nome_instituicao = '';
foreach ($array_instituicao as $value) {
    $id_atual = $value;

    if ($id_atual != $id_anterior) {
        if ($id_anterior != $value and $id_anterior != 0): ?>

        <?   //Pesquisa instituicao
            $sql2 = "select nome_instituicao from instituicao where id=$id_anterior";
            
            $dados2 = mysqli_query($conn,$sql2) or die(' Erro na query:' . $sql2 . ' ' . mysqli_error($conn) ); 
            $total2 = mysqli_num_rows($dados2);

            while ($row2 =  mysqli_fetch_array($dados2)) {

                $nome_instituicao = $row2['nome_instituicao'];
            
            } ?>
            
            <div class="container" style="width: 40%;">

                <div class="row bg-light align-items-center p-1">
                    <div class="col-md-8">
                        <div class="row">
                        <p class="h6"><?= $nome_instituicao; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                        <p class="h6"><?= $i; ?></p>
                        </div>
                    </div>
                </div>

            </div>
            
        <?
        endif;
        $i = 1;
        
    } else {
        $i++;
    }
    
    $id_anterior = $value;
    
}

if ($i > 0) : ?>

        <?   //Pesquisa instituicao
            $sql2 = "select nome_instituicao from instituicao where id=$id_anterior";
            
            $dados2 = mysqli_query($conn,$sql2) or die(' Erro na query:' . $sql2 . ' ' . mysqli_error($conn) ); 
            $total2 = mysqli_num_rows($dados2);

            while ($row2 =  mysqli_fetch_array($dados2)) {

                $nome_instituicao = $row2['nome_instituicao'];
            
            } ?>
    
    <div class="container" style="width: 40%;">

        <div class="row bg-light align-items-center p-1">
            <div class="col-md-8">
                <div class="row">
                    <p class="h6"><?= $nome_instituicao; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                <p class="h6"><?= $i; ?></p>
                </div>
            </div>
        </div>
    </div>

<? endif; ?>

</html>