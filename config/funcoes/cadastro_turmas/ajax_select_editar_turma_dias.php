<?php
    include '../../../conexao.php';

    $cd_turma = $_POST['cd_turma'];

    $querry = "SELECT turma.SN_DOM, turma.SN_SEG, turma.SN_TER, turma.SN_QUA, turma.SN_QUI, turma.SN_SEX, turma.SN_SAB
               FROM port_catraca.TURMAS turma
               WHERE turma.CD_TURMA = '$cd_turma'
               ORDER BY turma.CD_TURMA";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    if(!$valida){
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        //echo $erro;
        echo $msg_erro;
    }else{
        $row_turma = oci_fetch_array($result);
        $nm_dom = $row_turma['SN_DOM'];
        $nm_seg = $row_turma['SN_SEG'];
        $nm_ter = $row_turma['SN_TER'];
        $nm_qua = $row_turma['SN_QUA'];
        $nm_qui = $row_turma['SN_QUI'];
        $nm_sex = $row_turma['SN_SEX'];
        $nm_sab = $row_turma['SN_SAB'];
        
        $array = [$nm_dom, $nm_seg, $nm_ter, $nm_qua, $nm_qui, $nm_sex, $nm_sab];
        echo json_encode($array);
    }
?>