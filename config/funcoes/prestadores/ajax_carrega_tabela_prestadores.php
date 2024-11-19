<?php

include '../../../conexao.php';

$cons_prestadores = "SELECT pre.CD_SEQ_PRESTADOR,
                            pre.CRACHA,
                            pre.NM_PRESTADOR,
                            SUBSTR(pre.CPF, 1, 3) || '.' || SUBSTR(pre.CPF, 3, 3) || '.' || SUBSTR(pre.CPF, 7, 3) || '-' || SUBSTR(pre.CPF, 10, 2) AS CPF_MASKED,
                            DECODE (pre.TIPO,
                                    'PR', 'PROVEDORIA',
                                    'IN', 'INSTRUMENTADOR',
                                    'NÃO ENCONTRADO') AS TIPO,
                            pre.TP_STATUS,
                            TO_CHAR(pre.DT_INICIO, 'DD/MM/YYYY') AS DT_INICIO,
                            TO_CHAR(pre.DT_FIM, 'DD/MM/YYYY') AS  DT_FIM
                     FROM port_catraca.PRESTADORES pre
                     ORDER BY 3 ASC";
$res_prestadores = oci_parse($conn_ora, $cons_prestadores);
                   oci_execute($res_prestadores);
?>

<div class="div_br"></div>  

<table class="table table-striped" style="text-align: center;">

    <thead>
        <th style="text-align: center;"> Crachá</th>
        <th style="text-align: center;"> Nome</th>
        <th style="text-align: center;"> CPF</th>
        <th style="text-align: center;"> Tipo</th>
        <th style="text-align: center;"> Status</th>
        <th style="text-align: center;"> Inicio</th> 
        <th style="text-align: center;"> Fim</th>
        <th style="text-align: center;"> Ativar</th>
        <th style="text-align: center;"> Excluir</th>
        <th style="text-align: center;"> Editar</th>
    </thead>

    <tbody>
        <?php
        while($row_prestadores = oci_fetch_array($res_prestadores)){

            echo '<tr style="text-align: center;">';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_prestadores['CRACHA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_prestadores['NM_PRESTADOR'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_prestadores['CPF_MASKED'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_prestadores['TIPO'] . '</td>';

                if($row_prestadores['TP_STATUS'] == 'A'){
                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Terceiro Ativo  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png"></span>' . '</td>';
                }else{
                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Terceiro Inativo  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png"></span>' . '</td>';
                }

                echo '<td class="align-middle" style="text-align: center;">'  .  $row_prestadores['DT_INICIO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_prestadores['DT_FIM'] . '</td>';
    
                if ($row_prestadores['TP_STATUS'] == 'I'){
                    ?><td class="align-middle" style="text-align: center;"><button onclick="mudar_status('<?php echo $row_prestadores['CD_SEQ_PRESTADOR'];?>','<?php echo $row_prestadores['TP_STATUS'];?>')" class="btn btn-primary"><i class="fa-solid fa-check"></i></button></td><?php            
                } else {
                    ?><td class="align-middle" style="text-align: center;"><button onclick="mudar_status('<?php echo $row_prestadores['CD_SEQ_PRESTADOR'];?>','<?php echo $row_prestadores['TP_STATUS'];?>')" class="btn btn-adm"><i class="fa-solid fa-xmark"></i></button></td><?php
                }
                ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_alert('Tem certeza que deseja deletar o usuário?','deletar_prestador(<?php echo $row_prestadores['CD_SEQ_PRESTADOR'];?>)')" class="btn btn-adm"><i class="fas fa-trash-alt"></i></button></td>
                <td class="align-middle" style="text-align: center;"><button onclick="abre_canguru();editar_prestador('<?php echo $row_prestadores['CD_SEQ_PRESTADOR'];?>');" class="btn btn-adm" style="background-color: #3185c1 !important; border-color: #3185c1 !important;"><i class="fa-solid fa-pen-to-square"></i></button></td>    

        <?php
            echo '</tr>';
        }
        ?>
    </tbody>
</table>