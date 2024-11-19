<?php
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cracha = $_POST['cd_cracha'];
    $terceiro = $_POST['nm_terceiro'];
    $dt_nascimento = $_POST['dt_nasc'];
    $rg = $_POST['nr_rg'];
    $cpf = $_POST['nr_cpf'];
    $cnpj = $_POST['nr_cnpj'];
    $nm_empresa = $_POST['nm_empresa'];
    $status = $_POST['tp_status'];
    $inicio = $_POST['dt_ini'];
    $fim = $_POST['dt_fim'];
    $rf_id = $_POST['ds_rfid'];

    $querry = "INSERT INTO port_catraca.Terceiros
                    SELECT 
                    port_catraca.SEQ_CD_TERCEIRO.NEXTVAL AS CD_TERCEIRO,
                    '$cracha' AS CRACHA,        
                    UPPER('$terceiro') AS NM_TERCEIRO,   
                    TO_DATE( TO_CHAR(TO_DATE('$dt_nascimento','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY') AS DT_NASCIMENTO,
                    '$rg' AS RG,          
                    '$cpf' AS CPF,           
                    '$cnpj' AS CNPJ,          
                    UPPER('$nm_empresa') AS NM_EMPRESA,   
                    '$status' AS TP_STATUS,    
                    TO_DATE( TO_CHAR(TO_DATE('$inicio','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY') AS DT_INICIO,
                    TO_DATE( TO_CHAR(TO_DATE('$fim','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY') AS DT_FIM,
                    '$usuario' AS CD_USUARIO_CADASTRO,
                    SYSDATE AS HR_CADASTRO,   
                    NULL AS CD_USUARIO_ULT_ALT, 
                    NULL AS HR_ULT_ALT,
                    '$rf_id' AS DS_RFID    
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