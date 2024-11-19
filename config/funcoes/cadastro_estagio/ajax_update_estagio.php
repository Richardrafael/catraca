<?php

    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd_estagio = $_POST['cd_estagio'];
    $nm_estagio = $_POST['nm_estagio'];
    $hr_inicio = $_POST['inicio'];
    $hr_fim = $_POST['fim'];
    $sn_dom = $_POST['dom'];
    $sn_seg = $_POST['seg'];
    $sn_ter = $_POST['ter'];
    $sn_qua = $_POST['qua'];
    $sn_qui = $_POST['qui'];
    $sn_sex = $_POST['sex'];
    $sn_sab = $_POST['sab'];

    $insert_tabela_turmas = "UPDATE port_catraca.ESTAGIO est
                             SET est.NM_ESTAGIO = UPPER('$nm_estagio'),   
                                 est.HR_INICIO = '$hr_inicio',
                                 est.HR_FIM = '$hr_fim',
                                 est.SN_DOM = '$sn_dom',
                                 est.SN_SEG = '$sn_seg',
                                 est.SN_TER = '$sn_ter',
                                 est.SN_QUA = '$sn_qua',
                                 est.SN_QUI = '$sn_qui',
                                 est.SN_SEX = '$sn_sex',
                                 est.SN_SAB = '$sn_sab',
                                 est.CD_USUARIO_ULT_ALT = '$usuario', 
                                 est.HR_ULT_ALT = SYSDATE   
                             WHERE est.CD_ESTAGIO = '$cd_estagio'";

    $res_insert_turmas = oci_parse($conn_ora, $insert_tabela_turmas);
            $valida = oci_execute($res_insert_turmas);

    if (!$valida) {   
        $erro = oci_error($res_insert_turmas);																							
        $msg_erro = htmlentities($erro['message']);
        //header("Location: $pag_login");
        //echo $erro;
        echo $msg_erro;
    }else{
        echo 'Sucesso';      
    }

?>