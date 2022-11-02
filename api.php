<?php
//API para estudo, simples, sem processo de autenticação para projeto integrador de curso de TI da Univesp;

include 'inc_conn.php';
$retorno = array();
$retorno['erro'] = false;

//Obrigatório, via requisição GET, o id do usuário a ser consultado;
if (!isset($_GET['id'])) {
    $retorno['erro'] = true;
    $retorno['msg']= 'Entrada obrigatória não declarada.';
} else {

    //id do usuário a ser consultado;
    $id = $_GET['id'];

    //Pesquisa cronograma de aulas a serem dadas
    $sql = "select v.id as id_vinculo, t.nome_turma as turma, i.nome_instituicao as instituicao, a.nome_aula as aula, v.data_prevista as data from aulas as a INNER JOIN vinculos_aulas_turmas as v ON v.id_aula = a.id INNER JOIN turmas as t ON t.id = v.id_turma INNER JOIN instituicao as i ON i.id = t.id_instituicao where a.id_usuario=$id and v.data_efetiva is null order by v.data_prevista";

    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
    $total = mysqli_num_rows($dados);

    if ($total == 0){
        //Muda variável erro para "true" quando não há resultados;
        $retorno['erro'] = true;
        $retorno['msg']= 'Nenhuma aula encontrada.';
    } else {

        $retorno['msg']= 'ok';

    }

    while ($row =  mysqli_fetch_array($dados)) {

        $retorno['aulas'][] = array(
            'id' => intval($row['id_vinculo']),
            'nome_turma' => $row['turma'],
            'nome_aula' => $row['aula'],
            'instituicao' => $row['instituicao'],
            'data_prevista' => $row['data']
        );

    }

}

echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
?>