<?php

$id_vinculo = $_POST["id"];

include "inc_conn.php";

?>
<div class="container" style="width: 50%;">
    <div class="col-12">
        <form action="cronograma_gravar.php" method="post" enctype="multipart/form-data" id="form_cronograma" >
            <div class="form-group row">
                <div class="col-md-6 col-form-label">Data em que a aula foi dada:</div>
                <input type="text" class="form-control col-md-6" id="data_efetiva" name="data_efetiva" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group row align-items-center">
                <div class="col-md-4">&nbsp;</div>    
                <div class="col-md-8">
                    <button type="button" class="btn btn-success m-2" onclick="gravar()">Gravar</button>
                    <button type="button" class="btn btn-danger m-2" onclick="cancelar()">Cancelar</button>
                </div>
            </div>
            <input type="hidden" id="id_vinculo" name="id_vinculo" value="<?=$id_vinculo;?>">
            <input type="hidden" id="acao" name="acao" value="">
        </form>
    </div>
</div>
<?php
include "inc_conn_close.php";

?>

<script type="text/javascript">
    $("#data_efetiva").mask("00/00/0000");
</script>