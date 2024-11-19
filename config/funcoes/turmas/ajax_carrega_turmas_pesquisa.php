<?php

    include '../../../conexao.php';

    $nm_turma = $_POST['nm_pesquisa'];

    $querry = "SELECT turmas.CD_TURMA, turmas.NM_TURMA, turmas.SN_ATIVO, turmas.HR_INICIO, turmas.HR_FIM
               FROM port_catraca.TURMAS turmas
               WHERE turmas.NM_TURMA LIKE UPPER('%$nm_turma%')
               ORDER BY turmas.CD_TURMA";

    $result = oci_parse($conn_ora, $querry);
              oci_execute($result);

?>

<div class="div_br"> </div>  

<table class="table table-striped" style="text-align: center;">
    <thead>
        <th style="text-align: center;">Nome da Turma</th>
        <th style="text-align: center;">Inicio</th>
        <th style="text-align: center;">Fim</th>
        <th style="text-align: center;">Status</th>
        <th style="text-align: center;">Ativar</th>
        <th style="text-align: center;">Excluir</th>
        <th style="text-align: center;">Alunos</th>
        <th style="text-align: center;">Editar</th>
    </thead>
    <tbody>
        <?php
        while($row_turmas = oci_fetch_array($result)){
            echo '<tr style="text-align: center;">';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_turmas['NM_TURMA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_turmas['HR_INICIO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_turmas['HR_FIM'] . '</td>';

                if($row_turmas['SN_ATIVO'] == 'A'){
                    echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Turma Ativa  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png"></span></td>';
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_muda_status('<?php echo $row_turmas['CD_TURMA'];?>','<?php echo $row_turmas['SN_ATIVO'];?>')" class="btn btn-adm"><i class="fa-solid fa-xmark"></i></button></td><?php
                }else{
                    echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Turma Inativa  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png"></span></td>';
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_muda_status('<?php echo $row_turmas['CD_TURMA'];?>','<?php echo $row_turmas['SN_ATIVO'];?>')" class="btn btn-primary"><i class="fa-solid fa-check"></i></button></td><?php
                }
                ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_alert('Tem certeza que deseja deletar essa Turma? \nTodos os Alunos relacionados a ela serão Excluidos!','ajax_delete_turma(<?php echo $row_turmas['CD_TURMA']; ?>)')" class="btn btn-adm"><i class="fas fa-trash-alt"></i></button></td>
                <td class="align-middle" style="text-align: center;"><button onclick="abre_visualizar_turma('<?php echo $row_turmas['CD_TURMA'];?> ',' <?php echo $row_turmas['NM_TURMA'];?>'); carrega_tabela_alunos('<?php echo $row_turmas['CD_TURMA'];?>');" class="btn btn-adm;" style="background-color: #3185c1 !important; border-color: #3185c1 !important; color: white !important; "><i class="fa-solid fa-person-circle-plus"></i></button></td>
                <td class="align-middle" style="text-align: center;"><button onclick="abre_canguru_turma(); carrega_editar_turma('<?php echo $row_turmas['CD_TURMA'];?>');" class="btn btn-adm;" style="background-color: #3185c1 !important; border-color: #3185c1 !important; color: white !important; "><i class="fa-solid fa-pen-to-square"></i></button></td><?php

            echo '</tr>';
        }
        ?>
    </tbody>
</table>