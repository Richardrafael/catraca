<?php
    include '../../../conexao.php';

    $cd_turma = $_POST['cd_turma'];

    /* Remove as Catracas vinculadas a esses crachas para evitar 
       autorização indevida após a troca de cracha no usuário */
    $querry =  "DELETE
                FROM port_catraca.CRACHAS cra
                WHERE cra.CD_CRACHA IN (SELECT alu.CD_CRACHA
                                        FROM port_catraca.ALUNOS alu
                                        WHERE alu.CD_TURMA = '$cd_turma')";
    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    /* Remove a Turma Selecionada */
    $querry = "DELETE
               FROM port_catraca.TURMAS tur
               WHERE tur.CD_TURMA = '$cd_turma'";
    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    /* Remove todos os Alunos vinculados a essa turma de estágios */
    $querry = "DELETE
               FROM port_catraca.ALUNOS_ESTAGIO aluest
               WHERE aluest.CD_ALUNO IN (SELECT alu.CD_ALUNO
                                         FROM port_catraca.ALUNOS alu
                                         WHERE alu.CD_TURMA = '$cd_turma')";
    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    /* Remove todos os Alunos vinculados a turma */
    $querry = "DELETE
               FROM port_catraca.ALUNOS alu
               WHERE alu.CD_TURMA = $cd_turma";
    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    if($valida){
        echo 'Sucesso';
    }else{
        $erro = oci_error($result);																							
        $msg_erro = htmlentities($erro['message']);
        echo $msg_erro;
    }
?>