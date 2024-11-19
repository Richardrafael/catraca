<?php
    include '../../../conexao.php';

    $querry = "SELECT cat.ID_CATRACA, cat.NM_CATRACA
               FROM port_catraca.CATRACA cat
               ORDER BY cat.NM_CATRACA";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_catracas = oci_fetch_array($result)){
        echo '<div class="option" data-value="' . $row_catracas['ID_CATRACA'] . '">' . $row_catracas['NM_CATRACA'] . '</div>';
    }
?>