<?php

include "inc_conn.php";
$acao = $_POST["acao"];

if ($acao == "gravar") {
    $nome = $_POST["nome"];

    if($nome == ''){
        echo "Nome da instituição obrigatório.";
        exit;
    }

    $sql = mysqli_query($conn, "INSERT INTO instituicao (id_usuario, nome_instituicao) VALUES ('".$id_logado."', '".$nome."')");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "ok";
    }


} else if ($acao == "editar") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];

    if($nome == ''){
        echo "Nome da instituição obrigatório.";
        exit;
    }

    if($id == ''){
        echo "Erro de parâmetros.";
        exit;
    }

    $sql = mysqli_query($conn, "UPDATE instituicao SET nome_instituicao = '$nome' where id=$id and id_usuario=$id_logado");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "ok2";
    }


} else if ($acao == "deletar") {
    $id = $_POST["id"];

    $sql = mysqli_query($conn, "DELETE from instituicao where id=$id and id_usuario=$id_logado");
    
    if(!$sql){
    echo "Erro: ".mysqli_error($conn);
    }else{
    echo "Registro excluído com sucesso!";
    }

}

include "inc_conn_close.php";
?>