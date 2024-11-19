<?php 
     include '../../../conexao.php';

     $cd_catraca = $_POST['cd'];

     $del = "DELETE 
             FROM port_catraca.CATRACA ct
             WHERE ct.CD_CATRACA =  '$cd_catraca'";

     $result = oci_parse($conn_ora, $del);
     $valida = oci_execute($result);

    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        $msg = 'Sucesso';
    }

    if($msg = 'Sucesso'){
        $del = "DELETE
                FROM port_catraca.CRACHAS cra
                WHERE cra.CD_CATRACA = '$cd_catraca'";

        $result = oci_parse($conn_ora, $del);
        $valida = oci_execute($result);

        //VALIDACAO
        if (!$valida) {   
            $erro = oci_error($result);																							
            $msg_erro = htmlentities($erro['message']);
            echo $msg_erro;
        }else{
            echo 'Sucesso';
        }
    }
?>