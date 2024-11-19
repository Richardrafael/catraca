<?php 
    include '../../../conexao.php';

    $id = $_POST['id'];
    $status = $_POST['status'];

    if ($status == 'A') {
        $sql = "UPDATE port_catraca.TERCEIROS ter
        SET ter.TP_STATUS = 'I'
        WHERE ter.CD_TERCEIRO = '$id'";
    }else if($status == 'I'){
        $sql = "UPDATE port_catraca.TERCEIROS ter
            SET ter.TP_STATUS = 'A'
            WHERE ter.CD_TERCEIRO = '$id'";
    }

    $result = oci_parse($conn_ora, $sql);
    $valida = oci_execute($result);

    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        if($status == 'A') {
            echo 0;
        }else{
            echo 1;
        }
    }
?>