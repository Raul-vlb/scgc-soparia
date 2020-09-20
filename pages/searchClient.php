<div class="container-fluid" style="width: 90%; margin: 0 5%;">

    <div class="row">
        <div class="col m12">
            <div class="card-panel white center">

                <div class="row">

                    <div class="col s12">
                        <center>
                            <h5>Buscar por cliente cadastrado</h5>
                        </center>
                    </div>

                    <div class="col s12">
                        <form action="./" autocomplete="off" method="POST">
                            <div class="row" style="margin-bottom: 0;">

                                <div class="input-field col s10 offset-s1">
                                    <input name="SearchClient" id="BuscarNomeCliente" style="text-transform:capitalize; width: 100%;" list="clientes" type="text" class="validate center" autocomplete="off" required>
                                    <datalist id="clientes">
                                        <?php
                                        $ClientesCadastrados = array();
                                        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
                                        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

                                        $sqlClientesCadastrados = "SELECT DISTINCT Nome FROM clientes";
                                        $Clientes = mysqli_query($ConnectDB, $sqlClientesCadastrados);
                                        if ($Clientes) :
                                            while ($row = $Clientes->fetch_assoc()) {
                                                array_push($ClientesCadastrados, $row['Nome']);
                                            }
                                        endif;

                                        foreach ($ClientesCadastrados as $value) {

                                            echo "<option value='" . str_replace($comAcentos, $semAcentos, $value) . "'>";
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