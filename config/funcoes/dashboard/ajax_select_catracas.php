<?php 
    include '../../../conexao.php';

    $querry =  "SELECT (SELECT COUNT(cat.CD_CATRACA)
                        FROM port_catraca.CATRACA cat
                        WHERE cat.SN_ATIVO = 'A') AS QTD_ATIVOS,
                       (SELECT COUNT(cat.CD_CATRACA)
                        FROM port_catraca.CATRACA cat
                        WHERE cat.SN_ATIVO = 'I')AS QTD_INATIVOS
                FROM DUAL";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_catracas = oci_fetch_array($result))
    {
        $ativos = $row_catracas['QTD_ATIVOS'];
        $inativos = $row_catracas['QTD_INATIVOS'];

        $array = [$ativos, $inativos];
    }
    echo json_encode($array);
?>