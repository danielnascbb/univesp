<?php
include 'inc_conn.php';

$ip = $_SERVER['REMOTE_ADDR'];
$datahora = date("Y-m-d H:i:s");
$funcao = $_POST['funcao'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if ($funcao == "") {
    exit ("Falha de cadastro");
    }
    
if ($funcao == "cadastro") {
    
	$senha = md5($senha);

    //Verifica email existente
  
    $sql = "SELECT email FROM usuario where email='".$email."'"; 
    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) );
    $total = mysqli_num_rows($dados);
    
    if( $total > 0 )
    {
    header('Location:cadastro.php?erro=1');
    exit();
    }
    
    //--------------------------------------------------

    $sql = mysqli_query($conn, "INSERT INTO usuario (nome, email, senha) VALUES ('".$nome."', '".$email."', '".$senha."')");
    
    if(!$sql){
    echo "Erro de processamento: ".mysqli_error($conn);
    }else{
       
    header('Location:login.php?msg=cadastrook');

    }

}
     
?>