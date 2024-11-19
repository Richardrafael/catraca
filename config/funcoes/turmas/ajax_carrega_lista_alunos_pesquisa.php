<?php

    include '../../../conexao.php';

    $nm_pesquisa = $_POST['nm_pesquisa'];
    $cd_turma = $_POST['cd_turma'];

    $querry =  "SELECT alu.CD_ALUNO, alu.NM_ALUNO || ' / RG: ' || alu.RG || ' / ' || tur.NM_TURMA AS RESULTADO
                FROM port_catraca.ALUNOS alu
                INNER JOIN port_catraca.TURMAS tur
                on tur.CD_TURMA = alu.CD_TURMA
                WHERE alu.NM_ALUNO LIKE UPPER('%$nm_pesquisa%')
                AND tur.CD_TURMA != '$cd_turma'
                ORDER BY alu.NM_ALUNO";

    $result = oci_parse($conn_ora, $querry);
              oci_execute($result);

    while($row_alunos = oci_fetch_array($result)){
        echo '<option data-value="' . $row_alunos['CD_ALUNO'] . '" data-option="' . $row_alunos['RESULTADO'] . '">' . $row_alunos['RESULTADO'] . '</option>';
    }
?>