<?php
    include '../../../conexao.php';

    $id = $_POST['id_catraca'];

    $querry =  "SELECT COUNT(cat.ID_CATRACA) AS QTD
                FROM port_catraca.CATRACA cat
                WHERE cat.ID_CATRACA LIKE '$id'";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    if (!$valida){   
        $erro = oci_error($result);																					
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        $resultado = oci_fetch_array($result);

        echo $resultado['QTD'];
    }
?>