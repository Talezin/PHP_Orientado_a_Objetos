<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/update.css">
<div class="box-form">
<form method="POST" action="update.php">
<p class="titulo">Alteração</p>
<p> CONSULTAR ANTES DE ALTERAR</p>
 	<p>Código:</p> 
 	<input type="text" class="input-text" name="codigo" >
	<input type="submit" class="input-button" value='Consultar' name='alterar'>
</form>
</div>
<?php

//remover erros 
error_reporting(0);

//conecta ao banco de dados
$conexao = mysqli_connect("localhost", "root","","gerenciador");


//verifica se o codigo esta vazio
    if ($_POST['codigo']=="")
     {
        echo "<h1 class='aviso'>Digite um nome para consultar<h1>";
        exit;	
     };

//atribui o codigo informado no formulario
$codigo=$_POST['codigo'];

//select no banco de dados a variavel codigo 
$sql = "SELECT * from transportadoras where codigo  = '". $codigo ."'";

$resultado = mysqli_query($conexao,$sql);

//loop para atribuir todas informações do banco de dados nos var_...
while ($registro = mysqli_fetch_array($resultado))
	{	
		$var_codigo 			=$registro['codigo'];
	   $var_nomeFantasia 	=$registro['nomeFantasia'];
	   $var_razao				=$registro['razaoSocial'];
	   $var_estado				=$registro['estadoTransp'];
	   $var_cnpj				=$registro['cnpjTransp'];
	   $var_apolice 			=$registro['apoliceTransp'] ;
	   $flag=true;
  	}
	
//caso não ache nenhum codigo 
if ($flag==false) {
	 echo "
	 <h1 class='aviso'>Registro não encontrado </h1>";
   	}
	else
	{
	?>	

<!--Cria o formulario e tabela, para exibir os valores var_...-->
	<hr><center>
	<form action="update.php" class="form-update" method="POST">
	<p>Altere os Dados<p>
	<table>
		<tr>
		    <td>Código</td>
			<td> <input type="text" name="codigo" value=<?php echo $var_codigo; ?>  readonly></td>
		</tr>
		<tr>
		    <td>Razão Social</td><td> <input type="text" name="razaoSocial" value=<?php echo $var_razao; ?> >  </td>
		</tr>
		<tr>
		    <td>Nome Fantasia</td>
			<td> <input type="text" name="nomeFantasia" value=<?php echo $var_nomeFantasia; ?> ></td>
		
		</tr>
		<tr>
		    <td>Estado</td><td> <input type="text" name="estadoTransp" value=<?php echo $var_estado; ?> ></td>
		</tr>
		<tr>
		    <td>CNPJ</td><td> <input type="text" name="cnpjTransp" value=<?php echo $var_cnpj; ?> ></td>
		</tr>
		<tr>
		    <td>Apólice</td><td> <input type="text" name="apoliceTransp" value=<?php echo $var_apolice; ?> ></td>
		</tr>
	</table>
	    <p><input type="submit" class="input-button" value='Alterar' name="confirmar">
    </form>

<?php		
}

//verifica se o botao confirmar foi acionado
if (isset($_POST['confirmar'])){


//atribui as variaveis os campos do banco de dados
	$nomeFantasia=$_POST['nomeFantasia'];
	$razaoSocial=$_POST['razaoSocial'];
	$estadoTransp=$_POST['estadoTransp'];
	$cnpjTransp=$_POST['cnpjTransp'];
	$apoliceTransp=$_POST['apoliceTransp'];


//verifica se algum dado esta vazio
  if ($razaoSocial == null || $estadoTransp == null || $nomeFantasia == null || $cnpjTransp == null || $apoliceTransp == null) {
    echo "<script> window.alert('Favor informar todos os dados');
              window.location.href = '#';
              </script>";
  }
//verifica se a apolice é apenas numero
  elseif (!is_numeric($apoliceTransp)) {
    echo "<script> window.alert('Favor informar uma apólice valida');
              window.location.href = '#';
              </script>";
  }
//verifica se o estado é apenas sigla
  elseif (strlen($estadoTransp) != 2) {
    echo "<script> window.alert('informar apenas a sigla do estado');
              window.location.href = '#';
              </script>";
  }else{

//transforma o estado em maiuscula 
  $estadoTransp = strtoupper($estadoTransp);
	
//UPDATE no banco de dados com os valores atribuidos
	$alterando = "UPDATE transportadoras set nomeFantasia='$nomeFantasia', razaoSocial = '$razaoSocial', estadoTransp = '$estadoTransp', cnpjTransp = '$cnpjTransp', apoliceTransp= '$apoliceTransp' where codigo='$codigo'";

//resultado da conexa e alteração
	$resultado = mysqli_query($conexao,$alterando);
	
//verifica se o resultado deu certo ou nao
	if ($resultado == true)
	{
		echo "<script> window.alert('Registro alterado');
              window.location.href = '';
              </script>";
	}
	else
	{
		echo "<script> window.alert('Registro não alterado');
              window.location.href = '';
              </script>";
          }
}
}
?>