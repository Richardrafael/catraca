<?php 
    include '../../../conexao.php';

    $catracas = $_POST['catracas'];
    $res = [];

    foreach($catracas as $item){
        $ID = $item[0];
        $querry =  "SELECT *
                    FROM(
                        SELECT SUM(cons.QTD) AS QTD, SUBSTR(cons.HORA, 0, 10) AS DT, SUBSTR(cons.HORA, 12, 5) AS HORA
                        FROM(
                            SELECT
                                CAST('0' AS INT) AS QTD,
                                (TO_CHAR(SYSTIMESTAMP - INTERVAL '1' HOUR * (24 - LEVEL), 'DD/MM/YYYY HH24:') || '00') AS HORA
                            FROM DUAL
                            CONNECT BY LEVEL <= 24
                    
                            UNION ALL
                    
                            SELECT COUNT(res.CRACHA) AS QTD, res.HORA
                            FROM(
                                SELECT logc.CRACHA, (TO_CHAR(logc.DATA_HORA, 'DD/MM/YYYY HH24:') || '00') AS HORA
                                FROM dbamv.LOG_FUNC_CATRACA logc
                                WHERE logc.ID_EQUIPAMENTO = '$ID'
                                AND TO_DATE((TO_CHAR(logc.DATA_HORA, 'DD/MM/YYYY HH24:') || '00'), 'DD/MM/YYYY HH24:MI') > TO_DATE((TO_CHAR(SYSDATE - 1, 'DD/MM/YYYY HH24:') || '00'), 'DD/MM/YYYY HH24:MI')
                                AND logc.MOTIVO_RECUSADO IS NULL
                            ) res
                            GROUP BY res.HORA
                        ) cons
                        GROUP BY SUBSTR(cons.HORA, 0, 10), SUBSTR(cons.HORA, 12, 5)
                    ) fin
                    ORDER BY fin.DT ASC, fin.HORA ASC";

        $result = oci_parse($conn_ora, $querry);
        $valida = oci_execute($result);

        $array = [];
        while($row_acessos = oci_fetch_array($result))
        {
            array_push($array, $row_acessos['QTD']);
        }

        array_push($res, array($item[0], $item[1], $item[2], $array));
    }
    echo json_encode($res);
?>