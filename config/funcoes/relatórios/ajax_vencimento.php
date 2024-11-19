<?php
    session_start();

    include '../../../conexao.php';

    $query = "SELECT cracha,nm_prestador,tipo,TO_CHAR(dt_inicio,'DD/MM/RRRR') dt_inicio,TO_CHAR(dt_fim,'DD/MM/RRRR') dt_fim,TRUNC(dt_fim) - TRUNC(sysdate) dias
            FROM port_catraca.PRESTADORES da
            WHERE da.tp_status = 'A' ";

    $stid = oci_parse($conn_ora, $query);
    oci_execute($stid);

    $data = array();
    while ($row = oci_fetch_assoc($stid)) {
        $data[] =  $row;
    }

    oci_free_statement($stid);
    oci_close($conn_ora);

    header('Content-Type: application/json');
    echo json_encode(['data' => $data]);
?>