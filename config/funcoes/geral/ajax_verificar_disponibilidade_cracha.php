<?php
    include '../../../conexao.php';

    $cracha = $_POST['cracha_pesquisa'];

    /* Verifica se há um usuário com o cracha selecionado e traz de qual tipo ele é */
    $querry =  "SELECT res.CRACHA, res.TIPO
                FROM (
                    --Terceiros
                    SELECT ter.CRACHA, 'T' AS TIPO
                    FROM port_catraca.TERCEIROS ter
                    WHERE ter.CRACHA = '$cracha'

                    UNION

                    --Funcionários
                    SELECT LPAD((sta.CHAPA || '00'), '12', '0') AS CRACHA, 'F' AS TIPO
                    FROM dbamv.STA_TB_FUNCIONARIO sta
                    WHERE LPAD((sta.CHAPA || '00'), '12', '0') = '$cracha'

                    UNION

                    --Médicos
                    SELECT LPAD((tip.DS_TIP_COMUN_PREST || '00'), '12', '0') AS CRACHA, 'M' AS TIPO
                    FROM dbamv.PRESTADOR pre
                    INNER JOIN dbamv.PRESTADOR_TIP_COMUN tip
                    ON tip.CD_PRESTADOR = pre.CD_PRESTADOR
                    WHERE tip.CD_TIP_COMUN = 15
                    AND LPAD((tip.DS_TIP_COMUN_PREST || '00'), '12', '0') = '$cracha'

                    UNION

                    --Alunos
                    SELECT alu.CD_CRACHA AS CRACHA, 'A' AS TIPO
                    FROM port_catraca.ALUNOS alu
                    WHERE alu.CD_CRACHA = '$cracha'

                    UNION

                    --Prestadores
                    SELECT pre.CRACHA, 'PR' AS TIPO
                    FROM port_catraca.PRESTADORES pre
                    WHERE pre.CRACHA = '$cracha'
                )res";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_crachas = oci_fetch_array($result)){
        $tipo = $row_crachas['TIPO'];
    }
    echo $tipo;
?>