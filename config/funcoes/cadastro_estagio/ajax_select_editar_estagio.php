<?php
    include '../../../conexao.php';

    $cd_estagio = $_POST['cd_estagio'];

    $querry = "SELECT est.CD_ESTAGIO, est.NM_ESTAGIO, est.HR_INICIO, est.HR_FIM
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
        $nm_turma = $row_turma['NM_ESTAGIO'];
        $hr_inicio = $row_turma['HR_INICIO'];
        $hr_fim = $row_turma['HR_FIM'];
        $array = [$cd_estagio, $nm_turma, $hr_inicio, $hr_fim];
        echo json_encode($array);
    }
?>