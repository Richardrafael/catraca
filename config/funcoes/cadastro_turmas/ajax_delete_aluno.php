<?php
include '../../../conexao.php';

$cd_aluno = $_POST['cd_aluno'];
$cd_turma = $_POST['cd_turma'];

/* Remove as Catracas vinculadas a esse cracha para evitar 
       autorização indevida */
$querry =  "DELETE
                FROM port_catraca.CRACHAS cra
                WHERE cra.CD_CRACHA IN (SELECT alu.CD_CRACHA
                                        FROM port_catraca.ALUNOS alu
                                        WHERE alu.CD_ALUNO = '$cd_aluno'
                                        AND alu.CD_TURMA = '$cd_turma')";
$result = oci_parse($conn_ora, $querry);
$valida = oci_execute($result);

$querry = "DELETE
               FROM port_catraca.ALUNOS1 alu
               WHERE alu.CD_ALUNO = '$cd_aluno'
               AND alu.CD_TURMA = '$cd_turma'";
$result = oci_parse($conn_ora, $querry);
$valida = oci_execute($result);

$querry =  "DELETE
                FROM port_catraca.ALUNOS_ESTAGIO aluest
                WHERE aluest.CD_ALUNO = '$cd_aluno'";
$result = oci_parse($conn_ora, $querry);
$valida = oci_execute($result);

//VALIDACAO
if (!$valida) {
    $erro = oci_error($result);
    $msg_erro = htmlentities($erro['message']);
    echo $msg_erro;
} else {
    echo 'Sucesso';
}
