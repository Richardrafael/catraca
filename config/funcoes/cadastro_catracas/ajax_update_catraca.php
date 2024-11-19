<?php 
    session_start();

    include '../../../conexao.php';

    $id = $_POST['id'];
    $nm_catraca = $_POST['nm_catraca'];
    $ds_catraca = $_POST['ds_catraca'];
    $id_catraca = $_POST['id_catraca'];
    $ip_catraca = $_POST['ip_catraca'];
    $status = $_POST['status'];
    $usuario = $_SESSION['usuarioLogin'];

    $sql = "UPDATE port_catraca.CATRACA cat
            SET NM_CATRACA = UPPER('$nm_catraca'),   
                DS_CATRACA = UPPER('$ds_catraca'),   
                ID_CATRACA = '$id_catraca',
                IP_CATRACA = '$ip_catraca',
                SN_ATIVO = '$status',
                CD_USUARIO_ULT_ALT = '$usuario', 
                HR_ULT_ALT = SYSDATE 
            WHERE cat.CD_CATRACA = '$id'";
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
        echo 'Sucesso';
    }
?>