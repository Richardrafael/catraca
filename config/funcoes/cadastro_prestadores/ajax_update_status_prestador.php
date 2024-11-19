<?php 
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd = $_POST['cd'];
    $status = $_POST['status'];

    if ($status == 'A') {
        $sql = "UPDATE port_catraca.PRESTADORES pre
                SET pre.TP_STATUS = 'I',
                    CD_USUARIO_ULT_ALT = '$usuario', 
                    HR_ULT_ALT = SYSDATE 
                WHERE pre.CD_SEQ_PRESTADOR = '$cd'";
    }else if($status == 'I'){
        $sql = "UPDATE port_catraca.PRESTADORES pre
                SET pre.TP_STATUS = 'A',
                    CD_USUARIO_ULT_ALT = '$usuario', 
                    HR_ULT_ALT = SYSDATE 
                WHERE pre.CD_SEQ_PRESTADOR = '$cd'";
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