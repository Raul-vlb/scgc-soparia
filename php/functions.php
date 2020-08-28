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
	
	// Define o status de acordo com o resultado da execução do SQL
		$Status = (mysqli_num_rows($clientData) > 0) ? 000 : 001;
	//	Retorna o Status 
		$DataBack = ($Status == 000) ? array($Status, $clientData) : array($Status);
		return $DataBack;	
}


function sendClientData($nome, $telefone, $cep, $rua, $numero, $bairro, $cidade, $complemento, $referencia){
	
	include 'Conn.php';
	
	//	verifica se o cliente já está cadastrado no sistema	
	$sqlCheckDouble = "SELECT * FROM clientes WHERE Nome = '$nome'";
	$checkDouble = mysqli_query($ConnectDB, $sqlCheckDouble);	
	
	//	Status de erro caso o usuário já esteja cadastrado
	if(mysqli_num_rows($checkDouble) > 0):
		$Status = 101;

		//	Retorna o Status junto com os dados em caso de erro
		$DataBack = array( $Status, $nome, $telefone, $cep, $rua , $numero, $bairro, $cidade, $complemento, $referencia );
		return $DataBack;
	endif;
	
	//	Status de erro caso telefone esteja incompleto
	if(strlen($telefone) < 14):
		$Status = 102;	
		
		//	Retorna o Status junto com os dados em caso de erro
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
	$Status = ($dataSent) ? 100 : 103;

	//	Retorna o Status 
	$DataBack = array($Status);
	return $DataBack;
	
}


function updateClientData($ID, $nome, $telefone, $cep, $rua, $numero, $bairro, $cidade, $complemento, $referencia){
	
	include 'Conn.php';

	//	Status de erro caso telefone esteja incompleto
	if(strlen($telefone) < 14):
		$Status = 201;	
		//	Retorna o Status junto com o campo Nome em caso de erro
		$DataBack = array( $Status, $nome );
		return $DataBack;
	endif;

	//	SQL para atualização dos dados no banco de dados
	$sqlUpdateClientData = "	UPDATE clientes 
								SET Nome = '$nome', Telefone = '$telefone', CEP = '$cep', Rua = '$rua', Numero = '$numero', Bairro = '$bairro', Cidade = '$cidade', Complemento = '$complemento', PontoReferencia = '$referencia'
								WHERE ID = $ID";
	//	Executa o SQL, salvando o resultado (true ou false) na variavel
	$dataUpdate = mysqli_query($ConnectDB, $sqlUpdateClientData);
	//	fecha conexão
	mysqli_close($ConnectDB);


	// Define o status de acordo com o resultado da execução do SQL
	$Status = ($dataUpdate) ? 200 : 202;

	//	Retorna o Status 
	$DataBack = array($Status, $nome);
	return $DataBack;

}

function deleteClientData($ID){
	
	include 'Conn.php';

	$sqlDeleteClientData =  "DELETE FROM clientes WHERE ID = $ID";
	$dataDelete = mysqli_query($ConnectDB, $sqlDeleteClientData);

	//	fecha conexão
	mysqli_close($ConnectDB);

	// Define o status de acordo com o resultado da execução do SQL
	$Status = ($dataDelete) ? 300 : 301;

	//	Retorna o Status 
	$DataBack = array($Status);
	return $DataBack;

}

	//	Descrição dos status:
	//		# 100 > Tudo ocorreu conforme o esperado
	//		# 101 > Usuário já cadastrado no sistema
	//		# 102 > Campo "telefone" incompleto
	//		# 103 > Erro ao executar o SQL de inserção
	
?>