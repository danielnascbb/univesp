<?php

include "inc_conn.php";
$acao = $_POST["acao"];

if ($acao == "gravar") {
    $id_turma = $_POST["id_turma"];
    $id_aula = $_POST["id_aula"];
    $data_prevista = $_POST["data_prevista"];

    //Verifica se data é válida
    if (strlen($data_prevista) < 10) {
        echo "Data inválida.";
        exit;
    }

        $data_temp = explode("/", $data_prevista);

        $dia = $data_temp[0];
        $mes = $data_temp[1];
        $ano = $data_temp[2];
   
    if(checkdate($mes, $dia, $ano) == false) {
    echo 'Data inválida';
    exit;
    }
    //-------------------------

    $data_prevista = str_replace("/", "-", $data_prevista);
    $sql = mysqli_query($conn, "INSERT INTO vinculos_aulas_turmas (id_turma, id_aula, data_prevista) VALUES ('".$id_turma."', '".$id_aula."', STR_TO_DATE('".$data_prevista."','%d-%m-%Y'))");
    
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

}

include "inc_conn_close.php";
?>