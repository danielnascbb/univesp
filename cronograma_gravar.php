<?php

include "inc_conn.php";
$acao = $_POST["acao"];

if ($acao == "gravar") {
    $id_vinculo = $_POST["id_vinculo"];
    $data_efetiva = $_POST["data_efetiva"];

    //Verifica se data é válida
    if (strlen($data_efetiva) < 10) {
        echo "Data inválida.";
        exit;
    }

        $data_temp = explode("/", $data_efetiva);

        $dia = $data_temp[0];
        $mes = $data_temp[1];
        $ano = $data_temp[2];
   
    if(checkdate($mes, $dia, $ano) == false) {
    echo 'Data inválida';
    exit;
    }
    //-------------------------

    $data_efetiva = str_replace("/", "-", $data_efetiva);
    $sql = mysqli_query($conn, "UPDATE vinculos_aulas_turmas SET data_efetiva = STR_TO_DATE('".$data_efetiva."','%d-%m-%Y') where id=$id_vinculo");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "ok";
    }

} else if ($acao == "deletar") {
    $id = $_POST["id"];

    $sql = mysqli_query($conn, "DELETE from vinculos_aulas_turmas where id=$id");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "Registro excluído com sucesso!";
    }

} else if ($acao == "reativar") {
    $id = $_POST["id"];

    $sql = mysqli_query($conn, "UPDATE vinculos_aulas_turmas SET data_efetiva = NULL where id=$id");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "Aula reativada.";
    }

}

include "inc_conn_close.php";
?>