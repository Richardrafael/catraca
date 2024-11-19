<?php 
    include '../../../conexao.php';

    $id = $_POST['id'];

    $querry = "SELECT   ter.CRACHA,
                        ter.DS_RFID,
                        ter.NM_TERCEIRO,
                        TO_CHAR(ter.DT_NASCIMENTO, 'YYYY/MM/DD') AS DT_NASCIMENTO,
                        SUBSTR(ter.RG, 1, 2) || '.' || SUBSTR(ter.RG, 3, 3) || '.' || SUBSTR(ter.RG, 6, 3) || '-' || SUBSTR(ter.RG, 9, 1) AS RG_MASKED,
                        SUBSTR(ter.CPF, 1, 3) || '.' || SUBSTR(ter.CPF, 3, 3) || '.' || SUBSTR(ter.CPF, 7, 3) || '-' || SUBSTR(ter.CPF, 10, 2) AS CPF_MASKED,
                        SUBSTR(ter.CNPJ, 1, 2) || '.' || SUBSTR(ter.CNPJ, 3, 3) || '.' || SUBSTR(ter.CNPJ, 6, 3) || '/' || SUBSTR(ter.CNPJ, 9, 4) || '-' || SUBSTR(ter.CNPJ, 13, 2) AS CNPJ_MASKED,
                        ter.NM_EMPRESA,
                        ter.TP_STATUS,
                        TO_CHAR(ter.DT_INICIO, 'YYYY/MM/DD') AS DT_INICIO,
                        TO_CHAR(ter.DT_FIM, 'YYYY/MM/DD') AS  DT_FIM,
                        ter.CD_TERCEIRO
                        FROM port_catraca.TERCEIROS ter 
                        WHERE ter.CD_TERCEIRO =  '$id'";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_terceiros = oci_fetch_array($result))
    {
        $CRACHA = $row_terceiros['CRACHA'];
        $NM_TERCEIRO = $row_terceiros['NM_TERCEIRO'];
        $DT_NASCIMENTO = $row_terceiros['DT_NASCIMENTO'];
        $RG = $row_terceiros['RG_MASKED'];
        $CPF = $row_terceiros['CPF_MASKED'];
        $CNPJ = $row_terceiros['CNPJ_MASKED'];
        $NM_EMPRESA = $row_terceiros['NM_EMPRESA'];
        $TP_STATUS = $row_terceiros['TP_STATUS'];
        $DT_INICIO = $row_terceiros['DT_INICIO'];
        $DT_FIM = $row_terceiros['DT_FIM'];
        $CD_TERCEIRO = $row_terceiros['CD_TERCEIRO'];
        $RF_ID = $row_terceiros['DS_RFID'];

        $array = [$CRACHA, $NM_TERCEIRO, $DT_NASCIMENTO, $RG, $CPF, $CNPJ, $NM_EMPRESA, $TP_STATUS, $DT_INICIO, $DT_FIM, $CD_TERCEIRO, $RF_ID];
    }
    echo json_encode($array);
?>