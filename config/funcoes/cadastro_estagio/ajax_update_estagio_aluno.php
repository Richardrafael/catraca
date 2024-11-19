<?php
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd_estagio = $_POST['cd_estagio'];
    $cd_aluno_estagio = $_POST['cd_aluno_estagio'];


    $sql = "UPDATE port_catraca.ALUNOS_ESTAGIO alu
            SET alu.CD_ESTAGIO = '$cd_estagio',
                alu.CD_USUARIO_ULT_ALT = '$usuario',
                alu.HR_ULT_ALT = SYSDATE
            WHERE CD_ALUNO_ESTAGIO = '$cd_aluno_estagio'";
   
   

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