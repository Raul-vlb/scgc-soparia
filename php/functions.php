<?php

#---------------------------------x---------------------------------#
#                           functions.php                           #
#       cadastrar-solicitar-alterar-deletar dados do cliente        #
#    -=[Sistema de Cadastro e Gerenciamento de clientes v1.0]=-     #
#---------------------------------x---------------------------------#
#  Copyright 2020 - Raul Vitor Lucena Brito <raulvitorcc@gmail.com> #
#---------------------------------x---------------------------------#
 
date_default_timezone_set('America/Fortaleza'); 
header("Content-type: text/html; charset=utf-8");
	

function getClientData($clientName){
	
	include 'Conn.php';
		
	//	Captura os dados do cliente
		$sqlGetClientData = "SELECT * FROM clientes WHERE Nome = '$clientName'";
		$clientData = mysqli_query($ConnectDB, $sqlGetClientData);	
		
		mysqli_close($ConnectDB); 	//	fecha conexão
	
	//	retorna os dados capturados
		return $clientData;	
	
}


function sendClientData($nome, $telefone, $cep, $rua, $numero, $bairro, $cidade, $complemento, $referencia){
	
	include 'Conn.php';

	//	Descrição dos status:
	//		# 100 > Tudo ocorreu conforme o esperado
	//		# 101 > Usuário já cadastrado no sistema
	//		# 102 > Campo "telefone" incompleto
	//		# 103 > Erro ao executar o SQL de inserção
	
	//	verifica se o cliente já está cadastrado no sistema	
	$sqlCheckDouble = "SELECT * FROM clientes WHERE Nome = '$nome'";
	$checkDouble = mysqli_query($ConnectDB, $sqlCheckDouble);	
	
	if(mysqli_num_rows($checkDouble) > 0):
		$Status = 101;
		$DataBack = array( $Status, $nome, $telefone, $cep, $rua , $numero, $bairro, $cidade, $complemento, $referencia );
		return $DataBack;
	endif;
	
	if(strlen($telefone) < 14):
		$Status = 102;	
		$DataBack = array( $Status, $nome, $telefone, $cep, $rua , $numero, $bairro, $cidade, $complemento, $referencia );
		return $DataBack;
	endif;
	
	//	SQL para inserção dos dados no banco de dados
	$sqlSendClientData = "INSERT INTO clientes (Nome, Telefone, CEP, Rua, Numero, Bairro, Cidade, Complemento, PontoReferencia)
										VALUES ('$nome', '$telefone', '$cep', '$rua' , '$numero', '$bairro', '$cidade', '$complemento', '$referencia')";
	//	Executa o SQL, salvando o resultado (true ou false) na variavel
	$dataSent = mysqli_query($ConnectDB, $sqlSendClientData);
	//	fecha conexão
	mysqli_close($ConnectDB);

	// Define o status de acordo com o resultado da execução do SQL
	if($dataSent):	//	True
		$Status = 100;
		$DataBack = array($Status);
		return $DataBack;
	else:			//	False
		$Status = 103;
		$DataBack = array($Status);
		return $DataBack;
	endif;

	//	return ($dataSent) ? "<i class='material-icons medium'> check_circle </i> <br> Cliente cadastrado com sucesso!" : "<i class='material-icons medium'> error </i> <br> Cliente não foi cadastrado devido à um erro.";
	
}

function updateClientData($ID, $nome, $telefone, $cep, $rua, $numero, $bairro, $cidade, $complemento, $referencia){
	
	include 'Conn.php';

	if(strlen($telefone) < 14):
		$Status = 201;	
		$DataBack = array( $Status, $nome );
		return $DataBack;
	endif;

	//	SQL para atualização dos dados no banco de dados
	$sqlUpdateClientData = "	UPDATE clientes 
								SET Nome = '$nome', Telefone = '$telefone', CEP = '$cep', Rua = '$rua', Numero = '$numero', Bairro = '$bairro', Cidade = '$cidade', Complemento = '$complemento', PontoReferencia = '$referencia'
								WHERE ID = $ID";
	//	Executa o SQL, salvando o resultado (true ou false) na variavel
	$dataSent = mysqli_query($ConnectDB, $sqlUpdateClientData);
	//	fecha conexão
	mysqli_close($ConnectDB);

	// Define o status de acordo com o resultado da execução do SQL
	if($dataSent):	//	True
		$Status = 200;
		$DataBack = array($Status, $nome);
		return $DataBack;
	else:			//	False
		$Status = 202;
		$DataBack = array( $Status, $nome );
		return $DataBack;
	endif;

}

function deleteClientData($ID){
	
	include 'Conn.php';

	$sqlDeleteClientData =  "DELETE FROM clientes WHERE ID = $ID";
	$dataDelete = mysqli_query($ConnectDB, $sqlDeleteClientData);

	//	fecha conexão
	mysqli_close($ConnectDB);

	// Define o status de acordo com o resultado da execução do SQL
	if($dataDelete):	//	True
		$Status = 300;
		$DataBack = array($Status);
		return $DataBack;
	else:			//	False
		$Status = 301;
		$DataBack = array( $Status);
		return $DataBack;
	endif;

}

	
?>