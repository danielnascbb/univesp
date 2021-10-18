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
    $sql = "select * from turmas where id=$id and id_usuario=$id_logado";
    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
    $total = mysqli_num_rows($dados);
    
    while ($row =  mysqli_fetch_array($dados)) {
        $nome_turma = $row['nome_turma'];
        $id_instituicao = $row['id_instituicao'];
        $data_turma = inverteData($row['data_inicio_aulas']);
    }

}

if (!isset ($nome_turma)){
    $nome_turma = '';
}

if (!isset ($data_turma)){
    $data_turma = '';
}

//Busca instituições do usuário
$sql = "SELECT * FROM instituicao WHERE id_usuario = '$id_logado' ORDER BY nome_instituicao";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);
		
?>
<div class="container" style="width: 50%;">
    <div class="col-12">
        <form action="turmas_gravar.php" method="post" enctype="multipart/form-data" id="form_turmas" >
            <div class="form-group row">
               <div for="FormControlSelect1" class="col-md-4 col-form-label">Instituição:</div>
               <select name="id_instituicao" class="form-control col-md-8" id="instituicao">
                  <?
                  $count = 0;
                  //Loop de instituições
                  while ($row = mysqli_fetch_array($dados))
                  {   
                    $count = $count + 1;               
                    $r_id = $row['id'];
                    $r_nome_instituicao = $row['nome_instituicao'];
                    
                    $selected = '';
                    if ($id_instituicao == $r_id) {
                        $selected = 'selected';
                    } else if ($count == 1 and $id_instituicao == '') {
                        $selected = 'selected';
                    }
                  
                  ?>
                     <option value="<?=$r_id;?>" <?=$selected;?>><?=$r_nome_instituicao;?></option>
                  <?
                  }
                  ?>
               </select>
            </div>
            <div class="form-group row">
                <div class="col-md-4 col-form-label">Nome da turma:</div>
                <input type="text" class="form-control col-md-8" id="nome" name="nome" placeholder="Nome" value="<?=$nome_turma;?>">
            </div>
            <div class="form-group row">
                <div class="col-md-4 col-form-label">Início das aulas:</div>
                <input type="text" class="form-control col-md-8" id="data_inicio" name="data_inicio" placeholder="dd/mm/aaaa" value="<?=$data_turma;?>">
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

<script type="text/javascript">
    $("#data_inicio").mask("00/00/0000");
</script>