<?php
    session_start();

    include '../../../conexao.php';

    $cracha = $_POST['cracha'];
    $cd_catraca = $_POST['cd_catraca'];
    $tipo = $_POST['tipo'];

    $querry  = "DELETE
                FROM port_catraca.CRACHAS cra
                WHERE cra.CD_CRACHA = '$cracha'
                AND cra.CD_CATRACA = '$cd_catraca'
                AND cra.TIPO = '$tipo'";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    if($valida){
        echo 'Sucesso';
    }else{
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }
?>