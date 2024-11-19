<?php

include '../../../conexao.php';

$cons_tabela_catracas = "SELECT ct.cd_catraca,
                                ct.nm_catraca,
                                ct.ds_catraca,
                                ct.id_catraca,
                                ct.ip_catraca,
                                ct.sn_ativo
                                FROM PORT_CATRACA.CATRACA ct
                                ORDER BY ct.nm_catraca";
$res_cons_tabela_catracas = oci_parse($conn_ora, $cons_tabela_catracas);
                            oci_execute($res_cons_tabela_catracas);
?>

<div class="div_br"> </div>  

<table class="table table-striped" style="text-align: center;">

    <thead>
        <th style="text-align: center;"> Nome da Catraca</th>
        <th style="text-align: center;"> Descrição</th>
        <th style="text-align: center;"> ID</th>
        <th style="text-align: center;"> IP</th>
        <th style="text-align: center;"> Status</th>
        <th style="text-align: center;"> Ativar</th>
        <th style="text-align: center;"> Excluir</th>
        <th style="text-align: center;"> Editar</th>
    </thead>

    <tbody>
        <?php
        while($row_catracas = oci_fetch_array($res_cons_tabela_catracas)){
            echo '<tr style="text-align: center;">';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_catracas['NM_CATRACA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_catracas['DS_CATRACA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_catracas['ID_CATRACA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_catracas['IP_CATRACA'] . '</td>';

                if($row_catracas['SN_ATIVO'] == 'A'){
                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Catraca Ativa  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png"></span>' . '</td>';
                }else{
                    echo '<td class="align-middle" style="text-align: center;">'  .  '<span data-tooltip="  Catraca Inativa  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png"></span>' . '</td>';
                }

                if ($row_catracas['SN_ATIVO'] == 'I'){
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_muda_status('<?php echo $row_catracas['CD_CATRACA'];?>','<?php echo $row_catracas['SN_ATIVO'];?>')" class="btn btn-primary"><i class="fa-solid fa-check"></i></button></td><?php            
                } else {
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_muda_status('<?php echo $row_catracas['CD_CATRACA'];?>','<?php echo $row_catracas['SN_ATIVO'];?>')" class="btn btn-adm"><i class="fa-solid fa-xmark"></i></button></td><?php
                }
                ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_alert('Tem certeza que deseja deletar essa Catraca? \nTodos os Usuários relacionados a ela serão Atualizados!','ajax_delete_catraca(<?php echo $row_catracas['CD_CATRACA'];?>)')" class="btn btn-adm"><i class="fas fa-trash-alt"></i></button></td>    
                <td class="align-middle" style="text-align: center;"><button onclick="abre_cangurus();ajax_editar_catraca('<?php echo $row_catracas['CD_CATRACA'];?>');" class="btn btn-adm;" style="background-color: #3185c1 !important; border-color: #3185c1 !important; color: white !important; "><i class="fa-solid fa-pen-to-square"></i></button></td><?php
            echo '</tr>';
        }
        ?>
    </tbody>
</table>