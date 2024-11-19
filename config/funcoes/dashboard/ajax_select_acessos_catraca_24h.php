<?php 
    include '../../../conexao.php';

    $querry =  "SELECT res.ID_CATRACA, res.NM_CATRACA, SUM(res.ACESSOS) AS ACESSOS
                FROM (
                    SELECT cat.ID_CATRACA, cat.NM_CATRACA, COUNT(logc.CRACHA) AS ACESSOS
                    FROM dbamv.LOG_FUNC_CATRACA logc
                    INNER JOIN port_catraca.CATRACA cat
                    ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                    WHERE TO_DATE((TO_CHAR(logc.DATA_HORA, 'DD/MM/YYYY HH24:') || '00'), 'DD/MM/YYYY HH24:MI') > TO_DATE((TO_CHAR(SYSDATE - 1, 'DD/MM/YYYY HH24:') || '00'), 'DD/MM/YYYY HH24:MI')
                    AND logc.MOTIVO_RECUSADO IS NULL
                    GROUP BY cat.ID_CATRACA, cat.NM_CATRACA
                    
                    UNION ALL
                    
                    SELECT cat.ID_CATRACA, cat.NM_CATRACA, 0 AS ACESSOS
                    FROM port_catraca.CATRACA cat
                )res
                GROUP BY res.ID_CATRACA, res.NM_CATRACA
                ORDER BY res.ID_CATRACA ASC";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    $array = [];
    while($row_acessos = oci_fetch_array($result)){
        $NOME = $row_acessos['NM_CATRACA'];
        $ACESSOS = $row_acessos['ACESSOS'];

        array_push($array, [$NOME, $ACESSOS]);
    }
    echo json_encode($array);
?>