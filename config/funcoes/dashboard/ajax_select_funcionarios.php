<?php 
    include '../../../conexao.php';

    $querry =   "SELECT (SELECT COUNT(sta.CHAPA)
                         FROM dbamv.STA_TB_FUNCIONARIO sta
                         WHERE sta.TP_SITUACAO = 'A') AS QTD_ATIVOS,
                        (SELECT COUNT(sta.CHAPA)
                         FROM dbamv.STA_TB_FUNCIONARIO sta
                         WHERE sta.TP_SITUACAO NOT IN ('A', 'D', 'Q'))AS QTD_INATIVOS
                 FROM DUAL";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_funcionarios = oci_fetch_array($result))
    {
        $ativos = $row_funcionarios['QTD_ATIVOS'];
        $inativos = $row_funcionarios['QTD_INATIVOS'];

        $array = [$ativos, $inativos];
    }
    echo json_encode($array);
?>