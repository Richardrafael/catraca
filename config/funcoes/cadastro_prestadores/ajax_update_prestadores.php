<?php 
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $cd_seq_prestador = $_POST['cd_seq_prestador'];
    $cracha_edit = $_POST['cd_cracha_edit'];
    $cracha = $_POST['cd_cracha'];
    $ds_rfid = $_POST['ds_rfid'];
    $prestador = $_POST['nm_prestador'];
    $cpf = $_POST['nr_cpf'];
    $tipo = $_POST['tp_cadastro'];
    $status = $_POST['tp_status'];
    $inicio = $_POST['dt_inicio'];
    $fim = $_POST['dt_fim'];

    if($cracha != $cracha_edit){
        $sql = "DELETE
                FROM port_catraca.CRACHAS cra
                WHERE cra.CD_CRACHA = (SELECT pre.CRACHA
                                    FROM port_catraca.PRESTADORES pre
                                    WHERE pre.CD_SEQ_PRESTADOR = '$cd_seq_prestador')";
        $result = oci_parse($conn_ora, $sql);
        $valida = oci_execute($result);
    }else{ $valida = true; }
    //VALIDACAO
    if (!$valida) {   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        $sql = "UPDATE port_catraca.PRESTADORES pre
                SET CRACHA = '$cracha',
                    NM_PRESTADOR = UPPER('$prestador'),        
                    CPF = '$cpf', 
                    TIPO = '$tipo',
                    TP_STATUS = '$status', 
                    DT_INICIO = TO_DATE(TO_CHAR(TO_DATE('$inicio','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY'),
                    DT_FIM = TO_DATE(TO_CHAR(TO_DATE('$fim','YYYY-MM-DD'),'DD/MM/YYYY'),'DD/MM/YYYY'),
                    CD_USUARIO_ULT_ALT = '$usuario', 
                    HR_ULT_ALT = SYSDATE,
                    DS_RFID = '$ds_rfid' 
                WHERE pre.CD_SEQ_PRESTADOR = '$cd_seq_prestador'";

        $result = oci_parse($conn_ora, $sql);
        $valida_update = oci_execute($result);

        //VALIDACAO
        if (!$valida_update) {   
            $erro = oci_error($result);																							
            $msg_erro = htmlentities($erro['message']);
            echo $msg_erro;
        }else{
            echo 'Sucesso';
        }
    }
?>