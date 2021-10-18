<?php
include 'inc_conn.php';

if ($sessao != 'SIM') {
	header('Location: login.php');    
    exit;
}

//Busca instituições do usuário
$sql = "SELECT id, nome_instituicao FROM instituicao WHERE id_usuario = $id_logado ORDER BY nome_instituicao";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

//Se não cadastrou instituição, redireciona para página principal com alerta
if ($total < 1) {
    header('Location: index.php?msg=1');    
    exit;
}

//Busca turmas do usuário - Tabela turmas com join da tabela instituição
$sql = "SELECT turma.id as id, turma.nome_turma as nome_turma, turma.data_inicio_aulas as data_aula, instituicao.nome_instituicao as nome_instituicao FROM turmas as turma INNER JOIN instituicao ON turma.id_instituicao = instituicao.id WHERE turma.id_usuario = $id_logado ORDER BY turma.nome_turma";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

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
    
        <p class="h2">Turmas</p><br>

        <div class="row" id="formTurmas" style="display: none;">

        </div>

    
        <div class="row justify-content-end">
            <input type="button" class="btn btn-success" value="Incluir" onclick="incluir()">
        </div>

        <div class="row" id="listaTurmas">

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
    function incluir() {
        $.ajax({
            url:"turmas_form.php",
            type: "html"
        }).done(function (block) {
            $("#formTurmas").html(block).slideDown();
            $("#acao").val("gravar");
        });
    }
    function editar(idv) {
        $.ajax({
            url:"turmas_form.php",
            method: "post",
            type: "html",
            data : {
                id: idv
            }
        }).done(function (block) {
            $("#formTurmas").html(block).slideDown();
            $("#acao").val("editar");
        });
    }
    function remover(idv) {
        if (confirm("Deseja realmente excluir este registro?")) {
            //alert(idv);
            $.ajax({
                url: "turmas_gravar.php",
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
            url:"turmas_lista.php",
            type: "html"
        }).done(function (block) {
            $("#listaTurmas").html(block);
        });
    }
    function gravar() {
        var form = $('#form_turmas').ajaxSubmit({url: 'turmas_gravar.php', type: 'post'});
        var xhr = form.data('jqxhr');
        xhr.done(function(data) {

            if (data == 'ok') {
                alert('Inclusão feita com sucesso!');
                $("#formTurmas").slideUp();
                refresh();
            } else if (data == 'ok2') {

                alert('Registro alterado com sucesso!');
                $("#formturmas").slideUp();
                refresh();
            } else {
                alert(data);
            }
                        
        });
    }
    function cancelar() {
        $("#formTurmas").slideUp();
    }
    refresh();

</script>

</body>

</html>