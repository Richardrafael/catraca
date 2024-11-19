<?php
    include '../../../conexao.php';

    $cd_turma = $_POST['cd_turma'];

    $querry = "SELECT turma.CD_TURMA, turma.NM_TURMA, turma.HR_INICIO, turma.HR_FIM
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
        $nm_turma = $row_turma['NM_TURMA'];
        $hr_inicio = $row_turma['HR_INICIO'];
        $hr_fim = $row_turma['HR_FIM'];
        $array = [$cd_turma, $nm_turma, $hr_inicio, $hr_fim];
        echo json_encode($array);
    }
?>