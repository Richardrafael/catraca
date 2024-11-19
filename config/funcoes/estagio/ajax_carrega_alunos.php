<?php
    include '../../../conexao.php';

    $cd_estagio = $_POST['cd_estagio'];

    $querry =  "SELECT aluest.CD_ESTAGIO, aluest.CD_ALUNO_ESTAGIO, aluest.CD_ALUNO, alu.NM_ALUNO, tur.NM_TURMA, alu.RG AS RG_MASKED, aluest.SN_ATIVO
                FROM port_catraca.ALUNOS_ESTAGIO aluest
                INNER JOIN port_catraca.ALUNOS alu
                 ON alu.cd_aluno = aluest.cd_aluno
                INNER JOIN port_catraca.TURMAS tur
                 ON tur.CD_TURMA = alu.CD_TURMA
                WHERE aluest.CD_ESTAGIO = $cd_estagio
                ORDER BY alu.NM_ALUNO";

    $result = oci_parse($conn_ora, $querry);
              oci_execute($result);

?>

<div class="div_br"> </div>  

<table class="table table-striped" style="text-align: center;">
    <thead>
        <th style="text-align: center;"> Nome do Aluno</th>
        <th style="text-align: center;"> RG</th>
        <th style="text-align: center;"> Turma</th>
        <th style="text-align: center;"> Status</th>
        <th style="text-align: center;"> Ativar</th>
        <th style="text-align: center;"> Excluir</th>
    </thead>
    <tbody>
        <?php
        while($row_alunos = oci_fetch_array($result)){
            echo '<tr style="text-align: center;">';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_alunos['NM_ALUNO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_alunos['RG_MASKED'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_alunos['NM_TURMA'] . '</td>';
                if($row_alunos['SN_ATIVO'] == 'A'){
                    echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Aluno Ativo  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png"></span></td>';
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_muda_status_aluno('<?php echo $row_alunos['CD_ESTAGIO'];?>','<?php echo $row_alunos['CD_ALUNO'];?>','<?php echo $row_alunos['SN_ATIVO'];?>');" class="btn btn-adm"><i class="fa-solid fa-xmark"></i></button></td><?php
                }else{
                    echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Aluno Inativo  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png"></span></td>';
                    ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_muda_status_aluno('<?php echo $row_alunos['CD_ESTAGIO'];?>','<?php echo $row_alunos['CD_ALUNO'];?>','<?php echo $row_alunos['SN_ATIVO'];?>');" class="btn btn-primary"><i class="fa-solid fa-check"></i></button></td><?php
                }
                ?><td class="align-middle" style="text-align: center;"><button onclick="ajax_alert('Tem certeza que deseja deletar esse Aluno?','ajax_delete_aluno(<?php echo $row_alunos['CD_ESTAGIO'];?>,<?php echo $row_alunos['CD_ALUNO_ESTAGIO'];?>)')" class="btn btn-adm"><i class="fas fa-trash-alt"></i></button></td><?php 

            echo '</tr>';
        }
        ?>
    </tbody>
</table>