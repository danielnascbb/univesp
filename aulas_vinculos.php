<?php
include 'inc_conn.php';

if ($sessao != 'SIM') {
	header('Location: login.php');    
    exit;
}

if (!isset($_GET['id'])){
    header('Location: aulas.php');    
    exit;
}

$id = $_GET['id'];

//Localiza nome da aula
$sql = "select nome_aula from aulas where id=$id and id_usuario=$id_logado";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

//Se não localizar aula, retorna para aulas
if ($total != 1) {
    header('Location: aulas.php');    
    exit;
}

while ($row =  mysqli_fetch_array($dados)) {

    $nome_aula = $row['nome_aula'];

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
    
        <p class="h5">Turmas vinculadas na aula: <?=$nome_aula;?></p><br>

        <div class="row" id="listaAulasVinculos">

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
            url:"aulas_vinculos_lista.php",
            method: "post",
            type: "html",
            data: {
                id: <?=$id;?>
            }
        }).done(function (block) {
            $("#listaAulasVinculos").html(block);
        });
    }

    refresh();

</script>

</body>

</html>