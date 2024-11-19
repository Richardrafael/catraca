<?php
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd_estagio = $_POST['cd_estagio'];
    $cd_aluno = $_POST['cd_aluno'];

    $querry =  "INSERT INTO port_catraca.ALUNOS_ESTAGIO
                SELECT
                port_catraca.SEQ_CD_ALUNO_ESTAGIO.NEXTVAL AS CD_ALUNO_ESTAGIO,
                '$cd_estagio' AS CD_ESTAGIO,
                '$cd_aluno' AS CD_ALUNO,
                'A' AS SN_ATIVO,
                '$usuario' as CD_USUARIO_CADATRO,
                SYSDATE AS HR_CADASTRO,
                NULL AS CD_USUARIO_ULT_ALT,
                NULL AS HR_ULT_ALT
                FROM DUAL";

    $result = oci_parse($conn_ora, $querry);
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