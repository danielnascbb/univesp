<?php

include "inc_conn.php";
$acao = $_POST["acao"];

if ($acao == "gravar") {
    $id_instituicao = $_POST["id_instituicao"];
    $nome = $_POST["nome"];
    $data_inicio = $_POST["data_inicio"];

    //Verifica nome vazio
    if($nome == ''){
        echo "Nome da turma obrigatório.";
        exit;
    }

    //Verifica se data é válida
    if (strlen($data_inicio) < 10) {
        echo "Data inválida.";
        exit;
    }

        $data_temp = explode("/", $data_inicio);

        $dia = $data_temp[0];
        $mes = $data_temp[1];
        $ano = $data_temp[2];
   
    if(checkdate($mes, $dia, $ano) == false) {
    echo 'Data inválida';
    exit;
    }
    //-------------------------

    $data_inicio = str_replace("/", "-", $data_inicio);
    $sql = mysqli_query($conn, "INSERT INTO turmas (id_usuario, id_instituicao, nome_turma, data_inicio_aulas) VALUES ('".$id_logado."', '".$id_instituicao."', '".$nome."', STR_TO_DATE('".$data_inicio."','%d-%m-%Y'))");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "ok";
    }


} else if ($acao == "editar") {
    $id = $_POST["id"];
    $id_instituicao = $_POST["id_instituicao"];
    $nome = $_POST["nome"];
    $data_inicio = $_POST["data_inicio"];

    //Verifica id de turma vazio
    if($id == ''){
        echo "Parâmetro Inválido.";
        exit;
    }

    //Verifica nome vazio
    if($nome == ''){
        echo "Nome da turma obrigatório.";
        exit;
    }

    //Verifica se data é válida
    if (strlen($data_inicio) < 10) {
        echo "Data inválida.";
        exit;
    }

        $data_temp = explode("/", $data_inicio);

        $dia = $data_temp[0];
        $mes = $data_temp[1];
        $ano = $data_temp[2];
   
    if(checkdate($mes, $dia, $ano) == false) {
    echo 'Data inválida';
    exit;
    }
    //-------------------------

    $data_inicio = str_replace("/", "-", $data_inicio);

    $sql = mysqli_query($conn, "UPDATE turmas SET nome_turma = '$nome', id_instituicao = '$id_instituicao', data_inicio_aulas = STR_TO_DATE('".$data_inicio."','%d-%m-%Y') where id=$id and id_usuario=$id_logado");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "ok2";
    }


} else if ($acao == "deletar") {
    $id = $_POST["id"];

    $sql = mysqli_query($conn, "DELETE from turmas where id=$id and id_usuario=$id_logado");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "Registro excluído com sucesso!";
    }

}

include "inc_conn_close.php";
?>