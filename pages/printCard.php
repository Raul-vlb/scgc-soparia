<div style="border: 1px" id="CardPrint" class="print">

    <img style="width: 40%; margin: 0 30%;" src="./img/logo.png" />

    <br />

    <p class="title">
        <small><b>Cliente:</b></small>
    </p>
    <p class="content">
        <?php echo $Nome; ?>
    </p>


    <p class="title">
        <small><b>Endereço:</b></small>
    </p>
    <p class="content">
        <?php echo $EnderecoCompleto; ?>
    </p>
    <p class="complemento">
        <small>
            <strong> complemento: </strong>
            <i> <?php echo $Complemento; ?> </i>
        </small>
    </p>


    <p class="title"> <small><b>Ponto de Referência:</b></small> </p>
    <p class="content"> <?php echo $Referencia; ?> </p>


    <p class="title"> <small><b>Telefone para contato:</b></small> </p>
    <p class="content"> <?php echo $Telefone; ?> </p>


</div>