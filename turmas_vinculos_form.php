<?php

$id_turma = $_POST["id_turma"];
$id_aula = $_POST["id_aula"];

include "inc_conn.php";

?>
<div class="container" style="width: 50%;">
    <div class="col-12">
        <form action="turmas_vinculos_gravar.php" method="post" enctype="multipart/form-data" id="form_turmas_vinculos" >
            <div class="form-group row">
                <div class="col-md-5 col-form-label">Data prevista para aula:</div>
                <input type="text" class="form-control col-md-7" id="data_prevista" name="data_prevista" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group row align-items-center">
                <div class="col-md-4">&nbsp;</div>    
                <div class="col-md-8">
                    <button type="button" class="btn btn-success m-2" onclick="gravar()">Gravar</button>
                    <button type="button" class="btn btn-danger m-2" onclick="cancelar()">Cancelar</button>
                </div>
            </div>
            <input type="hidden" id="id_aula" name="id_aula" value="<?=$id_aula;?>">
            <input type="hidden" id="id_turma" name="id_turma" value="<?=$id_turma;?>">
            <input type="hidden" id="acao" name="acao" value="">
        </form>
    </div>
</div>
<?php
include "inc_conn_close.php";

?>

<script type="text/javascript">
    $("#data_prevista").mask("00/00/0000");
</script>