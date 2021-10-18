<?php
include 'inc_conn.php';

if ($sessao != 'SIM') {
	header('Location: login.php');    
    exit;
}

$sql = "SELECT uf FROM municipios_ibge GROUP BY uf order by uf";
$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
$total = mysqli_num_rows($dados);

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teacher Binder - Organizador Pedagógico Digital</title>
<?php include 'inc_head.php';?>

<script Language="JavaScript" Type="text/javascript">

function Form1_Validator(theForm)
{

  if (theForm.ano.value.length != 4)
  {
    alert("Digite ano com 4 dígitos.");
    theForm.ano.focus();
    return (false);
  }

  var checkOK = "1234567890";
  var checkStr = theForm.ano.value;
  var allValid = true;
  var validGroups = true;
  for (i = 0;  i < checkStr.length;  i++)
  {
    ch = checkStr.charAt(i);
    for (j = 0;  j < checkOK.length;  j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length)
    {
      allValid = false;
      break;
    }
  }
  if (!allValid)
  {
    alert("Ano inválido");
    theForm.ano.focus();
    return (false);
  }
  
  return (true);
}
</script>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF">

<center> <!-- Topo -->
<Br>&nbsp;<br>
<div class="container-fluid" style="width: 70%;">
    <?php include 'inc_topo.php'; ?>
</div>
</center>


<center> <!-- Corpo -->
<Br>&nbsp;<br>
<div class="container-fluid" style="width: 40%;">
    
    <p class="h2">Cadastrar Feriados</p><br>
    <p class="h6">Digite o ano a ser cadastrado e selecione o município</p><br><br>

    <form method="post" name="Form1" onsubmit="return Form1_Validator(this)" language="JavaScript" action="feriados_incluir_api.php">
        
            <div class="form-group row">
            <div align="left" class="col-md-4 col-form-label">Ano:</div>
               <input class="form-control col-md-8" type="text" name="ano" id="ano" size="50">
            </div>
            <div class="form-group row">
               <div align="left" for="FormControlSelect1" class="col-md-4 col-form-label">Estado:</div>
               <select name="uf" class="form-control col-md-8" id="uf">
                  <option>Selecione</option selected>
                  <?php
                  while ($row = mysqli_fetch_array($dados))
                  {                  
                  $r_uf = $row['uf'];
                  ?>
                     <option value="<?=$r_uf;?>"><?=$r_uf;?></option>
                  <?php
                  }
                  ?>
               </select>
            </div>
            <div class="form-group row">
               <div align="left" for="FormControlSelect1" class="col-md-4 col-form-label">Município:</div>
               <span class="carregando">Aguarde, carregando...</span>
               <select name="municipio" class="form-control col-md-8" id="municipio">
                  <option>Selecione</option selected>
               </select>
            </div> 

            
            <div class="form-group row">
               <input type="submit" border="0" id="cadastrar" name="I1" value="Cadastrar">
            </div>

            <input type="hidden" name="funcao" value="cadastro">

            </form>

</div>
</center>


<center> <!-- Rodapé -->
<div class="container-fluid" style="width: 70%;">
    <?php include 'inc_inferior.php'; ?>
</div>
</center>

      <script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load("jquery", "1.4.2");
		</script>
		
		<script type="text/javascript">
      $('.carregando').hide();
      $('#cadastrar').hide();
      $('#municipio').html('<option>– Escolha um estado –</option>');
		$(function(){
			$('#uf').change(function(){
				if( $(this).val() ) {
					$('#municipio').hide();
					$('.carregando').show();
					$.getJSON('funcao_busca_municipios.php?uf=',{uf: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolha o município</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].cod_municipio + '">' + j[i].municipio + '</option>';
						}	
						$('#municipio').html(options).show();
						$('.carregando').hide();
                  $('#cadastrar').hide();
					});
				}

            if( $(this).val() == "Selecione" ) {
               $('#municipio').hide();
               $('.carregando').hide();
               $('#municipio').html('<option>– Escolha um estado –</option>');
               $('#cadastrar').hide();
            }
			});
		});
      $(function(){
			$('#municipio').change(function(){
            if( $(this).val() == "Escolha o município" ) {
               $('#cadastrar').hide();
            } else {
               $('#cadastrar').show();
            }
			});
		});
		</script>

</body>

</html>