<?php 
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $id = $_POST['cd_turma'];
    $status = $_POST['sn_ativo'];

    if ($status == 'A'){
        $sql = "UPDATE port_catraca.TURMAS turmas
                SET turmas.SN_ATIVO = 'I',
                    turmas.CD_USUARIO_ULT_ALT = '$usuario',
                    turmas.HR_ULT_ALT = SYSDATE
                WHERE turmas.CD_TURMA = '$id'";
    }else{
        $sql = "UPDATE port_catraca.TURMAS turmas
                SET turmas.SN_ATIVO = 'A',
                    turmas.CD_USUARIO_ULT_ALT = '$usuario',
                    turmas.HR_ULT_ALT = SYSDATE
                WHERE turmas.CD_TURMA = '$id'";
    }

    $result = oci_parse($conn_ora, $sql);
    $valida = oci_execute($result);

    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        echo 'Sucesso';
    }
?>