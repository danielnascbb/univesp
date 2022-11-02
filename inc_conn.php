<?php
date_default_timezone_set('America/Sao_Paulo');

function inverteData($data){
  if(count(explode("/",$data)) > 1){
      return implode("-",array_reverse(explode("/",$data)));
  }elseif(count(explode("-",$data)) > 1){
      return implode("/",array_reverse(explode("-",$data)));
  }
}

//dados conexão gamepl;
//$servername = "localhost";
//$username = "gamepl45_univesp";
//$password = "Univesp2021";
//$database = "gamepl45_teacherbinderdb";

//dados conexão local;
$servername = "localhost";
$username = "root";
$password = "univesp";
$database = "teacherbinderdb";

// Create connection
$conn = mysqli_connect($servername,$username,$password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

//inicia sessão
session_start();

//ver sessão aberta
$sessao = 'NAO';
  
if(isset ($_SESSION['id_logado']))
  {
  $id_logado = $_SESSION['id_logado'];
  $nome_logado= $_SESSION['nome_logado'];
  $email_logado= $_SESSION['email_logado'];
  $primeironome_logado = explode(" ", $nome_logado);
  $primeironome_logado = $primeironome_logado[0];

  $sessao = 'SIM';
  }
  
?>