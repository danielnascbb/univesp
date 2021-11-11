<?php
include 'inc_conn.php';

function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
    $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
    $nu = "0123456789"; // $nu contem os números
    //$si = "!@#$%¨&*()_+="; // $si contem os símbolos
    $si = "_"; // $si contem os símbolos

    $senha = '';
   
    if ($maiusculas){
          // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
          $senha .= str_shuffle($ma);
    }
   
    if ($minusculas){
          // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
          $senha .= str_shuffle($mi);
    }
   
    if ($numeros){
          // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
          $senha .= str_shuffle($nu);
    }
   
    if ($simbolos){
          // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
          $senha .= str_shuffle($si);
    }
   
      // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
      return substr(str_shuffle($senha),0,$tamanho);
}


$ip = $_SERVER['REMOTE_ADDR'];
$datahora = date("Y-m-d H:i:s");
$email = $_POST['email'];
$funcao = $_POST['funcao'];

if ($funcao == "") {
$funcao = $_GET['funcao'];
}

//Gera senha temporária e envia e-mail
if ($funcao == "1") {

    if ($email == "") {
    exit ("Erro de processamento!");
    }
                          
    //Verifica e-mail/usuario existente
    $sql = "SELECT id, email FROM usuario where email='".$email."'"; 
    $dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) );
    $total = mysqli_num_rows($dados);

    if ($total == 0)
    {
    header('Location:recupera_senha.php?msg=1');
    exit();
    }
    
    while ($row = mysqli_fetch_array($dados))
            {                                     
                  $r_id = $row['id'];   
                  $r_email = $row['email'];
            }
            
    
    $senha = gerar_senha(8, true, true, true, false);
    $senhacodificada = md5($senha);

    $sql = mysqli_query($conn, "UPDATE usuario SET senha = '$senhacodificada' WHERE id = $r_id");
    
    if(!$sql){
    echo "Erro de processamento: ".mysqli_error($conn);
    }else{
    
    $email_remetente = "noreply@gameplaydoboy.com.br"; 
    $email_destinatario = $r_email;
    $assunto = "Nova senha TeacherBinder";

    $cabecalho = 'MIME-Version: 1.0' . "\r\n";
    $cabecalho .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
    $cabecalho .= "Return-Path: $email_remetente \r\n";
    $cabecalho .= "From: $email_remetente \r\n";
    $cabecalho .= "Reply-To: $email_remetente \r\n";

    // Corpo do Email
	$mensagem .= "<p align='center'><br><br><br>Sua nova senha no TeacherBinder é: ".$senha.".</p>";

    // Envia o Email
    if(mail($email_destinatario, $assunto, $mensagem, $cabecalho))
    {
        $resposta = 'OK';
    }
    else
    {
        $resposta = 'ERRO';
    }
    
    if ($resposta == 'OK') {
    header('Location:recupera_senha.php?msg=ok');
    }
    else {
    echo "Erro no envio do e-mail.";
    exit;
    }
    }

}

?>