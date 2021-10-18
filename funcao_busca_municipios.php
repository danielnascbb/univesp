<?php include_once("inc_conn.php");

	$uf = $_REQUEST['uf'];

	$sql = "SELECT * FROM municipios_ibge WHERE uf = '$uf' ORDER BY municipio";
	$dados = mysqli_query($conn,$sql) or die(' Erro na query:' . $sql . ' ' . mysqli_error($conn) ); 
	$total = mysqli_num_rows($dados);
		
	while ($row =  mysqli_fetch_array($dados)) {
		$municipios_post[] = array(
			'cod_municipio'	=> $row['cod_municipio'],
			'municipio' => $row['municipio'],
		);
	}
	
	echo(json_encode($municipios_post));
