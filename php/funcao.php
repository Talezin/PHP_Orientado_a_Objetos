<?php

include 'connect.php';

class clsGeren{

	private $codigo;
	private $razaoSocial;
	private $estadoTransp;
	private $nomeFantasia;
	private $cnpjTransp;
	private $apoliceTransp;

//=======================================================

public function setcodigo($tCodigo)
{
	$this->codigo = $tCodigo;
}

//=======================================================

public function setrazaoSocial($tRazaoSocial)
{
	$this->razaoSocial = $tRazaoSocial;
}

//=======================================================

public function setestadoTransp($tEstadoTransp)
{
	$this->estadoTransp = $tEstadoTransp;
}

//=======================================================

public function setnomeFantasia($tNomeFantasia)
{
	$this->nomeFantasia = $tNomeFantasia;
}

//=======================================================

public function setcnpjTransp($tCnpjTransp)
{
	$this->cnpjTransp = $tCnpjTransp;
}

//=======================================================


public function setapoliceTransp($tApoliceTransp)
{
	$this->apoliceTransp = $tApoliceTransp;
}

//=======================================================

public function setopcao($tOpcao)
{
	$this->opcao = $tOpcao;
}


//=======================================================

//--FUNÇÃO INSERIR TRANSPORTADORA--
public function Insert(){

	//Realiza a conexão com Banco de dados
	$bd = new Conexao();
	$conexao = $bd->getConexao();

	//Verifica se algum dado esta vazio
	if ($this->razaoSocial == null || $this->estadoTransp == null || $this->nomeFantasia == null || $this->cnpjTransp == null || $this->apoliceTransp == null) {
	    echo "<script> window.alert('Favor informar todos os dados');
	  						  window.location.href='../insert.html';</script>";
	exit;
  }
  //Verifica se o  CNPJ é válido
  elseif (!is_numeric($this->cnpjTransp) || strlen($this->cnpjTransp) != 14) {
	    echo "<script> window.alert('Favor informar um CNPJ válido com apenas números!');
	    							window.location.href='../insert.html';</script>";
	}
	//Verifica se a apólice é válida
	elseif (!is_numeric($this->apoliceTransp)) {
	    echo "<script> window.alert('Favor informar um apólice válida com apenas números!');
	    							window.location.href='../insert.html';</script>";
	}
	//Verifica se é apenas a sigla do estado
	elseif (strlen($this->estadoTransp) != 2) {
			echo "<script> window.alert('Favor apenas as siglas do estado!');
	    							window.location.href='../insert.html';</script>";
	}
	else{

		//transforma a sigla do estado em maiuscula 
	  $estadoTransp = strtoupper($this->estadoTransp);

	  //Converte o CNPJ, colocando ".", "/", "-"
	  $cnpj_cpf = preg_replace("/\D/", '', $this->cnpjTransp);
	  $cnpjCerto = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
	  
	  $query = "SELECT cnpjTransp from transportadoras where cnpjTransp = ?";

	  $stmt = $conexao->prepare($query);

	  $stmt->bindValue(1, $cnpjCerto);
	  $stmt->execute();
	  $rowCount = $stmt->rowCount();

	  if ($rowCount == 1) {
	  		echo "<script> window.alert('CNPJ ja consta como cadastrado!'); 
	  									window.location.href = '../insert.html';</script>";
	  }
	  else{
  //Inseri no banco de dados
			$sql = "INSERT INTO transportadoras (codigo,razaoSocial,estadoTransp,nomeFantasia,cnpjTransp,apoliceTransp) VALUES(NULL,?,?,?,?,?)";


		  $stm = $conexao->prepare($sql);
		  $stm->bindValue(1, $this->razaoSocial);
		  $stm->bindValue(2, $estadoTransp);
		  $stm->bindValue(3, $this->nomeFantasia);
		  $stm->bindValue(4, $cnpjCerto);
		  $stm->bindValue(5, $this->apoliceTransp);


		  $resultado = $stm->execute();

		  if (!$resultado) {
		    echo "<script> window.alert('Registro não inserido');
		              window.location.href = '../insert.html';
		              </script>";
		  }
		  else{
		    echo "<script> window.alert('Registro inserido com sucesso');
		              window.location.href = '../insert.html ';
		              </script>";

		  }
			}
			}
}



//=======================================================

//--FUNÇÃO EXCLUIR TRANSPORTADORA--
public function Delete(){

	//Realiza a conexão com Banco de dados
	$bd = new Conexao();
	$conexao = $bd->getConexao();

	//Verifica se o codigo esta vazio
	if ($this->codigo == NULL) {
		echo "<script> window.alert('Favor informar	o codigo');</script>";
	exit;
	}

	//Deleta do banco de dados
	$sql = "DELETE from transportadoras where codigo=?";

  	$stm = $conexao->prepare($sql);
  	$stm->bindValue(1, $this->codigo);

  	$resultado = $stm->execute();

    if($resultado==true)
      echo "<script> window.alert('Registro excluido');
              window.location.href = '../delete.html';
              </script>";
    else
      echo "<script> window.alert('Registro não excluido');
              window.location.href = '../delete.html';
              </script>";
}

//=======================================================

//--FUNÇÃO PESQUISAR TRANSPORTADORA--
public function Search(){

	//Realiza a conexão com Banco de dados
	$bd = new Conexao();
	$conexao = $bd->getConexao();

	//Puxa Css
	include '../css/search.css';


	//Verifica se o código e opção estão vazios
	if ($this->codigo == !NULL){
		$sql = "SELECT * from transportadoras where codigo = $this->codigo";
	}
	elseif($this->opcao == !NULL){
		$sql = "SELECT * from transportadoras order by $this->opcao";
	}
	elseif($this->codigo == NULL && $this->opcao == NULL){
		$sql = "SELECT * from transportadoras";
	}

	$stm = $conexao->prepare($sql);

	$stm->execute();

	//Cria a tabela e o cabeçalho
	if ($stm->rowCount() > 0){
	$resultado = $stm->fetchAll(\PDO::FETCH_ASSOC);

	//Cabeçalho
	echo 	"<div class='table-box'>
    		<table class='tabela'>";
    echo 		"<tr class='cabecalho'>"
						."<td>Codigo</td>"
            ."<td>Razão Social</td>"
            ."<td>Nome Fantasia</td>"
            ."<td>Estado</td>"
            ."<td>CNPJ</td>"
            ."<td>Apólice</td>"
            ."</tr>"; 

  //Corpo da tabela
	foreach($resultado as $exibir){

	echo 
    "<tr class='conteudo'>"
    ."<td>$exibir[codigo]</td>"
    ."<td>$exibir[razaoSocial]</td>"
    ."<td>$exibir[nomeFantasia]</td>"
    ."<td>$exibir[estadoTransp]</td>"
    ."<td>$exibir[cnpjTransp]</td>"
    ."<td>$exibir[apoliceTransp]</td>"
    ."</tr>";
	}
	return $exibir;
	echo "</table> </div>";
	}
}

//=======================================================

//--FUNÇÃO ALTERAR TRANSPORTADORA--
public function Update(){

	//Realiza a conexão com Banco de dados
	$bd = new Conexao();
	$conexao = $bd->getConexao();

	//Incluir arquivo CSS
	include '../css/update.css';

	//Verifica se o codigo esta vazio
	if ($this->codigo == !NULL){
		$sql = "SELECT * from transportadoras where codigo = $this->codigo";
	}
	else{
		echo "<script> window.alert('Favor informar o código!');
		</script>";

		 error_reporting(0);
	}

	$stm = $conexao->prepare($sql);

	$stm->execute();

	if ($stm->rowCount() > 0){
	$resultado = $stm->fetchAll(\PDO::FETCH_ASSOC);

	//Cria a formulário para exibir
	echo 	"<form action='cls.php' class='form-update' method='POST'>
	<p>Altere os Dados<p>";

	//Cria o corpo do formulário
	foreach($resultado as $exibir){

	echo 
    "<table>
		<tr>
		    <td>Código</td>
			<td> <input type='text' name='codigo' value='$exibir[codigo]'></td>
		</tr>
		<tr>
		    <td>Razão Social</td><td> <input type='text' name='razaoSocial' value='$exibir[razaoSocial]'>  </td>
		</tr>
		<tr>
		    <td>Nome Fantasia</td>
			<td> <input type='text' name='nomeFantasia' value='$exibir[nomeFantasia]'></td>
		
		</tr>
		<tr>
		    <td>Estado</td><td> <input type='text' name='estadoTransp' value='$exibir[estadoTransp]' ></td>
		</tr>
		<tr>
		    <td>CNPJ</td><td> <input type='text' name='cnpjTransp' value='$exibir[cnpjTransp]'></td>
		</tr>
		<tr>
		    <td>Apólice</td><td> <input type='text' name='apoliceTransp' value='$exibir[apoliceTransp]'></td>
		</tr>
	</table>
	 <p><input type='submit' class='input-button' name='botao' value='Confirmar' >
    </form>";
	}
	return $exibir;
	echo "</table> </div>";
	}
	else{
	echo "<script> window.alert('Código não encontrado!');</script>";
	}
}

//=======================================================

//--FUNÇÃO CONFIRMAR ALTERAÇÃO TRANSPORTADORA--
public function Confirmar(){

	//Realiza a conexão com Banco de dados
  $bd = new Conexao();
	$conexao = $bd->getConexao();

	//Puxa as variaveis enviadas pelo formulário de alteração
	$codigo=$_POST['codigo'];
  $nomeFantasia=$_POST['nomeFantasia'];
  $razaoSocial=$_POST['razaoSocial'];
	$estadoTransp=$_POST['estadoTransp'];
	$cnpjTransp=$_POST['cnpjTransp'];
	$apoliceTransp=$_POST['apoliceTransp'];


	//Verifica se algum dado esta vazio
	if ($razaoSocial == null || $estadoTransp == null || $nomeFantasia == null || $cnpjTransp == null || $apoliceTransp == null) {
	    echo "<script> window.alert('Favor informar todos os dados');</script>";
	exit;
  }
  //Verifica se o CNPJ tem o tamanho correto
  elseif (strlen($cnpjTransp) != 18) {
	    echo "<script> window.alert('Favor informar um CNPJ!');</script>";
	}
	//Verifica se a apólice é válida
	elseif (!is_numeric($apoliceTransp)) {
	    echo "<script> window.alert('Favor informar um apólice válida com apenas números!');</script>";
	}
	//Verifica se foi informado apenas a sigla do estado
	elseif (strlen($estadoTransp) != 2) {
			echo "<script> window.alert('Favor apenas as siglas do estado!');</script>";
	}
	else{

		//Transforma a sigla do estado em maiuscula 
		$estadoTransp = strtoupper($this->estadoTransp);

		$query = "SELECT cnpjTransp from transportadoras where cnpjTransp = ?";

	  $stmt = $conexao->prepare($query);

	  $stmt->bindValue(1, $cnpjTransp);
	  $stmt->execute();
	  $rowCount = $stmt->rowCount();

	  if ($rowCount == 1) {
	  		echo "<script> window.alert('CNPJ ja consta como cadastrado!'); </script>";
	  }
	  else{
		//Realiza a alteração no banco de dados
		$sql = "UPDATE transportadoras set nomeFantasia = '$nomeFantasia', razaoSocial = '$razaoSocial', estadoTransp = '$estadoTransp', cnpjTransp = '$cnpjTransp', apoliceTransp = '$apoliceTransp' where codigo='$codigo'";

	$stm = $conexao->prepare($sql);

	$resultado = $stm->execute();

	if (!$resultado) {
    echo "<script>window.alert('Registro não alterado!')</script>";
  }
  else {
    echo "<script>window.alert('Registro alterado com sucesso!')</script>";
  }
  }
	}
}


















}




