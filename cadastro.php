<?php
include 'inc_conn.php';

if ($sessao == 'SIM') {
   header('Location:index.php');
   exit;
}

if (isset($_GET['erro'])) {
$erro = $_GET['erro'];
} else {
$erro = "";
}

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teacher Binder - Organizador Pedagógico Digital</title>

<script Language="JavaScript" Type="text/javascript">

function Form1_Validator(theForm)
{

  if (theForm.nome.value.length < 1)
  {
    alert("Digite o nome.");
    theForm.nome.focus();
    return (false);
  }
  
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

<center> <!-- Corpo -->
<div class="container-fluid" style="width: 65%;">
<div class="texto_principal"><font face="Verdana" color="#808080"><br>Cadastre-se</font></div>

<?php if ($erro == 1): ?>
	  <div align="center"><font face="Verdana" color="#FF0000">E-mail já cadastrado.</font></div>
<?php endif; ?>
      
<div class="box">
    <div class="row align-items-center">
    
        <div class="col-lg-6 col-md-6">
            
            <form method="post" name="Form1" onsubmit="return Form1_Validator(this)" language="JavaScript" action="cadastro_check.php">
        
            <div class="form-group row">
            <div align="left" class="col-md-4 col-form-label">Nome:</div>
               <input class="form-control col-md-8" type="text" name="nome" id="nome" size="50">
            </div>
            <div class="form-group row">
            <div align="left" class="col-md-4 col-form-label">E-mail:</div>
               <input class="form-control col-md-8" type="text" name="email" id="email" placeholder="email@email" size="20">
            </div>
            <div class="form-group row">
            <div align="left" class="col-md-4 col-form-label">Senha:</div>
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

            <input type="hidden" name="funcao" value="cadastro">

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