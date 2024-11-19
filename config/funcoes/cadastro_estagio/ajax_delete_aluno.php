<?php
    include '../../../conexao.php';

    $cd_aluno_estagio = $_POST['cd_aluno_estagio'];

    $querry = "DELETE
               FROM port_catraca.ALUNOS_ESTAGIO aluest
               WHERE aluest.CD_ALUNO_ESTAGIO = '$cd_aluno_estagio'";

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