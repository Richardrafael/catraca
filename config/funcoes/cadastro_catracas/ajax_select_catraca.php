<?php 
    include '../../../conexao.php';

    $id = $_POST['id'];

    $querry =   "SELECT cat.CD_CATRACA,
                        cat.NM_CATRACA,
                        cat.DS_CATRACA,
                        cat.ID_CATRACA,
                        cat.IP_CATRACA,
                        cat.SN_ATIVO
                        FROM port_catraca.CATRACA cat 
                        WHERE cat.CD_CATRACA =  '$id'";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_catracas = oci_fetch_array($result))
    {
        $CD_CATRACA = $row_catracas['CD_CATRACA'];
        $NM_CATRACA = $row_catracas['NM_CATRACA'];
        $DS_CATRACA = $row_catracas['DS_CATRACA'];
        $ID_CATRACA = $row_catracas['ID_CATRACA'];
        $IP_CATRACA = $row_catracas['IP_CATRACA'];
        $SN_ATIVO = $row_catracas['SN_ATIVO'];

        $array = [$CD_CATRACA, $NM_CATRACA, $DS_CATRACA, $ID_CATRACA, $IP_CATRACA, $SN_ATIVO];
    }
    echo json_encode($array);
?>