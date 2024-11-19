<?php

    include '../../../conexao.php';

    $nm_pesquisa = $_POST['nm_pesquisa'];
    $cd_estagio = $_POST['cd_estagio'];

    $querry =  "SELECT alu.CD_ALUNO, alu.NM_ALUNO || ' / RG: ' || alu.RG || ' / ' || tur.NM_TURMA AS RESULTADO
                FROM port_catraca.ALUNOS alu
                INNER JOIN port_catraca.TURMAS tur
                ON tur.CD_TURMA = alu.CD_TURMA
                WHERE alu.NM_ALUNO LIKE UPPER('%$nm_pesquisa%')
                AND alu.CD_ALUNO NOT IN (SELECT aluest.CD_ALUNO 
                                         FROM port_catraca.ALUNOS_ESTAGIO aluest 
                                         WHERE aluest.CD_ESTAGIO = '$cd_estagio')
                ORDER BY alu.NM_ALUNO";

    $result = oci_parse($conn_ora, $querry);
              oci_execute($result);

    while($row_alunos = oci_fetch_array($result)){
        echo '<option data-value="' . $row_alunos['CD_ALUNO'] . '" data-option="' . $row_alunos['RESULTADO'] . '" data-cd_aluno_estagio="' . $row_alunos['CD_ALUNO_ESTAGIO'] . '">' . $row_alunos['RESULTADO'] . '</option>';
    }
?>