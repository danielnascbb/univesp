<?php
include 'inc_conn.php';

if ($sessao != 'SIM') {
	header('Location: login.php');    
    exit;
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
<div class="container-fluid" style="width: 70%;">

    <div class="col">
    
        <p class="h2">Instituições</p><br>

        <div class="row" id="formInstituicoes" style="display: none;">

        </div>

    
        <div class="row justify-content-end">
            <input type="button" class="btn btn-success" value="Incluir" onclick="incluir()">
        </div>

        <div class="row" id="listaInstituicoes">

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
            url:"instituicoes_form.php",
            type: "html"
        }).done(function (block) {
            $("#formInstituicoes").html(block).slideDown();
            $("#acao").val("gravar");
        });
    }
    function editar(idv) {
        $.ajax({
            url:"instituicoes_form.php",
            method: "post",
            type: "html",
            data : {
                id: idv
            }
        }).done(function (block) {
            $("#formInstituicoes").html(block).slideDown();
            $("#acao").val("editar");
        });
    }
    function remover(idv) {
        if (confirm("Deseja realmente excluir este registro?")) {
            //alert(idv);
            $.ajax({
                url: "instituicoes_gravar.php",
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
            url:"instituicoes_lista.php",
            type: "html"
        }).done(function (block) {
            $("#listaInstituicoes").html(block);
        });
    }
    function gravar() {
        var form = $('#form_instituicoes').ajaxSubmit({url: 'instituicoes_gravar.php', type: 'post'});
        var xhr = form.data('jqxhr');
        xhr.done(function(data) {

            if (data == 'ok') {
                alert('Inclusão feita com sucesso!');
                $("#formInstituicoes").slideUp();
                refresh();
            } else if (data == 'ok2') {

                alert('Registro alterado com sucesso!');
                $("#formInstituicoes").slideUp();
                refresh();
            } else {
                alert(data);
            }
                        
        });
    }
    function cancelar() {
        $("#formInstituicoes").slideUp();
    }
    refresh();

</script>

</body>

</html>