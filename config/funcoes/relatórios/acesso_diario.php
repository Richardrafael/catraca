<?php

include '../../../conexao.php';

$nm_pesquisa = $_POST['nm_pesquisa'];
$cd_cracha = $_POST['cd_cracha'];
$tp_cracha = $_POST['tp_cracha'];
$cd_catraca = $_POST['cd_catraca'];
$dt_inicio = $_POST['dt_inicio'];
$dt_fim = $_POST['dt_fim'];

$query =  "SELECT res.NM_CATRACA, tip.DS_TIPO AS TIPO, TO_CHAR(res.DATA_HORA, 'DD/MM/YYYY HH24:Mi') AS DATA_HORA, res.NOME, res.CRACHA,
                  Decode(res.ENT_SAI,
                         '0', 'Entrada',
                         '1', 'Saida',
                         'Indefinido') AS ENT_SAI
            FROM (
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, pac.NM_PACIENTE AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN dbamv.ATENDIME atd
                ON (logc.TIPO = 'P' AND CAST(atd.CD_ATENDIMENTO AS VARCHAR(12)) = logc.CRACHA)
                LEFT JOIN dbamv.PACIENTE pac
                ON (logc.TIPO = 'P' AND pac.CD_PACIENTE = atd.CD_PACIENTE)
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'P'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, sta.NM_FUNCIONARIO AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN dbamv.STA_TB_FUNCIONARIO sta
                ON (logc.TIPO = 'F' AND LPAD((sta.CHAPA || '00'), '12', '0') = logc.CRACHA)
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'F'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, pre.NM_PRESTADOR  AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN dbamv.PRESTADOR_TIP_COMUN tip
                ON (logc.TIPO = 'M' AND tip.CD_TIP_COMUN = '15' AND LPAD((tip.DS_TIP_COMUN_PREST || '00'), '12', '0') = logc.CRACHA)
                LEFT JOIN dbamv.PRESTADOR pre
                ON (logc.TIPO = 'M' AND (pre.CD_PRESTADOR = tip.CD_PRESTADOR OR pre.NR_CPF_CGC = logc.CRACHA))
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'M'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, ter.NM_TERCEIRO AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN port_catraca.TERCEIROS ter
                ON (logc.TIPO = 'T' AND ter.CRACHA = logc.CRACHA)
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'T'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, alu.NM_ALUNO AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN port_catraca.ALUNOS alu
                ON (logc.TIPO = 'AL' AND alu.CD_CRACHA = logc.CRACHA)
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'AL'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, ptp.NM_NOME AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN dbamv.MVTO_VISITA_ACOM mvac
                ON (logc.TIPO = 'A' AND logc.CRACHA = CAST(mvac.CD_ID_VISITA_ACOM AS VARCHAR(12)))
                LEFT JOIN dbamv.PT_PESSOA ptp
                ON (logc.TIPO = 'A' AND ((ptp.CD_PESSOA = mvac.CD_PESSOA)) OR (ptp.CD_PESSOA = mvac.CD_PESSOA))
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'A'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, ptp.NM_NOME AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN dbamv.MVTO_VISITA_ACOM mvac
                ON (logc.TIPO = 'V' AND logc.CRACHA = CAST(mvac.CD_ID_VISITA_ACOM AS VARCHAR(12)))
                LEFT JOIN dbamv.PT_PESSOA ptp
                ON (logc.TIPO = 'V' AND ((ptp.CD_PESSOA = mvac.CD_PESSOA)) OR (ptp.CD_PESSOA = mvac.CD_PESSOA))
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'V'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO,
                        CASE
                            WHEN mvad.TIPO_PERMANENCIA = 'P' THEN pre.NM_PRESTADOR
                            ELSE ptp.NM_NOME
                        END AS NOME,
                        logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN dbamv.PT_MVTO_ADM mvad
                ON (logc.TIPO = 'VE' AND logc.CRACHA = CAST(mvad.CD_CARTAO_CRACHA AS VARCHAR(12)))
                LEFT JOIN dbamv.PT_PESSOA ptp
                ON (logc.TIPO = 'VE' AND ptp.CD_PESSOA = mvad.CD_PESSOA)
                LEFT JOIN dbamv.PRESTADOR pre
                ON (logc.TIPO = 'VE' AND pre.CD_PRESTADOR = mvad.CD_PRESTADOR)
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'VE'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, prest.NM_PRESTADOR AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN port_catraca.PRESTADORES prest
                ON (logc.TIPO = 'PR' AND prest.CRACHA = logc.CRACHA)
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'PR'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
                
                UNION ALL
                
                SELECT logc.CRACHA, cat.NM_CATRACA, logc.DATA_HORA, logc.TIPO, alu.NM_ALUNO AS NOME, logc.ENT_SAI
                FROM dbamv.LOG_FUNC_CATRACA logc
                INNER JOIN port_catraca.CATRACA cat
                ON cat.ID_CATRACA = logc.ID_EQUIPAMENTO
                LEFT JOIN port_catraca.ALUNOS alu
                ON (logc.TIPO = 'E' AND alu.CD_CRACHA = logc.CRACHA)
                WHERE logc.DATA_HORA BETWEEN TO_DATE('$dt_inicio', 'DD/MM/YYYY HH24:Mi') AND TO_DATE('$dt_fim', 'DD/MM/YYYY HH24:Mi')
                AND logc.TIPO = 'E'
                AND logc.MOTIVO_RECUSADO IS NULL
                AND logc.ID_EQUIPAMENTO IN ($cd_catraca)
            ) res
            INNER JOIN port_catraca.TIPOS tip
             ON tip.NM_TIPO = res.TIPO
            WHERE res.TIPO IN ($tp_cracha)";
if(strlen($nm_pesquisa) > 0){
    $query .= " AND UPPER(res.NOME) LIKE UPPER('$nm_pesquisa%')";
}
if(strlen($cd_cracha) > 0){
    $query .= " AND res.CRACHA = '$cd_cracha'";
}
$query .= " ORDER BY res.NM_CATRACA, res.TIPO, res.DATA_HORA, res.NOME";
$res = oci_parse($conn_ora, $query);
       oci_execute($res);
?>

<div class="div_br"></div>  

<table class="table table-striped" id="table" style="text-align: center;">

    <thead>
        <th style="text-align: center;"> Nome Catraca</th>
        <th style="text-align: center;"> Tipo</th>
        <th style="text-align: center;"> Data</th>
        <th style="text-align: center;"> Nome</th>
        <th style="text-align: center;"> Cracha</th>
        <th style="text-align: center;"> Entrada/Saida</th>
    </thead>

    <tbody>
        <?php
        while($row_res = oci_fetch_array($res)){

            echo '<tr style="text-align: center;">';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_res['NM_CATRACA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_res['TIPO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_res['DATA_HORA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_res['NOME'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_res['CRACHA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_res['ENT_SAI'] . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<!-- JS DATA TABLE -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 colunas', '25 colunas', '50 colunas', 'Mostrar todas' ]
            ],
            buttons: [
                'pageLength', 'csv', 'excel', 'print'
            ],
            pageLength: 10,
            colReorder: true,
            start: 1,
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "search": "Pesquisar:",
                "paginate": {
                    "first": "Primeira",
                    "last": "Última",
                    "next": "<i class='fa-solid fa-angles-right'></i>",
                    "previous": "<i class='fa-solid fa-angles-left'></i>"
                }
            }
        });
    });
</script>
