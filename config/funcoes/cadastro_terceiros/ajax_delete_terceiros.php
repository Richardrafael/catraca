<?php 
    include '../../../conexao.php';

    $id = $_POST['id'];

    $sql = "DELETE FROM port_catraca.CRACHAS cra
                    WHERE cra.CD_CRACHA = (SELECT ter.CRACHA
                                           FROM port_catraca.TERCEIROS ter
                                           WHERE ter.CD_TERCEIRO = '$id')";
    $result = oci_parse($conn_ora, $sql);
    $valida = oci_execute($result);

    if($valida){
        $del = "DELETE FROM port_catraca.TERCEIROS ter
                WHERE ter.CD_TERCEIRO =  '$id'";

        $result = oci_parse($conn_ora, $del);
        $valida = oci_execute($result);
    }

    if(!$valida){
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        echo 'Sucesso';
    }  
?>