<?php
include 'inc_conn.php';

if ($sessao != 'SIM') {
	header('Location: login.php');    
    exit;
}

//Busca aulas do usuário
$sql = "SELECT * from aulas WHERE id_usuario = $id_logado ORDER BY nome_aula";
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
    
        <p class="h2">Aulas</p><br>

        <div class="row" id="formAulas" style="display: none;">

        </div>

    
        <div class="row justify-content-end">
            <input type="button" class="btn btn-success" value="Incluir" onclick="incluir()">
        </div>

        <div class="row" id="listaAulas">

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
            url:"aulas_form.php",
            type: "html"
        }).done(function (block) {
            $("#formAulas").html(block).slideDown();
            $("#acao").val("gravar");
        });
    }
    function editar(idv) {
        $.ajax({
            url:"aulas_form.php",
            method: "post",
            type: "html",
            data : {
                id: idv
            }
        }).done(function (block) {
            $("#formAulas").html(block).slideDown();
            $("#acao").val("editar");
        });
    }
    function remover(idv) {
        if (confirm("Deseja realmente excluir este registro?")) {
            //alert(idv);
            $.ajax({
                url: "aulas_gravar.php",
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
            url:"aulas_lista.php",
            type: "html"
        }).done(function (block) {
            $("#listaAulas").html(block);
        });
    }
    function gravar() {
        var form = $('#form_aulas').ajaxSubmit({url: 'aulas_gravar.php', type: 'post'});
        var xhr = form.data('jqxhr');
        xhr.done(function(data) {

            if (data == 'ok') {
                alert('Inclusão feita com sucesso!');
                $("#formAulas").slideUp();
                refresh();
            } else if (data == 'ok2') {

                alert('Registro alterado com sucesso!');
                $("#formAulas").slideUp();
                refresh();
            } else {
                alert(data);
            }
                        
        });
    }
    function cancelar() {
        $("#formAulas").slideUp();
    }
    refresh();

</script>

</body>

</html>