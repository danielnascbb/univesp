<?php
include 'inc_conn.php';

$ip = $_SERVER['REMOTE_ADDR'];
$datahora = date("Y-m-d H:i:s");
$funcao = $_POST['funcao'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if ($funcao == "") {
    exit ("Falha de login");
    }
    
if ($funcao == "login") {

    // Login teste
    if ($email == 'univesp' and $senha == '1234'){
        $_SESSION['id_logado'] = '1';
        $_SESSION['nome_logado'] = 'Teste';
        $_SESSION['email_logado'] = 'teste@teste.com.br';
                         
        header('location:index.php');
    exit;
    }
    
	$senha = md5($senha);
	
	//Verifica email e senha
	$sql = "SELECT id, nome, email FROM usuario where email='".$email."' and senha='".$senha."'"; 
    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) );
    $total = mysqli_num_rows($dados);

    if ($total > 1) {
    exit ("Falha de login");
    }

    if ($total == 0) {
        header('location:login.php?msg=errologin');
    }
       
     while ($row = mysqli_fetch_array($dados))
                         {
                                           
                         $_SESSION['id_logado'] = $row['id'];
                         $_SESSION['nome_logado'] = $row['nome'];
                         $_SESSION['email_logado'] = $row['email'];
                         
                         header('location:index.php');

                         }
    
    //--------------------------------------------------

	
}
     
?>