<?php 
    include '../../../conexao.php';

    $querry =  "SELECT (SELECT COUNT(ter.CD_TERCEIRO)
                         FROM port_catraca.TERCEIROS ter) AS QTD_TERCEIROS,
                        (SELECT COUNT(alu.CD_ALUNO)
                         FROM port_catraca.ALUNOS alu)AS QTD_ALUNOS,
                        (SELECT COUNT(aluest.CD_ALUNO_ESTAGIO)
                         FROM port_catraca.ALUNOS_ESTAGIO aluest) AS QTD_ESTAGIARIOS,
                        (SELECT COUNT(pre.CD_SEQ_PRESTADOR)
                         FROM port_catraca.PRESTADORES pre) AS QTD_PRESTADORES,
                        (SELECT COUNT(DISTINCT(cra.CD_CRACHA))
                         FROM port_catraca.CRACHAS cra
                         WHERE cra.TIPO = 'F') AS QTD_FUNCIONARIOS,
                        (SELECT COUNT(DISTINCT(cra.CD_CRACHA))
                         FROM port_catraca.CRACHAS cra
                         WHERE cra.TIPO = 'M') AS QTD_MEDICOS
                FROM DUAL";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_result = oci_fetch_array($result))
    {
        $terceiros = $row_result['QTD_TERCEIROS'];
        $alunos = $row_result['QTD_ALUNOS'];
        $estagiarios = $row_result['QTD_ESTAGIARIOS'];
        $prestadores = $row_result['QTD_PRESTADORES'];
        $funcionarios = $row_result['QTD_FUNCIONARIOS'];
        $medicos = $row_result['QTD_MEDICOS'];

        $array = [$terceiros, $alunos, $estagiarios, $prestadores, $funcionarios, $medicos];
    }
    echo json_encode($array);
?>