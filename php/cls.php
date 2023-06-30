<?php

//Atribui um valor ao botao conforme a intenção
$botao = $_POST['botao'];




//Verifica qual botao foi selecionado

//=======================================================

//--INSERIR--
if ($botao == "Inserir") {

//Atribui as variaveis
$razaoSocial=$_POST['razaoSocial'];
$estadoTransp=$_POST['estadoTransp'];
$nomeFantasia=$_POST['nomeFantasia'];
$cnpjTransp=$_POST['cnpjTransp'];
$apoliceTransp=$_POST['apoliceTransp'];

//Chama a função adequada
include "funcao.php";

$insert = new clsGeren();

$insert->setrazaoSocial($razaoSocial);
$insert->setestadoTransp($estadoTransp);
$insert->setnomeFantasia($nomeFantasia);
$insert->setcnpjTransp($cnpjTransp);
$insert->setapoliceTransp($apoliceTransp);

$insert->Insert();

}

//=======================================================

//--EXCLUIR--
elseif ($botao == "Deletar") {

//Atribui as variaveiss
$codigo=$_POST['codigo'];

//Chama a função adequada
include "funcao.php";

$delete = new clsGeren();

$delete->setcodigo($codigo);

$delete->Delete();
}

//=======================================================

//--PESQUISAR--
elseif ($botao == "Pesquisar"){

//Atribui as variaveis
$codigo = $_POST['codigo'];
$opcao = $_POST['opcao'];

//Chama a função adequada
include "funcao.php";

$search = new clsGeren();

$search->setcodigo($codigo);
$search->setopcao($opcao);

$search->Search();

}

//=======================================================

//--ALTERAR--

elseif ($botao == "Alterar"){

//Atribui as variaveis
$codigo = $_POST['codigo'];

//Chama a função adequada
include "funcao.php";

$search = new clsGeren();

$search->setcodigo($codigo);

$search->Update();

}

//=======================================================

//--CONFIRMAR--

elseif ($botao == "Confirmar") {

//Atribui as variaveis
$codigo=$_POST['codigo'];	
$razaoSocial=$_POST['razaoSocial'];
$estadoTransp=$_POST['estadoTransp'];
$nomeFantasia=$_POST['nomeFantasia'];
$cnpjTransp=$_POST['cnpjTransp'];
$apoliceTransp=$_POST['apoliceTransp'];

//Chama a função adequada
include "funcao.php";

$Confirmar = new clsGeren();

$Confirmar->setrazaoSocial($codigo);
$Confirmar->setrazaoSocial($razaoSocial);
$Confirmar->setestadoTransp($estadoTransp);
$Confirmar->setnomeFantasia($nomeFantasia);
$Confirmar->setcnpjTransp($cnpjTransp);
$Confirmar->setapoliceTransp($apoliceTransp);

$Confirmar->Confirmar();

}


?>