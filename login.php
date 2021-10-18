<?php
include 'inc_conn.php';

$logout = '';

if (isset($_GET['logout'])){
$logout = $_GET['logout'];
}

if ($logout == 'sim'){

    session_unset();
    session_destroy();
    header('location:index.php');
}

if ($sessao == 'SIM') {
   header('Location:index.php');
   exit;
}

if (isset($_GET['msg'])) {
$msg = $_GET['msg'];
} else {
$msg = "";
}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teacher Binder - Organizador Pedagógico Digital</title>

<script Language="JavaScript" Type="text/javascript">

function Form1_Validator(theForm)
{

  if (theForm.email.value.length < 1)
  {
    alert("Digite o e-mail.");
    theForm.email.focus();
    return (false);
  }
  
  if (theForm.senha.value.length < 1)
  {
    alert("Digite a senha.");
    theForm.senha.focus();
    return (false);
  }
  
  return (true);
}
</script>


<? include 'inc_head.php';?>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF">

<center> <!-- Corpo -->
<div class="container-fluid" style="width: 65%;">
  <div class="texto_principal"><font face="Verdana" color="#808080"><br>Login<br><br></font></div>
      
    <? if ($msg == 'errologin'){ ?>
	  <div align="center"><font face="Verdana" color="#FF0000">E-mail ou Senha inválidos.</font></div>
	  <? } ?>

    <? if ($msg == 'cadastrook'): ?>
	  <div align="center"><font face="Verdana" color="#FF0000">Cadastro efetuado com sucesso!</font></div>
	  <? endif; ?>

  <div class="col d-flex justify-content-center">
    <div class="row align-items-center">
    
        <div class="col">
          <form method="post" name="Form1" onsubmit="return Form1_Validator(this)" language="JavaScript" action="login_check.php">
            <div class="form-group row">
              <div align="left" class="col-md-4 col-form-label">E-mail ou Usuário:</div>
              <input class="form-control col-md-8" type="text" name="email" id="email" placeholder="email@email" size="20">
            </div>
			      <div class="form-group row align-items-center">
              <div align="left" class="col-md-4 col-form-label">Senha:</div>
              <input class="form-control col" type="password" name="senha" id="senha" placeholder="********" size="10">
                <div>
                <input type="submit" class="btn btn-primary m-2" name="I1" value="Logar">
                </div>
            </div>
			      <div align="left"><font face="Verdana" size="1" color="#808080"><a href="cadastro.php">Se não tem cadastro, clique aqui!</a></font></div>
            <input type="hidden" name="funcao" value="login">

            </form>

        
        </div>
        
    
    </div>
  </div>
</div>
</center>

<center> <!-- Rodapé -->
<div class="container-fluid" style="width: 70%;">
    <?php include 'inc_inferior.php'; ?>
</div>
</center>


</body>

</html>