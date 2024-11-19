<?php 
    include '../../../conexao.php';

    $querry =  "SELECT cat.ID_CATRACA, cat.NM_CATRACA
                FROM port_catraca.CATRACA cat
                ORDER BY cat.ID_CATRACA ASC";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    $array = [];
    while($row_catracas = oci_fetch_array($result)){
        $ID = $row_catracas['ID_CATRACA'];
        $NOME = $row_catracas['NM_CATRACA'];

        array_push($array, [$ID, $NOME]);
    }
    echo json_encode($array);
?>