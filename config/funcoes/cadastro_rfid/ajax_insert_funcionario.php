<?php
    session_start();

    include '../../../conexao.php';

    $chapa = $_POST['cd_chapa'];
    $rf_id = $_POST['ds_rfid'];

    $querry = "INSERT INTO dbamv.funcionario_rfid
                    SELECT '$chapa' AS CHAPA,
                           '$rf_id' AS RFID    
                    FROM DUAL";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $querry;
    }else{
        echo 'Sucesso';
    }
?>