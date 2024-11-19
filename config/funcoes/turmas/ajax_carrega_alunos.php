<?php

include '../../../conexao.php';

$cd_turma = $_POST['cd_turma'];

$querry = "SELECT alu.CD_TURMA, alu.CD_ALUNO, alu.NM_ALUNO, alu.RG AS RG_MASKED, alu.CD_CRACHA, alu.SN_ATIVO , alu.MATRICULA
               FROM port_catraca.Alunos alu
               WHERE alu.CD_TURMA = $cd_turma
               ORDER BY alu.NM_ALUNO";

$result = oci_parse($conn_ora, $querry);
oci_execute($result);

?>

<div class="div_br"> </div>

<table class="table table-striped" style="text-align: center;">
    <thead>
        <th style="text-align: center;"> Matricula </th>
        <th style="text-align: center;"> Nome do Aluno</th>
        <th style="text-align: center;"> RG</th>
        <th style="text-align: center;"> Crachá</th>
        <th style="text-align: center;"> Status</th>
        <th style="text-align: center;"> Ativar</th>
        <th style="text-align: center;"> Editar </th>
        <th style="text-align: center;"> Excluir</th>
    </thead>
    <tbody>
        <?php
        while ($row_alunos = oci_fetch_array($result)) {
            echo '<tr style="text-align: center;">';
            echo '<td class="align-middle" style="text-align: center;">' . $row_alunos['MATRICULA'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_alunos['NM_ALUNO'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_alunos['RG_MASKED'] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">'  .  $row_alunos['CD_CRACHA'] . '</td>';
            if ($row_alunos['SN_ATIVO'] == 'A') {
                echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Aluno Ativo  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png"></span></td>';
        ?><td class="align-middle" style="text-align: center;">
                    <button onclick="ajax_muda_status_aluno('<?php echo $row_alunos['CD_TURMA']; ?>',
'<?php echo $row_alunos['CD_ALUNO']; ?>','<?php echo $row_alunos['SN_ATIVO']; ?>');"
                        class="btn btn-adm"><i class="fa-solid fa-xmark">
                        </i></button>
                </td>
            <?php
            } else {
                echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Aluno Inativo  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png"></span></td>';
            ?>
                <td class="align-middle" style="text-align: center;"><button onclick="ajax_muda_status_aluno('<?php echo $row_alunos['CD_TURMA']; ?>',
            '<?php echo $row_alunos['CD_ALUNO']; ?>',
            '<?php echo $row_alunos['SN_ATIVO']; ?>');" class="btn btn-primary">
                        <i class="fa-solid fa-check"></i></button></td>
            <?php } ?>
            <td class="align-middle" style="text-align: center;"> <button style="background-color: #3185c1 !important; border-color: #3185c1 !important; color: white !important; padding:0.7rem  0.7rem; border: none;     border-radius: 0.2rem;" onclick="abre_modal('<?php echo $row_alunos['MATRICULA']; ?>' , '<?php echo $row_alunos['NM_ALUNO'] ?>')" <i class="fa-solid fa-pen-to-square"></i></td>
            <td class="align-middle" style="text-align: center;">
                <button onclick="ajax_alert('Tem certeza que deseja deletar esse Aluno? Todos os acessos de Catracas relacionados a ele serão Excluidos!','ajax_delete_aluno(<?php echo $row_alunos['CD_TURMA']; ?>,<?php echo $row_alunos['CD_ALUNO']; ?>)')" class="btn btn-adm"><i class="fas fa-trash-alt"></i></button>
            </td><?php
                    echo '</tr>';
                }
                    ?>
    </tbody>
</table>