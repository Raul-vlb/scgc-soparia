<div class="container-fluid DoNotPrint" style="width: 90%; margin: 0 5%;">

    <div class="row">
        <div class="col s12">
            <div class="card-panel white center">

                <?php

                $nameSearch = ($_POST['SearchClient']) ? $_POST['SearchClient'] : "";
                $ClientService = new ClientServices();
                $DadosDoCliente = $ClientService->getClientData($nameSearch);

                if ($DadosDoCliente[0] == 000) :

                    while ($row = $DadosDoCliente[1]->fetch_assoc()) {
                        $ID             = $row['ID'];
                        $Nome           = $row['Nome'];
                        $Telefone       = $row['Telefone'];
                        $CEP            = $row['CEP'];
                        $Rua            = $row['Rua'];
                        $Numero         = $row['Numero'];
                        $Bairro         = $row['Bairro'];
                        $Cidade         = $row['Cidade'];
                        $Complemento    = empty($row['Complemento']) ? "Sem Complemento" : $row['Complemento'];
                        $Referencia     = $row['PontoReferencia'];
                    }

                    $EnderecoCompleto = $Rua . ", " . $Numero . " - " . $Bairro;
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
                                    <small><b>Telefone:</b></small>
                                    <p> <?php echo $Telefone; ?> </p>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col m5 s10 offset-s1 offset-m1">
                                    <small><b>Ponto de Referência:</b></small>
                                    <p> <?php echo $Referencia; ?> </p>
                                </div>
                                
                                <div class="col m5 s10 offset-s1">
                                    <small><b>Complemento:</b></small>
                                    <p> <?php echo $Complemento; ?> </p>
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
                elseif ($DadosDoCliente[0] == 001) :

                    echo "<i class='material-icons medium'> warning </i> <br> Cliente não cadastrado.";

                    echo "
						<script>
							setTimeout(function(){
								window.location.href = './';
								}, 2000);
							</script>
						";

                endif;
                ?>

            </div>
        </div>
    </div>
</div>