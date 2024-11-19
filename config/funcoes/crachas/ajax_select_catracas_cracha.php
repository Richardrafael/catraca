<?php
    include '../../../conexao.php';

    $cracha = $_POST['cd_cracha'];
    $tipo = $_POST['tipo'];

    $querry =  "SELECT cra.CD_CATRACA, cat.NM_CATRACA, cra.CD_CRACHA
                FROM port_catraca.CRACHAS cra
                INNER JOIN port_catraca.CATRACA cat
                 ON cat.CD_CATRACA = cra.CD_CATRACA
                WHERE cra.CD_CRACHA = '$cracha'
                AND cra.TIPO = '$tipo'
                ORDER BY cat.NM_CATRACA";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    while($row_catracas = oci_fetch_array($result)){
        ?><div id="<?php echo $row_catracas['CD_CATRACA'];?>" class="item_catracas"><?php echo $row_catracas['NM_CATRACA'] ?> <a style="font-size: 10px;" onclick="ajax_alert('Tem certeza que deseja remover essa catraca?','deletar_catraca(<?php echo $row_catracas['CD_CATRACA']; ?>)')"><i class="fa-solid fa-xmark"></i></a></div><?php
    }
?>