<?
include 'inc_conn.php';

if ($sessao != 'SIM') {
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

  if (theForm.senha.value.length < 5)
  {
    alert("Digite a senha com, pelo menos, 5 caracteres.");
    theForm.senha.focus();
    return (false);
  }

  if (theForm.senha.value != theForm.senha2.value)
  {
    alert("Senhas não coincidem.");
    theForm.senha.focus();
    return (false);
  }
   
  return (true);
}
</script>


<?php include 'inc_head.php';?>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF">

<center> <!-- Topo -->
<Br>&nbsp;<br>
<div class="container-fluid" style="width: 70%;">
    <?php include 'inc_topo.php'; ?>
</div>
</center>

<center> <!-- Corpo -->
<div class="container-fluid" style="width: 65%;">
<div class="texto_principal"><font face="Verdana" color="#808080"><br>Trocar sua senha</font></div>

<? if ($msg == 'senhaok'){ ?>
	  <div align="center"><font face="Verdana" color="#FF0000">Senha alterada com sucesso.</font></div>
<? } ?>
    
<div class="box">
    <div class="row align-items-center">
    
        <div class="col-lg-6 col-md-6">
            
            <form method="post" name="Form1" onsubmit="return Form1_Validator(this)" language="JavaScript" action="funcao_recupera_senha.php">
        
            <div class="form-group row">
            <div align="left" class="col-md-4 col-form-label">Nova Senha:</div>
               <input class="form-control col" type="password" name="senha" id="senha" placeholder="********" size="10">
            </div>
            <div class="form-group row">
            <div align="left" class="col-md-4 col-form-label">Confirme a Senha:</div>
               <input class="form-control col" type="password" name="senha2" id="senha2" placeholder="********" size="10">
            </div>
            
            <div class="form-group row">
               <input type="submit" class="btn btn-primary m-2" name="I1" value="Cadastrar">
               <input type="button" onclick="window.location.assign('index.php')" class="btn btn-danger m-2" name="I1" value="Voltar">
            </div>

            <input type="hidden" name="funcao" value="2">

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