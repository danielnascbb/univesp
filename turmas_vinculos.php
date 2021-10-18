<?php
include 'inc_conn.php';

if ($sessao != 'SIM') {
	header('Location: login.php');    
    exit;
}

if (!isset($_GET['id'])){
    header('Location: turmas.php');    
    exit;
}

$id = $_GET['id'];

//Localiza nome da aula
$sql = "select nome_turma from turmas where id=$id and id_usuario=$id_logado";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

//Se não localizar aula, retorna para aulas
if ($total != 1) {
    header('Location: turmas.php');    
    exit;
}

while ($row =  mysqli_fetch_array($dados)) {

    $nome_turma = $row['nome_turma'];

}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teacher Binder - Organizador Pedagógico Digital</title>
<?php include 'inc_head.php';?>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF">

<center> <!-- Topo -->
<Br>&nbsp;<br>
<div class="container-fluid" style="width: 70%;">
    <?php include 'inc_topo.php'; ?>
</div>
</center>


<center> <!-- Corpo -->
<Br>&nbsp;<br>
<div class="container-fluid" style="width: 80%;">

    <div class="col">
    
        <p class="h5">Vincular aula na turma: <?=$nome_turma;?></p><br>

        <div class="row" id="formTurmasVinculos">

        </div>

        <div class="row" id="listaTurmasVinculos">

        </div>
    
    </div>

</div>
</center>


<center> <!-- Rodapé -->
<div class="container-fluid" style="width: 70%;">
    <?php include 'inc_inferior.php'; ?>
</div>
</center>

<script>
    function incluir(id_aula, id_turma) {
        $.ajax({
            url:"turmas_vinculos_form.php",
            method: "post",
            type: "html",
            data : {
                id_aula: id_aula,
                id_turma: id_turma
            }
        }).done(function (block) {
            $("#formTurmasVinculos").html(block).slideDown();
            $("#acao").val("gravar");
        });
    }
    function remover(idv) {
        if (confirm("Deseja realmente excluir este registro?")) {
            //alert(idv);
            $.ajax({
                url: "turmas_vinculos_gravar.php",
                method: "post",
                type: "html",
                data: {
                    id: idv,
                    acao: "deletar"
                }
            }).done(function (block) {
                alert(block);
                refresh();
            });
        }
    }
    function refresh() {
        $.ajax({
            url:"turmas_vinculos_lista.php",
            method: "post",
            type: "html",
            data: {
                id: <?=$id;?>
            }
        }).done(function (block) {
            $("#listaTurmasVinculos").html(block);
        });
    }
    function gravar() {
        var form = $('#form_turmas_vinculos').ajaxSubmit({url: 'turmas_vinculos_gravar.php', type: 'post'});
        var xhr = form.data('jqxhr');
        xhr.done(function(data) {

            if (data == 'ok') {
                alert('Inclusão feita com sucesso!');
                $("#formTurmasVinculos").slideUp();
                refresh();
            }  else {
                alert(data);
            }
                        
        });
    }
    function cancelar() {
        $("#formTurmasVinculos").slideUp();
    }

    refresh();

</script>

</body>

</html>