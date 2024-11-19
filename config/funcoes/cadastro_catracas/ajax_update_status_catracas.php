<?php 
    session_start();

    include '../../../conexao.php';

    $id = $_POST['id'];
    $status = $_POST['status'];
    $usuario = $_SESSION['usuarioLogin'];

    if($status == 'A'){
        $sql = "UPDATE port_catraca.CATRACA ct
                SET ct.sn_ativo = 'I',
                    ct.CD_USUARIO_ULT_ALT = '$usuario', 
                    ct.HR_ULT_ALT = SYSDATE
                WHERE ct.cd_catraca = '$id'";
    }
    else{
        $sql = "UPDATE port_catraca.CATRACA ct
                SET ct.SN_ATIVO = 'A',
                    ct.CD_USUARIO_ULT_ALT = '$usuario', 
                    ct.HR_ULT_ALT = SYSDATE
                WHERE ct.CD_CATRACA = '$id'";
    }

    $result = oci_parse($conn_ora, $sql);
    $valida = oci_execute($result);

    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        //header("Location: $pag_login");
        //echo $erro;
        echo $msg_erro;
    }else{
        if($status == 'A'){
            echo 'Sucesso0';
        }else{
            echo 'Sucesso1';
        }
    }
?>