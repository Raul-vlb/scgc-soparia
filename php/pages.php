<?php
#---------------------------------x---------------------------------#
#                             pages.php                             #
#           Seleciona a pagina a ser mostrada ao usuário            #
#    -=[Sistema de Cadastro e Gerenciamento de clientes v1.0]=-     #
#---------------------------------x---------------------------------#
#  Copyright 2020 - Raul Vitor Lucena Brito <raulvitorcc@gmail.com> #
#---------------------------------x---------------------------------#

if( isset($_POST['buscar']) || isset($_POST['cadastrar']) || isset($_POST['editar']) || isset($_POST['lista']) || isset($_POST['config']) || isset($_POST['cliente']) ):

	if(isset($_POST['buscar'])):
		$Pagina = 'buscarCliente';
	endif;
	
	if(isset($_POST['cadastrar'])):
		$Pagina = 'cadastrarCliente';
	endif;
	
	if(isset($_POST['editar'])):
		$Pagina = 'editar';
	endif;

	if(isset($_POST['lista'])):
		$Pagina = 'listaClientes';
	endif;
	
	if(isset($_POST['config'])):
		$Pagina = 'configuracoes';
	endif;
	
	if(isset($_POST['cliente'])):
		$Pagina = 'mostrarCliente';
	endif;

else:
	
	$Pagina = 'buscarCliente';
	
endif;	

?>