<?php

include 'connect.php';

class clsGeren{


	
	public string $botao;

	private $razaoSocial;
	private $estadoTransp;
	private $nomeFantasia;
	private $cnpjTransp;
	private $apoliceTransp;

//=======================================================

public function getcodigo()
{
	return $this->codigo;
}

public function setcodigo($tCodigo)
{
	$this->codigo = $tCodigo;
}

//=======================================================

public function getrazaoSocial()
{
	return $this->razaoSocial;
}

public function setrazaoSocial($tRazaoSocial)
{
	$this->razaoSocial = $tRazaoSocial;
}

//=======================================================

public function getestadoTransp()
{
	return $this->estadoTransp;
}

public function setestadoTransp($tEstadoTransp)
{
	$this->estadoTransp = $tEstadoTransp;
}

//=======================================================

public function getnomeFantasia()
{
	return $this->nomeFantasia;
}

public function setnomeFantasia($tNomeFantasia)
{
	$this->nomeFantasia = $tNomeFantasia;
}

//=======================================================

public function getcnpjTransp()
{
	return $this->cnpjTransp;
}

public function setcnpjTransp($tCnpjTransp)
{
	$this->cnpjTransp = $tCnpjTransp;
}

//=======================================================

public function getapoliceTransp()
{
	return $this->apoliceTransp;
}

public function setapoliceTransp($tApoliceTransp)
{
	$this->apoliceTransp = $tApoliceTransp;
}

//=======================================================

public function getopcao()
{
	return $this->opcao;
}

public function setopcao($tOpcao)
{
	$this->opcao = $tOpcao;
}


//=======================================================

//--FUNÇÃO INSERIR TRANSPORTADORA--
public function Insert(){

	//Conexao com o banco de dados utilizando pdo
	$bd = new Conexao();
	$conexao = $bd->getConexao();


	//Verifica se algum dado esta vazio
	if ($this->razaoSocial == null || $this->estadoTransp == null || $this->nomeFantasia == null || $this->cnpjTransp == null || $this->apoliceTransp == null) {
	    echo "<script> window.alert('Favor informar todos os dados');</script>";
	exit;
  }

  //inseri no banco de dados
  $sql = "INSERT INTO transportadoras (codigo,razaoSocial,estadoTransp,nomeFantasia,cnpjTransp,apoliceTransp) VALUES(NULL,?,?,?,?,?)";

  $stm = $conexao->prepare($sql);
  $stm->bindValue(1, $this->razaoSocial);
  $stm->bindValue(2, $this->estadoTransp);
  $stm->bindValue(3, $this->nomeFantasia);
  $stm->bindValue(4, $this->cnpjTransp);
  $stm->bindValue(5, $this->apoliceTransp);


  $resultado = $stm->execute();




  if (!$resultado) {
    echo "<script> window.alert('Registro não inserido');
              window.location.href = '../insert.html';
              </script>";
  }
  else {
    echo "<script> window.alert('Registro inserido com sucesso');
              window.location.href = '../insert.html ';
              </script>";

  }
}

//=======================================================

//--FUNÇÃO EXCLUIR TRANSPORTADORA--
public function Delete(){

	//Conexao com o banco de dados utilizando pdo
	$bd = new Conexao();
	$conexao = $bd->getConexao();

	//Verifica se o codigo esta vazio
	if ($this->codigo == NULL) {
		echo "<script> window.alert('Favor informar	o codigo');</script>";
	exit;
	}


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

	//Conexao com o banco de dados utilizando pdo
	$bd = new Conexao();
	$conexao = $bd->getConexao();

	include '../css/search.css';


	//Verifica se o nome fantasia esta vazio
	
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

	//cria a tabela e o cabeçalho
if ($stm->rowCount() > 0){
	$resultado = $stm->fetchAll(\PDO::FETCH_ASSOC);


	echo 	"<div class='table-box'>
    		<table class='tabela'>";
    echo 	"<tr class='cabecalho'>"
			."<td>Codigo</td>"
            ."<td>Razão Social</td>"
            ."<td>Nome Fantasia</td>"
            ."<td>Estado</td>"
            ."<td>CNPJ</td>"
            ."<td>Apólice</td>"
            ."</tr>"; 

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

//--FUNÇÃO PESQUISAR TRANSPORTADORA--

public function Update(){

	//Conexao com o banco de dados utilizando pdo
	$bd = new Conexao();
	$conexao = $bd->getConexao();

	//Incluir arquivo CSS
	include '../css/update.css';

	//Verifica se o codigo esta vazio
	if ($this->codigo == !NULL){
		$sql = "SELECT * from transportadoras where codigo = $this->codigo";
	}

	$stm = $conexao->prepare($sql);

	$stm->execute();

	if ($stm->rowCount() > 0){
	$resultado = $stm->fetchAll(\PDO::FETCH_ASSOC);

	//Cria a tabela para exibir
	echo 	"<div class='table-box'>
    		<table class='tabela'>";
    echo 	"<tr class='cabecalho'>"
			."<td>Codigo</td>"
            ."<td>Razão Social</td>"
            ."<td>Nome Fantasia</td>"
            ."<td>Estado</td>"
            ."<td>CNPJ</td>"
            ."<td>Apólice</td>"
            ."</tr>"; 

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
}

