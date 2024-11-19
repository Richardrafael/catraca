<?php
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd_aluno = $_POST['cd_aluno'];
    $cd_turma = $_POST['cd_turma'];

    $sql = "UPDATE port_catraca.ALUNOS alu
            SET alu.CD_TURMA = '$cd_turma',
                alu.CD_USUARIO_ULT_ALT = '$usuario',
                alu.HR_ULT_ALT = SYSDATE
            WHERE CD_ALUNO = '$cd_aluno'";   

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