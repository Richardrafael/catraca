<?php

    include '../../../conexao.php';

    $cd_estagio = $_POST['cd_estagio'];

    $querry = "DELETE
               FROM port_catraca.ESTAGIO est
               WHERE est.CD_ESTAGIO = '$cd_estagio'";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        $msg = 'Sucesso';
    }

    $querry = "DELETE
               FROM port_catraca.ALUNOS_ESTAGIO alu
               WHERE alu.CD_ESTAGIO = $cd_estagio";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        $msg = 'Sucesso';
    }

    echo $msg;
?>