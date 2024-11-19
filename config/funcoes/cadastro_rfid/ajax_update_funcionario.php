<?php 
    session_start();

    include '../../../conexao.php';

    $chapa = $_POST['cd_chapa'];
    $rfid = $_POST['ds_rfid'];

    $sql = "UPDATE dbamv.funcionario_rfid rfid
            SET RFID = '$rfid'
            WHERE rfid.CHAPA = '$chapa'";

    $result = oci_parse($conn_ora, $sql);
    $valida = oci_execute($result);

    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        echo 'Sucesso';
    }
?>