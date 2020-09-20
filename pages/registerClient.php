<div class="container-fluid" style="width: 90%; margin: 0 5%;">

    <div class="row">
        <div class="col s12">
            <div class="card-panel white center">

                <?php
                if (isset($_POST['submited'])) :

                    $Nome       = mb_convert_case($_POST['NomeCliente'], MB_CASE_TITLE, "UTF-8");
                    $Telefone   = $_POST['TelefoneCliente'];
                    $CEP        = $_POST['CEPEnderecoCliente'];
                    $Rua        = $_POST['RuaEnderecoCliente'];
                    $Numero     = $_POST['NumEnderecoCliente'];
                    $Bairro     = $_POST['BairroEnderecoCliente'];
                    $Cidade     = $_POST['CidadeEnderecoCliente'];

                    $Complemento = empty($_POST['ComplementoEnderecoCliente'])  ? "Sem Complemento"         : $_POST['ComplementoEnderecoCliente'];
                    $Referencia  = empty($_POST['PontoDeReferencia'])           ? "Sem Ponto de Referência" : $_POST['PontoDeReferencia'];
                    
                    $ClientService = new ClientServices();
                    $Retorno = $ClientService->sendClientData($Nome, $Telefone, $CEP, $Rua, $Numero, $Bairro, $Cidade, $Complemento, $Referencia);

                    switch ($Retorno[0]) {

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

                    if ($Retorno[0] >= 101 && $Retorno[0] <= 103) :

                        echo "
							<form method='POST' action='./' id='CallBack' >
								<input type='hidden' value='" . $Retorno[1] . "' 	name='NomeBack' />
								<input type='hidden' value='" . $Retorno[2] . "' 	name='TelefoneBack' />
								<input type='hidden' value='" . $Retorno[3] . "' 	name='CepBack' />
								<input type='hidden' value='" . $Retorno[4] . "' 	name='RuaBack' />
								<input type='hidden' value='" . $Retorno[5] . "' 	name='NumeroBack' />
								<input type='hidden' value='" . $Retorno[6] . "' 	name='BairroBack' />
								<input type='hidden' value='" . $Retorno[7] . "' 	name='CidadeBack' />
								<input type='hidden' value='" . $Retorno[8] . "' 	name='ComplementoBack' />
								<input type='hidden' value='" . $Retorno[9] . "'	name='ReferenciaBack' />
								<input type='hidden'  name='cadastrar' />
							
								<script>
									setTimeout(function(){
										document.getElementById('CallBack').submit();
									}, 2000);
								</script>
							</form>
						";

                    else :

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


                else :
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
                                        <input name="NomeCliente" id="NomeCliente" type="text" class="validate center" value="<?php echo $NomeBack ?>" style="text-transform:capitalize;" autocomplete="off" required>
                                        <label for="NomeCliente" class="grey-text text-darken-2">Nome do cliente*</label>
                                    </div>

                                    <div class="input-field col s6 offset-s1">
                                        <input name="TelefoneCliente" id="TelefoneCliente" type="text" class="validate center" value="<?php echo $TelefoneBack ?>" maxlength="15" required>
                                        <label for="TelefoneCliente" class="grey-text text-darken-2">Telefone*</label>
                                    </div>

                                    <div class="input-field col s4">
                                        <input name="CEPEnderecoCliente" id="CepCliente" type="text" class="validate center" value="<?php echo $CepBack ?>" maxlength="8" onblur="pesquisacep(this.value);">
                                        <label for="CepCliente" class="grey-text text-darken-2">CEP</label>
                                    </div>

                                    <div class="input-field col s7 offset-s1">
                                        <input name="RuaEnderecoCliente" id="EnderecoCliente" type="text" class="validate center" value="<?php echo $RuaBack ?>" required>
                                        <label for="EnderecoCliente" class="grey-text text-darken-2">Endereço*</label>
                                    </div>

                                    <div class="input-field col s3">
                                        <input name="NumEnderecoCliente" id="NumEnderecoCliente" type="text" class="validate center" value="<?php echo $NumeroBack ?>" maxlength="5" required>
                                        <label for="NumEnderecoCliente" class="grey-text text-darken-2">Numero*</label>
                                    </div>

                                    <div class="input-field col s5 offset-s1">
                                        <input name="BairroEnderecoCliente" id="BairroEnderecoCliente" type="text" class="validate center" value="<?php echo $BairroBack ?>" required>
                                        <label for="BairroEnderecoCliente" class="grey-text text-darken-2">Bairro*</label>
                                    </div>

                                    <div class="input-field col s5">
                                        <input name="CidadeEnderecoCliente" id="CidadeEnderecoCliente" type="text" class="validate center" value="<?php echo $CidadeBack ?>" required>
                                        <label for="CidadeEnderecoCliente" class="grey-text text-darken-2">Cidade*</label>
                                    </div>

                                    <div class="input-field col s10 offset-s1">
                                        <input name="ComplementoEnderecoCliente" id="ComplementoEnderecoCliente" type="text" class="validate center" value="<?php echo $ComplementoBack ?>">
                                        <label for="ComplementoEnderecoCliente" class="grey-text text-darken-2">Complemento</label>
                                    </div>

                                    <div class="input-field col s10 offset-s1">
                                        <input name="PontoDeReferencia" id="PontoDeReferencia" type="text" class="validate center" value="<?php echo $ReferenciaBack ?>">
                                        <label for="PontoDeReferencia" class="grey-text text-darken-2"> Ponto de Referência </label>
                                    </div>

                                    <input type="hidden" name="submited" />
                                    <input type="hidden" name="cadastrar" />

                                    <div class="input-field col s10 offset-s1">
                                        <button class="btn btn-large waves-effect waves-light grey darken-3" style="width: 100%;" type="submit">
                                            Cadastrar cliente <i class="material-icons left">person_add</i>
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