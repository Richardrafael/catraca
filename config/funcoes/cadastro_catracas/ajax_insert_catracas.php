<?php
    session_start();

    include '../../../conexao.php';

    $usuario = $_SESSION['usuarioLogin'];
    $nm_catraca = $_POST['nm_catracas'];
    $ds_catraca = $_POST['ds_catracas'];
    $tp_status = $_POST['tp_status'];
    $id_catraca = $_POST['id_catracas'];
    $ip_catraca = $_POST['ip_catraca'];
    $sn_registra_entrada = $_POST['sn_registra_entrada'];
    $hr_inicio_registro = $_POST['hr_inicio_registro'];
    $hr_fim_registro = $_POST['hr_fim_registro'];
    $sn_registra_saida = $_POST['sn_registra_saida'];
    $hr_inicio_registro_saida = $_POST['hr_inicio_registro_saida'];
    $hr_fim_registro_saida = $_POST['hr_fim_registro_saida'];

    print($hr_inicio_registro);

    $insert_tabela_catraca = "INSERT INTO port_catraca.catraca
                                    VALUES (
                                    port_catraca.seq_cd_catraca.nextval,
                                    UPPER('$nm_catraca'),
                                    UPPER('$ds_catraca'),
                                    '$id_catraca',
                                    '$tp_status',
                                    '$usuario',
                                    SYSDATE,   
                                    NULL,
                                    NULL,
                                    $ip_catraca,
                                    '$sn_registra_entrada',
                                    TO_TIMESTAMP('$hr_inicio_registro', 'YYYY-MM-DD\"T\"HH24:MI:SS'),
                                    TO_TIMESTAMP('$hr_fim_registro', 'YYYY-MM-DD\"T\"HH24:MI:SS'),
                                    '$sn_registra_saida',
                                    TO_TIMESTAMP('$hr_inicio_registro_saida', 'YYYY-MM-DD\"T\"HH24:MI:SS'),
                                    TO_TIMESTAMP('$hr_fim_registro_saida', 'YYYY-MM-DD\"T\"HH24:MI:SS'))";
    echo($insert_tabela_catraca);
    $res_insert_tabela_catraca = oci_parse($conn_ora, $insert_tabela_catraca);
                    $valida = oci_execute($res_insert_tabela_catraca);

        //VALIDACAO
        if (!$valida) { 
            $erro = oci_error($res_insert_tabela_catraca);																							
            $msg_erro = htmlentities($erro['message']);
            //header("Location: $pag_login");
            //echo $erro;
            echo $msg_erro;
        }else{
            echo 'Sucesso'; 
        }
?>