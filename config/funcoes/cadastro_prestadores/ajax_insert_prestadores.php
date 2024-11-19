<?php
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cracha = $_POST['cd_cracha'];
    $ds_rfid = $_POST['ds_rfid'];
    $prestador = $_POST['nm_prestador'];
    $cpf = $_POST['nr_cpf'];
    $tipo = $_POST['tp_cadastro'];
    $status = $_POST['tp_status'];
    $inicio = $_POST['dt_inicio'];
    $fim = $_POST['dt_fim'];

    $querry =  "INSERT INTO port_catraca.PRESTADORES
                SELECT 
                port_catraca.SEQ_CD_PRESTADOR.NEXTVAL AS CD_SEQ_PRESTADOR,
                '$cracha' AS CRACHA,        
                UPPER('$prestador') AS NM_PRESTADOR,        
                '$cpf' AS CPF, 
                '$tipo' AS TIPO,
                '$status' AS TP_STATUS, 
                TO_DATE(TO_CHAR(TO_DATE('$inicio','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY') AS DT_INICIO,
                TO_DATE(TO_CHAR(TO_DATE('$fim','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY') AS DT_FIM,
                '$usuario' AS CD_USUARIO_CADASTRO,
                SYSDATE AS HR_CADASTRO,  
                NULL AS CD_USUARIO_ULT_ALT, 
                NULL AS HR_ULT_ALT,
                '$ds_rfid' AS DS_RFID   
                FROM DUAL";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $querry;
    }else{
        echo 'Sucesso';
    }
?>