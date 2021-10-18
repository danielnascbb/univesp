<?php

include "inc_conn.php";
$acao = $_POST["acao"];

if ($acao == "gravar") {
    $nome = $_POST["nome"];

    //Verifica nome vazio
    if($nome == ''){
        echo "Nome da aula obrigatório.";
        exit;
    }

    $sql = mysqli_query($conn, "INSERT INTO aulas (id_usuario, nome_aula) VALUES ('".$id_logado."', '".$nome."')");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "ok";
    }


} else if ($acao == "editar") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];

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

    $sql = mysqli_query($conn, "UPDATE aulas SET nome_aula = '$nome' where id=$id and id_usuario=$id_logado");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "ok2";
    }


} else if ($acao == "deletar") {
    $id = $_POST["id"];

    $sql = mysqli_query($conn, "DELETE from aulas where id=$id and id_usuario=$id_logado");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "Registro excluído com sucesso!";
    }

}

include "inc_conn_close.php";
?>