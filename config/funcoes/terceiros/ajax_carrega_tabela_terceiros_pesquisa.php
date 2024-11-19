<?php

include '../../../conexao.php';

$terceiro = $_POST['nm_terceiro'];

$querry = "SELECT   ter.CD_TERCEIRO,
                    ter.CRACHA,
                    ter.DS_RFID,
                    ter.NM_TERCEIRO,
                    TO_CHAR(ter.DT_NASCIMENTO, 'DD/MM/YYYY') AS DT_NASCIMENTO,
                    ter.RG AS RG_MASKED,
                    SUBSTR(ter.CPF, 1, 3) || '.' || SUBSTR(ter.CPF, 3, 3) || '.' || SUBSTR(ter.CPF, 7, 3) || '-' || SUBSTR(ter.CPF, 10, 2) AS CPF_MASKED,
                    SUBSTR(ter.CNPJ, 1, 2) || '.' || SUBSTR(ter.CNPJ, 3, 3) || '.' || SUBSTR(ter.CNPJ, 6, 3) || '/' || SUBSTR(ter.CNPJ, 9, 4) || '-' || SUBSTR(ter.CNPJ, 13, 2) AS CNPJ_MASKED,
                    ter.NM_EMPRESA,
                    ter.TP_STATUS,
                    TO_CHAR(ter.DT_INICIO, 'DD/MM/YYYY') AS DT_INICIO,
                    TO_CHAR(ter.DT_FIM, 'DD/MM/YYYY') AS  DT_FIM
                    FROM port_catraca.TERCEIROS ter
                    WHERE ter.NM_TERCEIRO LIKE (SELECT UPPER('%$terceiro%') FROM DUAL)
                    AND ter.CD_USUARIO_CADASTRO <> 'TEMP_IEP'
                    ORDER BY 3 ASC";
$result = oci_parse($conn_ora, $querry);
          oci_execute($result);
?>

<div class="div_br"> </div>  

<table class="table table-striped" style="text-align: center;">

    <thead>
        
        <th style="text-align: center;"> Crachá</th>
        <th style="text-align: center;"> Rf-Id</th>
        <th style="text-align: center;"> Nome</th>
        <th style="text-align: center;"> Nascimento</th>
        <th style="text-align: center;"> RG</th>
        <th style="text-align: center;"> CPF</th>
        <th style="text-align: center;"> CNPJ</th>
        <th style="text-align: center;"> Empresa</th>
        <th style="text-align: center;"> Status</th>
        <th style="text-align: center;"> Inicio</th> 
        <th style="text-align: center;"> Fim</th>
        <th style="text-align: center;"> Ativar</th>
        <th style="text-align: center;"> Excluir</th>
        <th style="text-align: center;"> Editar</th>

    </thead>

    <tbody>
        <?php
        while($row_terceiros = oci_fetch_array($result)){

            echo '<tr style="text-align: center;">';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['CRACHA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['DS_RFID'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['NM_TERCEIRO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['DT_NASCIMENTO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['RG_MASKED'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['CPF_MASKED'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['CNPJ_MASKED'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['NM_EMPRESA'] . '</td>';

                if($row_terceiros['TP_STATUS'] == 'A'){
                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Terceiro Ativo  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png"></span>' . '</td>';
                }else{
                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Terceiro Inativo  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png"></span>' . '</td>';
                }

                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['DT_INICIO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_terceiros['DT_FIM'] . '</td>';
    
                if ($row_terceiros['TP_STATUS'] == 'I'){
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_mudar_status('<?php echo $row_terceiros['CD_TERCEIRO'];?>','<?php echo $row_terceiros['TP_STATUS'];?>')" class="btn btn-primary"><i class="fa-solid fa-check"></i></button></td><?php            
                } else {
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_mudar_status('<?php echo $row_terceiros['CD_TERCEIRO'];?>','<?php echo $row_terceiros['TP_STATUS'];?>')" class="btn btn-adm"><i class="fa-solid fa-xmark"></i></button></td><?php
                }
                ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_alert('Tem certeza que deseja deletar o usuário?','ajax_delete_terceiro(<?php echo $row_terceiros['CD_TERCEIRO'];?>)')" class="btn btn-adm"><i class="fas fa-trash-alt"></i></button></td>
                <td class="align-middle" style="text-align: center;"><button onclick="abre_canguru();ajax_editar_terceiro('<?php echo $row_terceiros['CD_TERCEIRO'];?>');" class="btn btn-adm" style="background-color: #3185c1 !important; border-color: #3185c1 !important;"><i class="fa-solid fa-pen-to-square"></i></button></td><?php
            echo '</tr>';
        }
        ?>
    </tbody>
</table>