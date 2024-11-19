<?php
    include '../../../conexao.php';

    $cd_estagio = $_POST['cd_estagio'];

    $querry = "SELECT est.SN_DOM, est.SN_SEG, est.SN_TER, est.SN_QUA, est.SN_QUI, est.SN_SEX, est.SN_SAB
               FROM port_catraca.ESTAGIO est
               WHERE est.CD_ESTAGIO = $cd_estagio
               ORDER BY est.CD_ESTAGIO";

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