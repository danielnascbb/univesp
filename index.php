<?php

header("Access-Control-Allow-Origin: *");

include 'inc_conn.php';

if ($sessao != 'SIM') {
	header('Location: login.php');    
    exit;
}

$msg = '';

if (isset($_GET['msg'])) {
$msg = $_GET['msg'];
}

if (isset($_GET['efetivas'])) {
    $efetivas = 'SIM';
} else {
    $efetivas = 'NAO';
}

if ($msg == 1){
    $msg = 'Você deve cadastrar a instituição de ensino antes de cadastrar turmas.';
}

if ($msg == 2){
    $msg = 'Você deve cadastrar turma antes de vincular aula.';
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
    <? //include 'inc_cronograma.php'; 
    
    echo $msg.'<br><br>';

    ?>

    <div class="row" id="listaCronograma">

    </div>

</div>

</center>


<center> <!-- Rodapé -->
<div class="container-fluid" style="width: 70%;">
    <?php include 'inc_inferior.php'; ?>
</div>
</center>

<script>
    function editar(idv) {
        $.ajax({
            url:"cronograma_form.php",
            method: "post",
            type: "html",
            data : {
                id: idv
            }
        }).done(function (block) {
            $("#formCronograma").html(block).slideDown();
            $("#acao").val("gravar");
        });
    }
    function remover(idv) {
        if (confirm("Deseja realmente excluir este registro?")) {
            //alert(idv);
            $.ajax({
                url: "cronograma_gravar.php",
                method: "post",
                type: "html",
                data: {
                    id: idv,
                    acao: "deletar"
                }
            }).done(function (block) {
                alert(block);
                refresh('<?= $efetivas; ?>');
            });
        }
    }
    function refresh(parametro) {
        $.ajax({
            url:"cronograma_lista.php",
            type: "html",
            method: "post",
            data: {
                efetivas: parametro
            }
        }).done(function (block) {
            $("#listaCronograma").html(block);
        });
    }
    function gravar() {
        var form = $('#form_cronograma').ajaxSubmit({url: 'cronograma_gravar.php', type: 'post'});
        var xhr = form.data('jqxhr');
        xhr.done(function(data) {

            if (data == 'ok') {
                alert('Inclusão feita com sucesso!');
                $("#formCronograma").slideUp();
                refresh('<?= $efetivas; ?>');
            } else if (data == 'ok2') {

                alert('Registro alterado com sucesso!');
                $("#formCronograma").slideUp();
                refresh('<?= $efetivas; ?>');
            } else {
                alert(data);
            }
                        
        });
    }
    function cancelar() {
        $("#formCronograma").slideUp();
    }
    refresh('<?= $efetivas; ?>');

</script>

</body>

</html>