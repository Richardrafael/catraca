<?php
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd_aluno = $_POST['cd_aluno'];
    $cd_estagio = $_POST['cd_estagio'];
    $sn_ativo = $_POST['sn_ativo'];

    if ($sn_ativo == 'A') {
        $sql = "UPDATE port_catraca.ALUNOS_ESTAGIO alu
                SET alu.SN_ATIVO = 'I',
                    alu.CD_USUARIO_ULT_ALT = '$usuario',
                    alu.HR_ULT_ALT = SYSDATE
                WHERE alu.CD_ALUNO = '$cd_aluno'
                AND alu.CD_ESTAGIO = '$cd_estagio'";
    }
    else {
        $sql = "UPDATE port_catraca.ALUNOS_ESTAGIO alu
                SET alu.SN_ATIVO = 'A',
                    alu.CD_USUARIO_ULT_ALT = '$usuario',
                    alu.HR_ULT_ALT = SYSDATE
                WHERE alu.CD_ALUNO = '$cd_aluno'
                AND alu.CD_ESTAGIO = '$cd_estagio'";
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