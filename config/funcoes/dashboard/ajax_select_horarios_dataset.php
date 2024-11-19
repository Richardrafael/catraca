<?php 
    include '../../../conexao.php';

    $querry =  "SELECT (TO_CHAR(SYSTIMESTAMP - INTERVAL '1' HOUR * (24 - LEVEL), 'HH24:') || '00') AS HORA
                FROM DUAL
                CONNECT BY LEVEL <= 24";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    $array = [];
    while($row_acessos = oci_fetch_array($result))
    {
        array_push($array, $row_acessos['HORA']);
    }
    echo json_encode($array);
?>