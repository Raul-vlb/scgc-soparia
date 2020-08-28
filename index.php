<?php
#-------------------------------------------x-------------------------------------------#
#                                       index.php                                       #
#                                       Home Page                                       #
#                    -=[Cadastro e Gerenciamento de clientes v1.0]=-                    #
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset="utf-8"/>
		
		<title> Cadastro e gerenciamento de clientes </title>
		
		<style>
			
			body {
    			display: flex;
    			min-height: 100vh;
    			flex-direction: column;
			}
			
			::-webkit-scrollbar {
	    		width: 0px;
			}
			
			.card-panel{
				animation: fadein 0.5s;	
				-webkit-animation: fadein 0.5s; /* Webkit */
				-moz-animation: fadein 0.5s; /* Firefox */
				-ms-animation: fadein 0.5s; /* IE */				
			}
		
			.print{ display: none; }
		
			.CardPrint{
				width: 320px; border: none;
				margin: 0 auto; padding: 15px; background: white;
			}
			
			@media print { 
	        	.DoNotPrint { display: none; } 
				.print { display: block; }
        		body { background: #fff; }
        	}
			
			@keyframes fadein {
    			from { opacity: 0.5; } to { opacity: 1; }
			}

			@-webkit-keyframes fadein { /* Webkit */
    			from { opacity: 0.5; } to { opacity: 1; }
			}

			@-moz-keyframes fadein { /* Firefox */
    			from { opacity: 0.5; } to { opacity: 1; }
			}
			
			@-o-keyframes fadein { /* Opera */
    			from { opacity: 0.5; } to { opacity: 1; }
			}
			
			.nav{position: fixed; width: 60px; height: 100vh; margin: 0;}
			
		</style>
		
	</head>
	<body class="orange lighten-2">
	
		<div class="nav grey darken-3 valign-wrapper DoNotPrint">
			
			<div class="row center" style="position: absolute; top: 0;">
				<a href="./">
					<img src="./img/logo.png" style="width: 50px; margin: 15px 5px;" />
				</a>
			</div>
			
			<div class="row center">
				<form action="./" method="POST">
					
					<div class="row">
						<button type="submit" name="buscar" class="btn-floating grey darken-2 waves-effect waves-dark tooltipped" data-position="right" data-tooltip="Buscar Cliente"> 
	    					<i class="material-icons right">search</i>
		 				</button>
					</div>
					
					<div class="row">
						<button type="submit" name="cadastrar" class="btn-floating grey darken-2 waves-effect waves-dark tooltipped" data-position="right" data-tooltip="Cadastrar Novo Cliente"> 
							<i class="material-icons"> person_add </i> 
						</button>
					</div>
					
					<div class="row">
						<button type="submit" name="lista" class="btn-floating grey darken-2 waves-effect waves-dark tooltipped" data-position="right" data-tooltip="Lista De Clientes Cadastrados"> 
							<i class="material-icons"> format_list_numbered </i> 
						</button>
					</div>
					
					<div class="row">
						<button type="submit" name="config" class="btn-floating grey darken-2 waves-effect waves-dark tooltipped" data-position="right" data-tooltip="Configurações"> 
							<i class="material-icons"> settings </i> 
						</button>
					</div>
				
				</form>	
			</div>	
		
		</div>
		
			
		<main class="row DoNotPrint" style="margin: 0; margin-left: 60px;">
		
			<div class="col s12 valign-wrapper" style="min-height: 100vh;">
				
				<?php
				switch($Pagina){
					case 'buscarCliente':
				?>
						
						<div class="container-fluid" style="width: 90%; margin: 0 5%;">
							
							<div class="row">
								<div class="col m12">
      								<div class="card-panel white center">
																				
										<div class="row">
											
											<div class="col s12">
												<center><h5>Buscar por cliente cadastrado</h5></center>
											</div>
											
											<div class="col s12">
												<form action="./" autocomplete="off" method="POST">
													<div class="row" style="margin-bottom: 0;">
											
														<div class="input-field col s10 offset-s1">
															<input name="SearchClient" id="BuscarNomeCliente" style="text-transform:capitalize; width: 100%;" list="clientes" type="text" class="validate center" autocomplete="off" required>
															<datalist id="clientes">
																<?php 
																	$ClientesCadastrados = Array();
																	$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
																	$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');																	
																	
																	$sqlClientesCadastrados = "SELECT DISTINCT Nome FROM clientes";										
																	$Clientes = mysqli_query($ConnectDB, $sqlClientesCadastrados);																							
																	if($Clientes):	
																		while($row = $Clientes->fetch_assoc()) {	
																			array_push($ClientesCadastrados, $row['Nome']);	
																		}
																	endif;
															
																	foreach ($ClientesCadastrados as $value) {
																			
																		echo "<option value='".str_replace($comAcentos, $semAcentos, $value)."'>";	
																	}
																?>
															</datalist>
		          											<label for="BuscarNomeCliente">Digite o nome do cliente</label>
        												</div>
														
														<div class="input-field col s10 offset-s1">
															<button class="btn btn-large waves-effect waves-light waves-effect waves-light grey darken-3" style="width: 100%;" type="submit" name="cliente">Buscar cliente
    															<i class="material-icons left">search</i>
		  													</button>
														</div>
													
													</div>	
												</form>
											</div>
      								</div>
    							</div>
							</div>
						</div>
					<?php
						break;
						
					case 'mostrarCliente':
					?>	
							
						<div class="container-fluid DoNotPrint" style="width: 90%; margin: 0 5%;"> 
							
							<div class="row">
								<div class="col s12">
									<div class="card-panel white center">
										
										<?php
											
											if(isset($_POST['SearchClient'])):
												
												$DadosDoCliente = getClientData($_POST['SearchClient']);																						
													
												while($row = $DadosDoCliente->fetch_assoc())
												{	
													$ID				= $row['ID'];
													$Nome 			= $row['Nome'];
													$Telefone 		= $row['Telefone'];
													$CEP 			= $row['CEP'];
													$Rua 			= $row['Rua'];
													$Numero 		= $row['Numero'];
													$Bairro 		= $row['Bairro'];
													$Cidade 		= $row['Cidade'];
													$Complemento	= empty($row['Complemento']) ? "Sem Complemento" : $row['Complemento'];
													$Referencia 	= $row['PontoReferencia'];
												}
												
												$EnderecoCompleto = $Rua.", ".$Numero." - ".$Bairro;
												
											?>
											
										<div class="row" style="margin: 0;">
							
											<div class="col m6 s12">
								
												<div class="row">
													<center>
														<h5><b>Cliente:</b></h5>
														<h5> <?php echo $Nome; ?> </h5>
													</center>
												</div>
																	
												<div class="row">
													
													<div class="col m5 s10 offset-s1 offset-m1">
														<small><b>Endereço:</b></small>
														<p> <?php echo $EnderecoCompleto; ?> </p>
													</div>
													
													<div class="col m5 s10 offset-s1">
														<small><b>Complemento:</b></small>
														<p> <?php echo $Complemento; ?> </p>
													</div>
												
												</div>
												
												<div class="row">
												
													<div class="col m5 s10 offset-s1 offset-m1">
														<small><b>Ponto de Referência:</b></small>
														<p> <?php echo $Referencia; ?> </p>
													</div>			
													
													<div class="col m5 s10 offset-s1">
														<small><b>Telefone:</b></small>
														<p> <?php echo $Telefone; ?> </p>
													</div>		
														
												</div>
												
											</div>
												
											<div class="col m6 s12">
												
												<div class="row">
											
													<div class="input-field col s12">
														<button style="width: 100%;" onClick="window.print()" class="btn btn-large waves-effect dark-waves grey darken-3">
															Imprimir
															<i class="material-icons left">print</i>
														</button>
													</div>	
													
													<div class="input-field col s12">
														<a href="../" style="width: 100%;" class="btn btn-large waves-effect dark-waves grey darken-3 disabled">
															Adicionar Pedido
															<i class="material-icons left">post_add</i>
														</a>
													</div>
													
													<div class="input-field col s12">
														<form action="./" method="POST">
															<input type="hidden" name="editar" value="<?php echo $Nome ?>" />
															<button type="submit" style="width: 100%;" class="btn btn-large waves-effect dark-waves grey darken-3">
																Editar Dados
																<i class="material-icons left">edit</i>
															</button>
														</form>
													</div>
													
													<div class="input-field col s12">
														<a href="./" style="width: 100%;" class="btn btn-large waves-effect dark-waves grey darken-3">
															Voltar
															<i class="material-icons left">keyboard_return</i>
														</a>
													</div>
														
												</div>
												
											</div>
								
										</div>
										
										<?php
										else:
											echo "<i class='material-icons medium'> check_circle </i> <br> Entre com um nome válido!";
										endif;
										?>
										
									</div>
								</div>
							</div>
						</div>	
							
					<?php
							break;
						
						case 'cadastrarCliente':	
					?>
						
						<div class="container-fluid" style="width: 90%; margin: 0 5%;">
							
							<div class="row">
								<div class="col s12">
      								<div class="card-panel white center">
									
									<?php
									if(isset($_POST['submited'])):
										
										$Nome			= mb_convert_case($_POST['NomeCliente'], MB_CASE_TITLE, "UTF-8");
										$Telefone		= $_POST['TelefoneCliente'];
										$CEP			= $_POST['CEPEnderecoCliente'];
										$Rua			= $_POST['RuaEnderecoCliente'];
										$Numero			= $_POST['NumEnderecoCliente'];
										$Bairro			= $_POST['BairroEnderecoCliente'];
										$Cidade			= $_POST['CidadeEnderecoCliente'];
										
										$Complemento = empty($_POST['ComplementoEnderecoCliente']) 	? "Sem Complemento" 		: $_POST['ComplementoEnderecoCliente'];
										$Referencia  = empty($_POST['PontoDeReferencia']) 			? "Sem Ponto de Referência" : $_POST['PontoDeReferencia'];
										
										$Retorno = sendClientData($Nome, $Telefone, $CEP, $Rua, $Numero, $Cidade, $Bairro, $Complemento, $Referencia);
										
										switch($Retorno[0]){
											
											case 100:
												echo "<i class='material-icons medium'> check_circle </i> <br> Cliente cadastrado com sucesso!";
												break;
											
											case 101:
												echo "<i class='material-icons medium'> warning </i> <br> Este usuário já se encontra cadastrado no sistema!";
												break;
											
											case 102:
												echo "<i class='material-icons medium'> warning </i> <br> O telefone está incompleto!";	
												break;

											case 103:
												echo "<i class='material-icons medium'> error </i> <br> Cliente não foi cadastrado devido à um erro.";
												break;
										}

										if($Retorno[0] == 101 || $Retorno[0] == 102 || $Retorno[0] == 103 ):
											
											echo "
												<form method='POST' action='./' id='CallBack' >
													<input type='hidden' value='".$Retorno[1]."' 	name='NomeBack' />
													<input type='hidden' value='".$Retorno[2]."' 	name='TelefoneBack' />
													<input type='hidden' value='".$Retorno[3]."' 	name='CepBack' />
													<input type='hidden' value='".$Retorno[4]."' 	name='RuaBack' />
													<input type='hidden' value='".$Retorno[5]."' 	name='NumeroBack' />
													<input type='hidden' value='".$Retorno[6]."' 	name='BairroBack' />
													<input type='hidden' value='".$Retorno[7]."' 	name='CidadeBack' />
													<input type='hidden' value='".$Retorno[8]."' 	name='ComplementoBack' />
													<input type='hidden' value='".$Retorno[9]."'	name='ReferenciaBack' />
													<input type='hidden'  name='cadastrar' />
												
													<script>
														setTimeout(function(){
															document.getElementById('CallBack').submit();
														}, 2000);
													</script>
											
												</form>
											";
											
										else:
											
											echo "
												<form method='POST' action='./' id='refresh' >
													<input type='hidden'  name='cadastrar' />

													<script>
														setTimeout(function(){
															document.getElementById('refresh').submit();
														}, 2000);
													</script>
												</form>
											";											
											
										endif;
										
																			
									else:										
									?>
										
										<div class="row">
											
											<div class="col s12 center">
												
												<h5>Cadastrar novo cliente</h5>
												
												<b>
													<small class="red-text">	
														Todos os campos com (*) são obrigatórios!
													</small>
													<br />										
													<small class="green-text text-darken-3">
														O CEP não é obrigatório, mas facilita o preenchimento dos dados na hora do cadastramento.
													</small>
												</b>
												
											</div>
											
											<div class="col s12 center">
												
												<form action="./" autocomplete="off" method="POST">
													<div class="row">
								
														<div class="input-field col s10 offset-s1">
		          											<input name="NomeCliente" 				id="NomeCliente" 			type="text"	class="validate center"	value="<?php echo $NomeBack ?>" style="text-transform:capitalize;"	autocomplete="off"	required>
          													<label for="NomeCliente" class="grey-text text-darken-2">Nome do cliente*</label>
        												</div>
														
														<div class="input-field col s6 offset-s1">
															<input name="TelefoneCliente" 			id="TelefoneCliente" 		type="text" class="validate center" 	value="<?php echo $TelefoneBack ?>" maxlength="15"	required>
															<label for="TelefoneCliente" class="grey-text text-darken-2">Telefone*</label>
														</div>
														
														<div class="input-field col s4">
															<input name="CEPEnderecoCliente"		id="CepCliente" 			type="text" class="validate center" 	value="<?php echo $CepBack ?>" maxlength="8" onblur="pesquisacep(this.value);" >
															<label for="CepCliente" class="grey-text text-darken-2">CEP</label>
														</div>
													
														<div class="input-field col s7 offset-s1">
															<input name="RuaEnderecoCliente"		id="EnderecoCliente" 		type="text" class="validate center" 	value="<?php echo $RuaBack ?>"		required>
															<label for="EnderecoCliente" class="grey-text text-darken-2">Endereço*</label>
														</div>
														
														<div class="input-field col s3">
															<input name="NumEnderecoCliente" 		id="NumEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $NumeroBack ?>" maxlength="5"	required>
															<label for="NumEnderecoCliente" class="grey-text text-darken-2">Numero*</label>
														</div>
														
														<div class="input-field col s5 offset-s1">
															<input name="BairroEnderecoCliente"		id="BairroEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $BairroBack ?>"	required>
															<label for="BairroEnderecoCliente" class="grey-text text-darken-2">Bairro*</label>
														</div>
														
														<div class="input-field col s5">
															<input name="CidadeEnderecoCliente" 	id="CidadeEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $CidadeBack ?>"	required>
															<label for="CidadeEnderecoCliente" class="grey-text text-darken-2">Cidade*</label>
														</div>
														
														<div class="input-field col s10 offset-s1">
															<input name="ComplementoEnderecoCliente" 	id="ComplementoEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $ComplementoBack ?>">
															<label for="ComplementoEnderecoCliente" class="grey-text text-darken-2">Complemento</label>
														</div>
														
														<!--
														<div class="input-field col s10 m5 offset-s1">
			    											<select name="EstadoEnderecoCliente"	id="EstadoEnderecoCliente"				class="validate center" 	value="<?php echo $EstadoBack ?>"	required>
																<option>  </option>
																<option value="AC">	Acre    			</option>
																<option value="AL">	Alagoas				</option>
																<option value="AP">	Amapá				</option>
																<option value="AM">	Amazonas			</option>
																<option value="BA">	Bahia				</option>
																<option value="CE">	Ceará				</option>
																<option value="DF">	Distrito Federal	</option>
																<option value="ES">	Espírito Santo		</option>
																<option value="GO">	Goiás				</option>
																<option value="MA">	Maranhão			</option>
																<option value="MT">	Mato Grosso			</option>
																<option value="MS">	Mato Grosso do Sul	</option>
																<option value="MG">	Minas Gerais		</option>
																<option value="PA">	Pará				</option>
																<option value="PB">	Paraíba				</option>
																<option value="PR">	Paraná				</option>
																<option value="PE">	Pernambuco			</option>
																<option value="PI">	Piauí				</option>
																<option value="RJ">	Rio de Janeiro		</option>
																<option value="RN">	Rio Grande do Norte	</option>
																<option value="RS">	Rio Grande do Sul	</option>
																<option value="RO">	Rondônia			</option>
																<option value="RR">	Roraima				</option>
																<option value="SC">	Santa Catarina		</option>
																<option value="SP">	São Paulo			</option>
																<option value="SE">	Sergipe				</option>
																<option value="TO">	Tocantins			</option>
															</select>
															<label for="EstadoEnderecoCliente">Estado</label>
  														</div>
														-->
														
														<div class="input-field col s10 offset-s1">
															<input name="PontoDeReferencia" 	id="PontoDeReferencia" 	type="text" class="validate center" 	value="<?php echo $ReferenciaBack ?>">
															<label for="PontoDeReferencia" class="grey-text text-darken-2"> Ponto de Referência </label>
														</div>

														<input type="hidden" name="submited" />
														<input type="hidden" name="cadastrar" />

														<div class="input-field col s10 offset-s1">
															<button class="btn btn-large waves-effect waves-light grey darken-3" style="width: 100%;" type="submit">
																Cadastrar cliente	<i class="material-icons left">person_add</i>
  															</button>
														</div>
														
													</div>
												</form>
												
											</div>
										
										</div>
									
									<?php
									endif;
									?>
										
									</div>
								</div>
							</div>

						</div>
											
					<?php
							break;
						
						case 'editar':	

					?>
						
						<div class="container-fluid" style="width: 90%; margin: 0 5%;">
							
							<div class="row">
								<div class="col s12">
      								<div class="card-panel white center">
									
									<?php
										if(isset($_POST['delete'])):
											
											$ID = $_POST['delete'];
											$Retorno = deleteClientData($ID);

											switch($Retorno[0]){
											
												case 300:
													echo "<i class='material-icons medium'> check_circle </i> <br> Cliente deletado com sucesso!";
													break;
												
												case 301:
													echo "
														<i class='material-icons medium'> error </i> <br> 
														O cliente não foi deletado por algum problema de conexão. <br> 
														<small class='red-text'> <b> tente novamente </b> </small>";	
													break;
												}

												echo "
													<script>
														setTimeout(function(){
															window.location.href = './';
														}, 2000);
													</script>
												";	

										elseif(isset($_POST['update'])):

											$IDBack				= $_POST['IDUpdate'];
											$NomeBack			= mb_convert_case($_POST['NomeUpdate'], MB_CASE_TITLE, "UTF-8");
											$TelefoneBack		= $_POST['TelefoneUpdate'];
											$CEPBack			= $_POST['CepUpdate'];
											$RuaBack			= $_POST['RuaUpdate'];
											$NumeroBack			= $_POST['NumeroUpdate'];
											$BairroBack			= $_POST['BairroUpdate'];
											$CidadeBack			= $_POST['CidadeUpdate'];
										
											$ComplementoBack = empty($_POST['ComplementoUpdate']) 	? "Sem Complemento" 		: $_POST['ComplementoUpdate'];
											$ReferenciaBack  = empty($_POST['ReferenciaUpdate']) 	? "Sem Ponto de Referência" : $_POST['ReferenciaUpdate'];
										
											$Retorno = updateClientData($IDBack, $NomeBack, $TelefoneBack, $CEPBack, $RuaBack, $NumeroBack, $CidadeBack, $BairroBack, $ComplementoBack, $ReferenciaBack);
											
											switch($Retorno[0]){
											
												case 200:
													echo "<i class='material-icons medium'> check_circle </i> <br> Cliente atualizado com sucesso!";
													break;
												
												case 201:
													echo "
														<i class='material-icons medium'> warning </i> <br> 
														O telefone está incompleto. <br> 
														<small class='red-text'> <b> As alterações não foram salvas </b> </small>";	
													break;
	
												case 102:
													echo "
														<i class='material-icons medium'> error </i> <br> 
														Cliente não foi atualizado devido à um erro.
														<small class='red-text'> <b> As alterações não foram salvas </b> </small>";
													break;
											}

											if($Retorno[0] == 201 || $Retorno[0] == 202 ):
											
												echo "
													<form method='POST' action='./' id='CallBack' >
														<input type='hidden'  name='editar' value='".$Retorno[1]."'/>
													
														<script>
															setTimeout(function(){
																document.getElementById('CallBack').submit();
															}, 2000);
														</script>
												
													</form>
												";
												
											else:
												echo "
													<form method='POST' action='./' id='refresh' >
														<input type='hidden'  name='editar' value='".$Retorno[1]."' />
	
														<script>
															setTimeout(function(){
																document.getElementById('refresh').submit();
															}, 2000);
														</script>
													</form>
												";											
												
											endif;

										else:

											$dadosClientEdit = getClientData($_POST['editar']);																						

											while($row = $dadosClientEdit->fetch_assoc())
											{	
												$IDBack				= $row['ID'];
												$NomeBack 			= $row['Nome'];
												$TelefoneBack 		= $row['Telefone'];
												$CEPBack 			= $row['CEP'];
												$RuaBack 			= $row['Rua'];
												$NumeroBack 		= $row['Numero'];
												$BairroBack 		= $row['Bairro'];
												$CidadeBack 		= $row['Cidade'];
												$ComplementoBack	= empty($row['Complemento']) ? "Sem Complemento" : $row['Complemento'];
												$ReferenciaBack 	= $row['PontoReferencia'];
											}
									?>
									
										<div class="row">
											
											<div class="col s12 center">
												
												<h5>Atualizar dados do cliente</h5>
												
												<b>
													<small class="red-text">	
														Todos os campos com (*) são obrigatórios!
													</small>
													<br />										
													<small class="green-text text-darken-3">
														O CEP não é obrigatório, mas facilita o preenchimento dos dados.
													</small>
												</b>
												
											</div>
											
											<div class="col s12 center">
												
												<form action="./" autocomplete="off" method="POST">
													<div class="row">
								
														<div class="input-field col s10 offset-s1">
		          											<input name="NomeUpdate" 				id="NomeCliente" 			type="text"	class="validate center"	value="<?php echo $NomeBack ?>" style="text-transform:capitalize;"	autocomplete="off"	required>
          													<label for="NomeCliente" class="grey-text text-darken-2">Nome do cliente*</label>
        												</div>
														
														<div class="input-field col s6 offset-s1">
															<input name="TelefoneUpdate" 			id="TelefoneCliente" 		type="text" class="validate center" 	value="<?php echo $TelefoneBack ?>" maxlength="15"	required>
															<label for="TelefoneCliente" class="grey-text text-darken-2">Telefone*</label>
														</div>
														
														<div class="input-field col s4">
															<input name="CepUpdate"		id="CepCliente" 			type="text" class="validate center" 	value="<?php echo $CEPBack ?>" maxlength="8" onblur="pesquisacep(this.value);" >
															<label for="CepCliente" class="grey-text text-darken-2">CEP</label>
														</div>
													
														<div class="input-field col s7 offset-s1">
															<input name="RuaUpdate"		id="EnderecoCliente" 		type="text" class="validate center" 	value="<?php echo $RuaBack ?>"		required>
															<label for="EnderecoCliente" class="grey-text text-darken-2">Endereço*</label>
														</div>
														
														<div class="input-field col s3">
															<input name="NumeroUpdate" 		id="NumEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $NumeroBack ?>" maxlength="5"	required>
															<label for="NumEnderecoCliente" class="grey-text text-darken-2">Numero*</label>
														</div>
														
														<div class="input-field col s5 offset-s1">
															<input name="BairroUpdate"		id="BairroEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $BairroBack ?>"	required>
															<label for="BairroEnderecoCliente" class="grey-text text-darken-2">Bairro*</label>
														</div>
														
														<div class="input-field col s5">
															<input name="CidadeUpdate" 	id="CidadeEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $CidadeBack ?>"	required>
															<label for="CidadeEnderecoCliente" class="grey-text text-darken-2">Cidade*</label>
														</div>
														
														<div class="input-field col s10 offset-s1">
															<input name="ComplementoUpdate" 	id="ComplementoEnderecoCliente" 	type="text" class="validate center" 	value="<?php echo $ComplementoBack ?>">
															<label for="ComplementoEnderecoCliente" class="grey-text text-darken-2">Complemento</label>
														</div>
														
														<!--
														<div class="input-field col s10 m5 offset-s1">
			    											<select name="EstadoEnderecoCliente"	id="EstadoEnderecoCliente"				class="validate center" 	value="<?php echo $EstadoBack ?>"	required>
																<option>  </option>
																<option value="AC">	Acre    			</option>
																<option value="AL">	Alagoas				</option>
																<option value="AP">	Amapá				</option>
																<option value="AM">	Amazonas			</option>
																<option value="BA">	Bahia				</option>
																<option value="CE">	Ceará				</option>
																<option value="DF">	Distrito Federal	</option>
																<option value="ES">	Espírito Santo		</option>
																<option value="GO">	Goiás				</option>
																<option value="MA">	Maranhão			</option>
																<option value="MT">	Mato Grosso			</option>
																<option value="MS">	Mato Grosso do Sul	</option>
																<option value="MG">	Minas Gerais		</option>
																<option value="PA">	Pará				</option>
																<option value="PB">	Paraíba				</option>
																<option value="PR">	Paraná				</option>
																<option value="PE">	Pernambuco			</option>
																<option value="PI">	Piauí				</option>
																<option value="RJ">	Rio de Janeiro		</option>
																<option value="RN">	Rio Grande do Norte	</option>
																<option value="RS">	Rio Grande do Sul	</option>
																<option value="RO">	Rondônia			</option>
																<option value="RR">	Roraima				</option>
																<option value="SC">	Santa Catarina		</option>
																<option value="SP">	São Paulo			</option>
																<option value="SE">	Sergipe				</option>
																<option value="TO">	Tocantins			</option>
															</select>
															<label for="EstadoEnderecoCliente">Estado</label>
  														</div>
														-->
														
														<div class="input-field col s10 offset-s1">
															<input name="ReferenciaUpdate" 	id="PontoDeReferencia" 	type="text" class="validate center" 	value="<?php echo $ReferenciaBack ?>">
															<label for="PontoDeReferencia" class="grey-text text-darken-2"> Ponto de Referência </label>
														</div>

														<input type="hidden" name="IDUpdate" value="<?php echo $IDBack;?>" />
														<input type="hidden" name="editar" value="<?php echo $NomeBack; ?>" />

														<div class="input-field col s5 offset-s1">
															<button class="btn btn-large waves-effect waves-light green darken-4" style="width: 100%;" type="submit" name="update">
																Atualizar Cadastro	<i class="material-icons left">refresh</i>
  															</button>
														</div>
													
													</form>

														<div class="input-field col s5">
															<a href="#modal1" class="btn btn-large modal-trigger waves-effect waves-light red darken-4" style="width: 100%;">
																Deletar Cadastro	<i class="material-icons left">delete</i>
  															</a>
														</div>

														<div class="input-field col s10 offset-s1">
															<form href="./" method="POST" >
																<input type="hidden" name="SearchClient" value="<?php echo $NomeBack; ?>">
																<button type="submit" name="cliente" style="width: 100%;" class="btn btn-large waves-effect dark-waves grey darken-3">
																	Voltar
																	<i type="button"  class="material-icons left">keyboard_return</i>
																</button>
															</form>
														</div>
														
													</div>
												
												
												<!-- Modal Structure -->
												<div id="modal1" class="modal">
													<div class="modal-content center">
							      			
											  			<i style="padding: 10px" class="material-icons medium red-text">warning</i> 
														<h5> Apagar registro?</h5>

														<p>Esta ação fará com que todos os dados deste cliente sejam excluidos, deseja continuar?</p>
													</div>
													<div class="modal-footer">
														<a href="" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
														<form action="./" method="POST">
															<input type="hidden" name="editar" />
															<input type="hidden" name="delete" value="<?php echo $IDBack?>" />
															<button type="submit" class="modal-close waves-effect waves-green btn-flat">Excluir</button>
														</form>
													</div>
												</div>

											</div>
										
										</div>
										
										<?php
										endif;
										?>

									</div>
								</div>
							</div>

						</div>
											
					<?php
							break;
							
						case 'listaClientes':
					?>
						
						<div class="container-fluid" style="width: 90%; margin: 0 5%;">
							
							<div class="row">
								<div class="col s12">
      								<div class="card-panel white center">
										
										<div class="row">
											<h5 class="center">Lista de clientes</h5>
										</div>
								
										<?php
										$ClientesCadastrados = Array();
										
										$sqlClientesCadastrados = "SELECT ID, Nome FROM clientes ORDER BY ID ASC";										
										$Clientes = mysqli_query($ConnectDB, $sqlClientesCadastrados);
										
										$num_results = mysqli_num_rows($Clientes);			
																														
										if($num_results > 0):	
											
											echo "<div class='collection'>";

											while($row = $Clientes->fetch_assoc()) {
												echo "
													<form action='./' method='POST' name='Client".$row['ID']."'>
														<input type='hidden' name='SearchClient' value='".$row['Nome']."' />

														<button type='submit' name='cliente' class='collection-item waves-effect waves-dark' style='border: none; border-bottom: 1px solid #999; width: 100%;'>
															".$row['Nome']."
														</button>
													</form>
													";
											}

											echo "</div>";
											
										else:
											echo "
												<div class='row' padding: 12px 0;'>
													<div class='col s10 offset-s1 center'>
														<h6> Ainda não há nada por aqui, mas você pode <a href='./#Cadastrar'> Cadastrar um novo cliente </a> :) </h6>
													</div>
												</div>
											";
										endif;
										
										?>
										
									</div>
								</div>
							</div>

						</div>
						
					<?php
							break;
					}
					?>
										
				</div>	
				
			</div>
			
		</main>
		
		<div style="border 1px" class="CardPrint print">
											
			<style>
				.title{margin: 10px 0 5px 0; border-bottom: 1px solid #333;}
				.content{ margin: 0 10px; }
				.complemento{ margin: 0 15px; padding: 0; text-align: justify; }
			</style>
			
			<img style="width: 40%; margin: 0 30%;" src="./img/logo.png"/>
			
			<br />
			
			<p class="title">	<small><b>Cliente:</b></small>	</p>
			<p class="content"> <?php echo $Nome; ?> </p>
			
			
			<p class="title">	<small><b>Endereço:</b></small>	</p>
			<p class="content"> <?php echo $EnderecoCompleto; ?> </p>
			<p class="complemento">  
				<small> 
					<strong> complemento: </strong> 
					<i> <?php echo $Complemento; ?> </i>
				</small>
			</p>
			
			
			<p class="title">	<small><b>Ponto de Referência:</b></small>	</p>
			<p class="content"> <?php echo $Referencia; ?> </p>
			
			
			<p class="title">	<small><b>Telefone para contato:</b></small>	</p>
			<p class="content"> <?php echo $Telefone; ?> </p>
			
			
		</div>
		
		<!--JavaScript at end of body for optimized loading-->
		<script src="//code.jquery.com/jquery-2.1.4.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script type="text/javascript"	src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
		<script	type="text/javascript" 	src="./js/mask.js"></script>
		<script>
			$(document).ready(function(){
    			$('.tooltipped').tooltip();
				$('select').formSelect();
				$('.tabs').tabs();
				$('.modal').modal();
  			});
		</script>
	</body>
</html>