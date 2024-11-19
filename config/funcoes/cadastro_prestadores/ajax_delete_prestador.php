<?php
    include '../../../conexao.php';

    $cd_seq_prestador = $_POST['cd_seq_prestador'];

    $querry = "DELETE
               FROM port_catraca.CRACHAS cra
               WHERE cra.CD_CRACHA = (SELECT pre.CRACHA
                                      FROM port_catraca.PRESTADORES pre
                                      WHERE pre.CD_SEQ_PRESTADOR = '$cd_seq_prestador')
               AND cra.TIPO = 'PR'";
    
    $result = oci_parse($conn_ora, $querry);
    $valida_cracha = oci_execute($result);

    if (!$valida_cracha){   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        $querry = "DELETE
                   FROM port_catraca.PRESTADORES pre
                   WHERE pre.CD_SEQ_PRESTADOR = '$cd_seq_prestador'";
    
        $result = oci_parse($conn_ora, $querry);
        $valida = oci_execute($result);
        
        if (!$valida){   
            $erro = oci_error($result);																							
            $msg_erro = htmlentities($erro['message']);
            echo $msg_erro;
        }else{
            echo 'Sucesso';
        }
    }

?>