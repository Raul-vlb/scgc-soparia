<div class="container-fluid" style="width: 90%; margin: 0 5%;">

    <div class="row">
        <div class="col s12">
            <div class="card-panel white center">

                <div class="row">
                    <h5 class="center">Lista de clientes</h5>
                </div>

                <?php
                $ClientesCadastrados = array();

                $sqlClientesCadastrados = "SELECT ID, Nome FROM clientes ORDER BY ID ASC";
                $Clientes = mysqli_query($ConnectDB, $sqlClientesCadastrados);

                $num_results = mysqli_num_rows($Clientes);

                if ($num_results > 0) :

                    echo "<div class='collection'>";

                    while ($row = $Clientes->fetch_assoc()) {
                        echo "
													<form action='./' method='POST' name='Client" . $row['ID'] . "'>
														<input type='hidden' name='SearchClient' value='" . $row['Nome'] . "' />

														<button type='submit' name='cliente' class='collection-item waves-effect waves-dark' style='border: none; border-bottom: 1px solid #999; width: 100%;'>
															" . $row['Nome'] . "
														</button>
													</form>
													";
                    }

                    echo "</div>";

                else :
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