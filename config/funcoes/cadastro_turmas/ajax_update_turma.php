<?php

    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd_turma = $_POST['cd_turma'];
    $nm_turma = $_POST['nm_turma'];
    $hr_inicio = $_POST['inicio'];
    $hr_fim = $_POST['fim'];
    $sn_dom = $_POST['dom'];
    $sn_seg = $_POST['seg'];
    $sn_ter = $_POST['ter'];
    $sn_qua = $_POST['qua'];
    $sn_qui = $_POST['qui'];
    $sn_sex = $_POST['sex'];
    $sn_sab = $_POST['sab'];

    $insert_tabela_turmas = "UPDATE port_catraca.TURMAS tur
                             SET tur.NM_TURMA = UPPER('$nm_turma'),   
                                 tur.HR_INICIO = '$hr_inicio',
                                 tur.HR_FIM = '$hr_fim',
                                 tur.SN_DOM = '$sn_dom',
                                 tur.SN_SEG = '$sn_seg',
                                 tur.SN_TER = '$sn_ter',
                                 tur.SN_QUA = '$sn_qua',
                                 tur.SN_QUI = '$sn_qui',
                                 tur.SN_SEX = '$sn_sex',
                                 tur.SN_SAB = '$sn_sab',
                                 tur.CD_USUARIO_ULT_ALT = '$usuario', 
                                 tur.HR_ULT_ALT = SYSDATE   
                             WHERE tur.CD_TURMA = '$cd_turma'";

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