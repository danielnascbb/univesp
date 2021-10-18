<?php

if(isset ($_POST['id'])) {
    $id = $_POST["id"];
} else {
    $id = '';
}


include "inc_conn.php";

if ($id != "") {
    $sql = "select * from instituicao where id=$id";
    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
    $total = mysqli_num_rows($dados);
    
    while ($row =  mysqli_fetch_array($dados)) {
        $nome_instituicao = $row['nome_instituicao'];
    }

}

if (!isset ($nome_instituicao)){
    $nome_instituicao = '';
}

?>
<div class="col-12">
    <form action="instituicoes_gravar.php" method="post" enctype="multipart/form-data" id="form_instituicoes" >
        <div class="form-group row align-items-center">
            <label for="nome col-md-4 m-2">Nome da instituição:</label>
            <input type="text" class="form-control col-md-6 m-2" id="nome" name="nome" placeholder="Nome" value="<?=$nome_instituicao;?>">
            <button type="button" class="btn btn-success col-md-1 m-2" onclick="gravar()">Gravar</button>
            <button type="button" class="btn btn-danger col-md-1 m-2" onclick="cancelar()">Cancelar</button>
        </div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>">
        <input type="hidden" id="acao" name="acao" value="">
    </form>
</div>
<?php
include "inc_conn_close.php";

?>