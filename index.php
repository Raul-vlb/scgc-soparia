<?php
#-------------------------------------------x-------------------------------------------#
#                                       index.php                                       #
#                                       Home Page                                       #
#              -=[Sistema de Cadastro e Gerenciamento de clientes v1.0]=-               #
#-------------------------------------------x-------------------------------------------#
#            Copyright 2020 - Raul Vitor Lucena Brito <raulvitorcc@gmail.com>           #
#-------------------------------------------x-------------------------------------------#

date_default_timezone_set('America/Fortaleza');
header("Content-type: text/html; charset=utf-8");

include './php/pages.php';
include './php/Conn.php';
include './php/functions.php';
include "./php/CallBackClientData.php";

?>

<!DOCTYPE html>
<html>

<head>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link rel="stylesheet" href="frameworks/materialize/css/materialize.css">
	<link rel="stylesheet" href="css/style.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />

	<title> Sistema de cadastro e gestão de clientes </title>

</head>

<body class="orange lighten-2">

	<?php include './pages/navbar.php' ?>

	<main class="row DoNotPrint" style="margin: 0; margin-left: 60px;">

		<div class="col s12 valign-wrapper" style="min-height: 100vh;">

			<?php
			switch ($Pagina) {
				case 'buscarCliente':
					include './pages/searchClient.php';
					break;

				case 'mostrarCliente':
					include './pages/showClient.php';
					break;

				case 'cadastrarCliente':
					include './pages/registerClient.php';
					break;

				case 'editar':
					include './pages/editClient.php';
					break;

				case 'listaClientes':
					include './pages/listClient.php';
					break;

				case 'configuracoes':
					include './pages/Config.php';
					break;

				default:
					include './pages/searchClient.php';
			}
			?>

		</div>

		</div>

	</main>

	<?php include './pages/printCard.php';    ?>

	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="./frameworks/materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
	<script type="text/javascript" src="./js/mask.js"></script>
	<script>
		$(document).ready(function() {
			$('.tooltipped').tooltip();
			$('select').formSelect();
			$('.tabs').tabs();
			$('.modal').modal();
			$('.collapsible').collapsible();
		});
	</script>
</body>

</html>