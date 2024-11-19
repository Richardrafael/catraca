<?php
    include '../../../conexao.php';

    $cracha = $_POST['cracha_editar'];
    $tipo = $_POST['tipo'];

    $querry = "SELECT cat.CD_CATRACA, cat.NM_CATRACA
               FROM port_catraca.CATRACA cat
               WHERE cat.CD_CATRACA NOT IN (SELECT cra.cd_catraca
                                            FROM port_catraca.CRACHAS cra
                                            WHERE cra.CD_CRACHA = '$cracha'
                                            AND cra.TIPO = '$tipo')
               ORDER BY cat.NM_CATRACA";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    echo '<option value="All">Selecione</option>';

    while($row_catracas = oci_fetch_array($result)){
        echo '<option value="' . $row_catracas['CD_CATRACA'] . '">' . $row_catracas['NM_CATRACA'] . '</option>';
    }
?>