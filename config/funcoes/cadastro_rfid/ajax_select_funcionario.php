<?php

include '../../../conexao.php';

if (isset($_GET['matricula'])) {

    $matricula = $_GET['matricula'];
}

$sql = "SELECT fun.NM_FUNCIONARIO, fun.DS_FUNCAO,  
        fun.NM_SETOR, fun.CPF, rfid.CHAPA, rfid.RFID
        FROM dbamv.sta_tb_funcionario fun
        LEFT JOIN dbamv.funcionario_rfid rfid
        ON fun.CHAPA = rfid.CHAPA
        WHERE fun.CHAPA = '$matricula'
        AND fun.TP_SITUACAO = 'A'";

$res_sql = oci_parse($conn_ora, $sql);

oci_execute($res_sql);

if ($row = oci_fetch_assoc($res_sql)) {
    $nm_funcionario = $row['NM_FUNCIONARIO'];
    $ds_funcao = $row['DS_FUNCAO'];
    $nm_setor = $row['NM_SETOR'];
    $cpf = $row['CPF'];
    $rfid = $row['RFID'];
    $chapa = $row['CHAPA'];

    
?>
<div class="row">
    <!--COLABORADOR-->
    <div class="col-md-6">
        Nome do funcionário:
        </br>
        <input type="text" class="form-control" autocomplete="off" 
        value="<?php echo $nm_funcionario?>" disabled></input>
    </div>

    <div class="col-md-6">
        Descrição da função:
        </br>
        <input type="text" class="form-control" autocomplete="off" 
        value="<?php echo $ds_funcao?>" disabled></input>
    </div>

</div>

<br>

<div class="row">
    <div class="col-md-6">
        Nome do setor:
        </br>
        <input type="text" class="form-control" autocomplete="off" 
        value="<?php echo $nm_setor?>" disabled></input>
    </div>

    <div class="col-md-6">
        CPF do funcionário:
        </br>
        <input type="text" class="form-control" autocomplete="off" id="cpf" name="cpf"
        value="<?php echo $cpf ?>" disabled>
    </div>
    
</div>
<br>
<div class="row">
    <div class="col-md-3">
        RF-ID:<br>
        <input id="ds_rfid"  required type="text" class="form-control" placeholder="Informe o RF-ID" maxlength="12" value="<?php echo $rfid ?>">  
    </div>
    <?php if(!isset($rfid) and !isset($chapa)) {?>
        <button onclick="enviarRFID()" class="btn btn-primary" id="enviar">Enviar</button>
    <?php }else{?>
        <button onclick="atualizarRFID()" class="btn btn-primary" id="enviar">Atualizar</button>
    <?php }?>
</div>



<?php
}else{
    echo "<script>alert('Erro: Matrícula não encontrada.');</script>"; 
}
?>
