<?php 
    session_start();

    include '../../../conexao.php';

    $id = $_POST['id'];
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
    $usuario = $_SESSION['usuarioLogin'];
    $rfid = $_POST['ds_rfid'];

    $sql = "UPDATE port_catraca.TERCEIROS ter
            SET CRACHA = '$cracha',        
                NM_TERCEIRO = UPPER('$terceiro'),   
                DT_NASCIMENTO = TO_DATE( TO_CHAR(TO_DATE('$dt_nascimento','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY'),
                RG = '$rg',          
                CPF = '$cpf',           
                CNPJ = '$cnpj',          
                NM_EMPRESA = UPPER('$nm_empresa'),   
                TP_STATUS = '$status',    
                DT_INICIO = TO_DATE( TO_CHAR(TO_DATE('$inicio','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY'),
                DT_FIM = TO_DATE( TO_CHAR(TO_DATE('$fim','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY'),  
                CD_USUARIO_ULT_ALT = '$usuario', 
                HR_ULT_ALT = SYSDATE,
                DS_RFID = '$rfid'
            WHERE ter.CD_TERCEIRO = '$id'";

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