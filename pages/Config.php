<div class="container-fluid" style="width: 100%; min-height: 100vh;">

    <div class="row" style="margin-bottom: 0;">
        <div class="col s12">
            <div class="card-panel white center" style="min-height: 98vh; margin-bottom: 0;">

                <div class="row">

                    <div class="col s6">

                        <h5>Disposiçao dos clientes na cidade:</h5>

                        <ul class="collapsible">

                            <?php
                            $configService = new ConfigService();
                            $retorno = $configService->getEstatisticasBairros();
                            foreach ($retorno as $bairro) {
                                $totalClientes = $configService->getTotalClientesPorBairro($bairro);
                            ?>

                                <li>
                                    <div class="collapsible-header grey lighten-2"><?php echo $bairro; ?></div>
                                    <div class="collapsible-body left-align"><span><?php echo ($totalClientes > 1) ? $totalClientes . ' clientes' : $totalClientes . ' cliente'; ?> cadastrados aqui</span></div>
                                </li>

                            <?php
                            }
                            ?>

                        </ul>

                    </div>

                    <div class="col s6">
                            
                            oq vai aqui?

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>