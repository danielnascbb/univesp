<?
header("Access-Control-Allow-Origin: *");
include_once 'inc_conn.php';

if (isset($_POST['efetivas'])) {
    $efetivas = $_POST['efetivas'];
} else {
    $efetivas = '';
}

$efetivas = $_POST['efetivas'];
$titulo = 'Cronograma de aulas previstas';
$link = '<a href="index.php?efetivas=SIM">Clique aqui para verificar as aulas já dadas</a>';

//Pesquisa cronograma de aulas a serem dadas
$sql = "select v.id as id_vinculo, t.nome_turma as turma, i.nome_instituicao as instituicao, a.nome_aula as aula, v.data_prevista as data from aulas as a INNER JOIN vinculos_aulas_turmas as v ON v.id_aula = a.id INNER JOIN turmas as t ON t.id = v.id_turma INNER JOIN instituicao as i ON i.id = t.id_instituicao where a.id_usuario=$id_logado and v.data_efetiva is null order by v.data_prevista";

$txt = 'Data prevista da aula';

if ($efetivas == 'SIM') {
//Pesquisa cronograma de aulas já dada
$sql = "select v.id as id_vinculo, t.nome_turma as turma, i.nome_instituicao as instituicao, a.nome_aula as aula, v.data_efetiva as data from aulas as a INNER JOIN vinculos_aulas_turmas as v ON v.id_aula = a.id INNER JOIN turmas as t ON t.id = v.id_turma INNER JOIN instituicao as i ON i.id = t.id_instituicao where a.id_usuario=$id_logado and v.data_efetiva is not null order by v.data_efetiva desc";

$txt = 'Data efetiva da aula';
$titulo = 'Cronograma de aulas efetivas';
$link = '<a href="index.php">Clique aqui para verificar as aulas previstas</a>';

}

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
    <? $txt_audio = 'Não há aulas cadastradas.'; ?>
    
<? else: ?>

    <div class="col">
    
    <p class="h2"><?= $titulo; ?> - <a href='#' onclick="getAudio()"><img src='img/audio-icon.png' height="25px" title="Transcrição em audio" /></a></p><br><div id="player"></div><br>
    <p class="h6"><?= $link; ?><br>&nbsp;</p><br>
    <p class="h6"><a target="_blank" href="relatorio.php">Clique aqui para gerar relatório de aulas</a><br>&nbsp;</p><br>

    <div class="row" id="formCronograma" style="display: none;">

    </div>

    <?
    if ($efetivas != 'SIM') {
        $txt_audio = 'Suas próximas aulas são: ';
    } else {
        $txt_audio = 'Suas últimas aulas foram: ';
    }
    ?>

</div>
<? endif; ?>

<div class="container" style="width: 100%;">

<div class="row bg-light align-items-center p-1">
        <div class="col-md-2">
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
            <p class="h6"><?= $txt; ?></p>
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
$count_audio = 0;
while ($row =  mysqli_fetch_array($dados)) {

    $id_vinculo = $row['id_vinculo'];
    $nome_turma = $row['turma'];
    $nome_aula = $row['aula'];
    $instituicao = $row['instituicao'];
    $data_prevista = $row['data'];

    $count_audio = $count_audio + 1;

    if ($count_audio <= 2) {
    $txt_audio = $txt_audio.'Instituição: '.$instituicao.', Turma: '.$nome_turma.', Aula: '.$nome_aula.', Data: '.inverteData($data_prevista).';';
    }

    if ($color == "bg-secondary") {
        $color = "bg-light";
    } else {
        $color = "bg-secondary";
    }
    ?>

<div class="container" style="width: 100%;">

<div class="row <?=$color;?> align-items-center p-1">
        <div class="col-md-2">
            <div class="row">
            <p class="h6"><?=$instituicao;?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
            <p class="h6"><?=$nome_turma;?></p>
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
                <? if ($efetivas == 'SIM') { ?>
                    <p class="h6"><input type="submit" onclick="reativar('<?=$id_vinculo;?>')" class="btn btn-primary" value="Reativar aula"></p>
                <? } else { ?>
                    <p class="h6"><input type="submit" onclick="editar('<?=$id_vinculo;?>')" class="btn btn-primary" value="Aula dada"></p>
                <? } ?>
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
//echo $txt_audio;
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
function getAudio(){
	jQuery.ajax({
		url:'get_audio.php',
		type:'post',
		data:'txt=<?= substr($txt_audio, 0, 240); ?>',
		success:function(result){
			jQuery('#player').html(result);
		}
	});
}
</script>