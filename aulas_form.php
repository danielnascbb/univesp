<?php

if(isset ($_POST['id'])) {
    $id = $_POST["id"];
} else {
    $id = '';
}

$id_instituicao = '';


include "inc_conn.php";

if ($id != "") {

    //Busca turmas do usuário
    $sql = "select * from aulas where id=$id and id_usuario=$id_logado";
    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
    $total = mysqli_num_rows($dados);
    
    while ($row =  mysqli_fetch_array($dados)) {
        $nome_aula = $row['nome_aula'];
    }

}

if (!isset ($nome_aula)){
    $nome_aula = '';
}
	
?>
<div class="container" style="width: 50%;">
    <div class="col-12">
        <form action="turmas_gravar.php" method="post" enctype="multipart/form-data" id="form_aulas" >
            <div class="form-group row">
                <div class="col-md-4 col-form-label">Nome da aula:</div>
                <input type="text" class="form-control col-md-8" id="nome" name="nome" placeholder="Nome" value="<?=$nome_aula;?>">
            </div>
            <div class="form-group row align-items-center">
                <div class="col-md-4">&nbsp;</div>    
                <div class="col-md-8">
                    <button type="button" class="btn btn-success m-2" onclick="gravar()">Gravar</button>
                    <button type="button" class="btn btn-danger m-2" onclick="cancelar()">Cancelar</button>
                </div>
            </div>
            <input type="hidden" id="id" name="id" value="<?=$id;?>">
            <input type="hidden" id="acao" name="acao" value="">
        </form>
    </div>
</div>
<?php
include "inc_conn_close.php";

?>