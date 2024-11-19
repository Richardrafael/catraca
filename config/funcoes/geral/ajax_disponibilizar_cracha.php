<?php
    include '../../../conexao.php';

    $cracha = $_POST['cracha'];
    $tipo = $_POST['tipo'];

    /* Remove o usuário vinculado ao cracha para ser utilizado em outro */
    if($tipo == 'T'){
        $querry =  "UPDATE port_catraca.TERCEIROS ter
                    SET ter.CRACHA = ''
                    WHERE ter.CRACHA = '$cracha'";
        $result = oci_parse($conn_ora, $querry);
        $valida = oci_execute($result);
    }elseif($tipo == 'A'){
        $querry =  "UPDATE port_catraca.ALUNOS alu
                    SET alu.CD_CRACHA = ''
                    WHERE alu.CD_CRACHA = '$cracha'";
        $result = oci_parse($conn_ora, $querry);
        $valida = oci_execute($result);
    }elseif($tipo == 'PR'){
        $querry =  "UPDATE port_catraca.PRESTADORES pre
                    SET pre.CRACHA = ''
                    WHERE pre.CRACHA = '$cracha'";
        $result = oci_parse($conn_ora, $querry);
        $valida = oci_execute($result);
    }elseif($tipo == 'All'){
        $valida = true;
    }

    if (!$valida){   
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }else{
        /* Remove as Catracas vinculadas a esse cracha para evitar 
        autorização indevida após a troca de cracha no usuário */
        if($tipo == 'A'){
            $querry =  "DELETE
                        FROM port_catraca.CRACHAS cra
                        WHERE cra.CD_CRACHA = '$cracha'
                        AND cra.TIPO IN ('A', 'E')";
            $result = oci_parse($conn_ora, $querry);
            $valida = oci_execute($result);
        }elseif($tipo == 'T'){
            $querry =  "DELETE
                        FROM port_catraca.CRACHAS cra
                        WHERE cra.CD_CRACHA = '$cracha'
                        AND cra.TIPO = 'T'";
            $result = oci_parse($conn_ora, $querry);
            $valida = oci_execute($result);
        }elseif($tipo == 'PR'){
            $querry =  "DELETE
                        FROM port_catraca.CRACHAS cra
                        WHERE cra.CD_CRACHA = '$cracha'
                        AND cra.TIPO = 'PR'";
            $result = oci_parse($conn_ora, $querry);
            $valida = oci_execute($result);
        }

        if (!$valida){
            $erro = oci_error($result);																							
            $msg_erro = htmlentities($erro['message']);
            echo $msg_erro;
        }else{
            echo $msg = 'Sucesso';
        }
    }
?>