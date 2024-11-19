<?php
    session_start();

    include '../../../conexao.php';

    $cracha = $_POST['cd_cracha'];
    $cd_catraca = $_POST['cd_catraca'];
    $usuario = $_SESSION['usuarioLogin'];
    $tipo = $_POST['tipo'];

    $querry =  "INSERT INTO port_catraca.CRACHAS
                SELECT
                port_catraca.SEQ_CRACHA_CATRACA.NEXTVAL AS CD_REGISTRO,
                '$cracha' AS CD_CRACHA,
                '$tipo' as TIPO,
                '$cd_catraca' AS CD_CATRACA,
                '$usuario' as CD_USUARIO_CADASTRO,
                SYSDATE AS HR_CADASTRO
                FROM DUAL";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    if (!$valida){   
        $erro = oci_error($result);																					
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        echo 'Sucesso';      
    }
?>