<?php 
    include '../../../conexao.php';

    $cd = $_POST['cd'];

    $querry = "SELECT pre.CD_SEQ_PRESTADOR,
                      pre.CRACHA,
                      pre.DS_RFID,
                      pre.NM_PRESTADOR,
                      SUBSTR(pre.CPF, 1, 3) || '.' || SUBSTR(pre.CPF, 3, 3) || '.' || SUBSTR(pre.CPF, 7, 3) || '-' || SUBSTR(pre.CPF, 10, 2) AS CPF_MASKED,
                      pre.TIPO,
                      pre.TP_STATUS,
                      TO_CHAR(pre.DT_INICIO, 'YYYY-MM-DD') AS DT_INICIO,
                      TO_CHAR(pre.DT_FIM, 'YYYY-MM-DD') AS  DT_FIM
               FROM port_catraca.PRESTADORES pre
               WHERE pre.CD_SEQ_PRESTADOR = '$cd'";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_prestadores = oci_fetch_array($result))
    {
        $CRACHA = $row_prestadores['CRACHA'];
        $DS_RFID = $row_prestadores['DS_RFID'];
        $NM_PRESTADOR = $row_prestadores['NM_PRESTADOR'];
        $CPF = $row_prestadores['CPF_MASKED'];
        $TIPO = $row_prestadores['TIPO'];
        $TP_STATUS = $row_prestadores['TP_STATUS'];
        $DT_INICIO = $row_prestadores['DT_INICIO'];
        $DT_FIM = $row_prestadores['DT_FIM'];
        $CD_SEQ_PRESTADOR = $row_prestadores['CD_SEQ_PRESTADOR'];

        $array = [$CRACHA, $NM_PRESTADOR, $CPF, $TIPO, $TP_STATUS, $DT_INICIO, $DT_FIM, $CD_SEQ_PRESTADOR,$DS_RFID];
    }
    echo json_encode($array);
?>