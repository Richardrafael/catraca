<?php

    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $nm_turma = $_POST['nm_turma'];
    $status = $_POST['sn_ativo'];
    $hr_inicio = $_POST['inicio'];
    $hr_fim = $_POST['fim'];
    $sn_dom = $_POST['dom'];
    $sn_seg = $_POST['seg'];
    $sn_ter = $_POST['ter'];
    $sn_qua = $_POST['qua'];
    $sn_qui = $_POST['qui'];
    $sn_sex = $_POST['sex'];
    $sn_sab = $_POST['sab'];

    $insert_tabela_turmas = "INSERT INTO port_catraca.TURMAS
                             SELECT 
                             port_catraca.SEQ_CD_TURMA.NEXTVAL AS CD_TURMA,    
                             UPPER('$nm_turma') AS NM_TURMA,   
                             '$status' AS SN_ATIVO,    
                             '$hr_inicio' AS HR_INICIO,
                             '$hr_fim' AS HR_FIM,
                             '$sn_dom' AS SN_DOM,
                             '$sn_seg' AS SN_SEG,
                             '$sn_ter' AS SN_TER,
                             '$sn_qua' AS SN_QUA,
                             '$sn_qui' AS SN_QUI,
                             '$sn_sex' AS SN_SEX,
                             '$sn_sab' AS SN_SAB,
                             '$usuario' AS CD_USUARIO_CADASTRO,
                             SYSDATE AS HR_CADASTRO,   
                             NULL AS CD_USUARIO_ULT_ALT, 
                             NULL AS HR_ULT_ALT    
                             FROM DUAL";

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