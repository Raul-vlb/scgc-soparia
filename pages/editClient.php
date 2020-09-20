<div class="container-fluid" style="width: 90%; margin: 0 5%;">

    <div class="row">
        <div class="col s12">
            <div class="card-panel white center">

                <?php
                if (isset($_POST['delete'])) :

                    $ID = $_POST['delete'];
                    $ClientService = new ClientServices();
                    $Retorno = $ClientService->deleteClientData($ID);

                    switch ($Retorno[0]) {
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
						</script>";

                elseif (isset($_POST['update'])) :

                    $IDBack         = $_POST['IDUpdate'];
                    $NomeBack       = mb_convert_case($_POST['NomeUpdate'], MB_CASE_TITLE, "UTF-8");
                    $TelefoneBack   = $_POST['TelefoneUpdate'];
                    $CEPBack        = $_POST['CepUpdate'];
                    $RuaBack        = $_POST['RuaUpdate'];
                    $NumeroBack     = $_POST['NumeroUpdate'];
                    $BairroBack     = $_POST['BairroUpdate'];
                    $CidadeBack     = $_POST['CidadeUpdate'];

                    $ComplementoBack = empty($_POST['ComplementoUpdate'])   ? "Sem Complemento"         : $_POST['ComplementoUpdate'];
                    $ReferenciaBack  = empty($_POST['ReferenciaUpdate'])    ? "Sem Ponto de Referência" : $_POST['ReferenciaUpdate'];

                    $ClientService = new ClientServices();                    
                    $Retorno = $ClientService->updateClientData($IDBack, $NomeBack, $TelefoneBack, $CEPBack, $RuaBack, $NumeroBack, $CidadeBack, $BairroBack, $ComplementoBack, $ReferenciaBack);

                    switch ($Retorno[0]) {

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

                    if ($Retorno[0] == 201 || $Retorno[0] == 202) :
                        echo "
							<form method='POST' action='./' id='CallBack' >
								<input type='hidden'  name='editar' value='" . $Retorno[1] . "'/>
													
									<script>
										setTimeout(function(){
											document.getElementById('CallBack').submit();
										}, 2000);
									</script>
												
							</form>";
                    else :
                        echo "
							<form method='POST' action='./' id='refresh' >
								<input type='hidden'  name='editar' value='" . $Retorno[1] . "' />
	
								<script>
									setTimeout(function(){
										document.getElementById('refresh').submit();
									}, 2000);
								</script>
							</form>";
                    endif;

                else :
                    $ClientService = new ClientServices();
                    $DadosDoCliente = $ClientService->getClientData($_POST['editar']);

                    if ($DadosDoCliente[0] == 000) :

                        while ($row = $DadosDoCliente[1]->fetch_assoc()) {
                            $IDBack             = $row['ID'];
                            $NomeBack           = $row['Nome'];
                            $TelefoneBack       = $row['Telefone'];
                            $CEPBack            = $row['CEP'];
                            $RuaBack            = $row['Rua'];
                            $NumeroBack         = $row['Numero'];
                            $BairroBack         = $row['Bairro'];
                            $CidadeBack         = $row['Cidade'];
                            $ComplementoBack    = empty($row['Complemento']) ? "Sem Complemento" : $row['Complemento'];
                            $ReferenciaBack     = $row['PontoReferencia'];
                        }

                    endif;
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
                                        <input name="NomeUpdate" id="NomeCliente" type="text" class="validate center" value="<?php echo $NomeBack ?>" style="text-transform:capitalize;" autocomplete="off" required>
                                        <label for="NomeCliente" class="grey-text text-darken-2">Nome do cliente*</label>
                                    </div>

                                    <div class="input-field col s6 offset-s1">
                                        <input name="TelefoneUpdate" id="TelefoneCliente" type="text" class="validate center" value="<?php echo $TelefoneBack ?>" maxlength="15" required>
                                        <label for="TelefoneCliente" class="grey-text text-darken-2">Telefone*</label>
                                    </div>

                                    <div class="input-field col s4">
                                        <input name="CepUpdate" id="CepCliente" type="text" class="validate center" value="<?php echo $CEPBack ?>" maxlength="8" onblur="pesquisacep(this.value);">
                                        <label for="CepCliente" class="grey-text text-darken-2">CEP</label>
                                    </div>

                                    <div class="input-field col s7 offset-s1">
                                        <input name="RuaUpdate" id="EnderecoCliente" type="text" class="validate center" value="<?php echo $RuaBack ?>" required>
                                        <label for="EnderecoCliente" class="grey-text text-darken-2">Endereço*</label>
                                    </div>

                                    <div class="input-field col s3">
                                        <input name="NumeroUpdate" id="NumEnderecoCliente" type="text" class="validate center" value="<?php echo $NumeroBack ?>" maxlength="5" required>
                                        <label for="NumEnderecoCliente" class="grey-text text-darken-2">Numero*</label>
                                    </div>

                                    <div class="input-field col s5 offset-s1">
                                        <input name="BairroUpdate" id="BairroEnderecoCliente" type="text" class="validate center" value="<?php echo $BairroBack ?>" required>
                                        <label for="BairroEnderecoCliente" class="grey-text text-darken-2">Bairro*</label>
                                    </div>

                                    <div class="input-field col s5">
                                        <input name="CidadeUpdate" id="CidadeEnderecoCliente" type="text" class="validate center" value="<?php echo $CidadeBack ?>" required>
                                        <label for="CidadeEnderecoCliente" class="grey-text text-darken-2">Cidade*</label>
                                    </div>

                                    <div class="input-field col s10 offset-s1">
                                        <input name="ComplementoUpdate" id="ComplementoEnderecoCliente" type="text" class="validate center" value="<?php echo $ComplementoBack ?>">
                                        <label for="ComplementoEnderecoCliente" class="grey-text text-darken-2">Complemento</label>
                                    </div>

                                    <div class="input-field col s10 offset-s1">
                                        <input name="ReferenciaUpdate" id="PontoDeReferencia" type="text" class="validate center" value="<?php echo $ReferenciaBack ?>">
                                        <label for="PontoDeReferencia" class="grey-text text-darken-2"> Ponto de Referência </label>
                                    </div>

                                    <input type="hidden" name="IDUpdate" value="<?php echo $IDBack; ?>" />
                                    <input type="hidden" name="editar" value="<?php echo $NomeBack; ?>" />

                                    <div class="input-field col s5 offset-s1">
                                        <button class="btn btn-large waves-effect waves-light green darken-4" style="width: 100%;" type="submit" name="update">
                                            Atualizar Cadastro <i class="material-icons left">refresh</i>
                                        </button>
                                    </div>

                            </form>

                            <div class="input-field col s5">
                                <a href="#modal1" class="btn btn-large modal-trigger waves-effect waves-light red darken-4" style="width: 100%;">
                                    Deletar Cadastro <i class="material-icons left">delete</i>
                                </a>
                            </div>

                            <div class="input-field col s10 offset-s1">
                                <form href="./" method="POST">
                                    <input type="hidden" name="SearchClient" value="<?php echo $NomeBack; ?>">
                                    <button type="submit" name="cliente" style="width: 100%;" class="btn btn-large waves-effect dark-waves grey darken-3">
                                        Voltar
                                        <i class="material-icons left">keyboard_return</i>
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

                                <form action="./" method="POST">
                                    <input type="hidden" name="editar" />
                                    <input type="hidden" name="delete" value="<?php echo $IDBack ?>" />
                                    <button type="submit" class=" waves-effect waves-green btn-flat">Excluir</button>
                                    <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
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