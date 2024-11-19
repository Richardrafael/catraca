<?php
    include '../../../conexao.php';

    $cd_pesquisa = $_POST['cd_pesquisa'];
    $tp_pesquisa = $_POST['tp_pesquisa'];

    if($tp_pesquisa == 1){
        //Terrceiros
        $ds_tipo = 'T';
        $querry =  "SELECT ter.CRACHA,
                           ter.NM_TERCEIRO AS NOME,
                           ter.RG , ter.NM_EMPRESA AS TIPO,
                           ter.TP_STATUS
                    FROM port_catraca.TERCEIROS ter
                    WHERE ter.CRACHA = '$cd_pesquisa'";
        $nm_campo = 'RG';
        $nm_campo2 = 'Empresa';
        $nm_campo3 = 'RG';
    }elseif($tp_pesquisa == 2){
        //Funcionarios
        $ds_tipo = 'F';
        $querry =  "SELECT LPAD((sta.CHAPA || '00'), '12', '0') AS CRACHA,
                           sta.NM_FUNCIONARIO AS NOME,
                           sta.CHAPA,
                           sta.DS_FUNCAO AS TIPO,
                           sta.TP_SITUACAO AS TP_STATUS
                    FROM dbamv.STA_TB_FUNCIONARIO sta
                    WHERE sta.CHAPA = '$cd_pesquisa'";
        $nm_campo = 'Matrícula';
        $nm_campo2 = 'Função';
        $nm_campo3 = 'CHAPA';
    }elseif($tp_pesquisa == 3){
        //Alunos
        $ds_tipo = 'A';
        $querry =  "SELECT alu.CD_CRACHA AS CRACHA,
                           alu.NM_ALUNO AS NOME,
                           alu.RG,
                           tur.NM_TURMA AS TIPO,
                           alu.SN_ATIVO AS TP_STATUS
                    FROM port_catraca.ALUNOS alu
                    INNER JOIN port_catraca.TURMAS tur
                    ON tur.CD_TURMA = alu.CD_TURMA
                    WHERE alu.CD_CRACHA = '$cd_pesquisa'";
        $nm_campo = 'RG';
        $nm_campo2 = 'Turma';
        $nm_campo3 = 'RG';
    }elseif($tp_pesquisa == 4){
        //Estagiários
        $ds_tipo = 'E';
        $querry =  "SELECT alu.CD_CRACHA AS CRACHA,
                           alu.NM_ALUNO AS NOME,
                           alu.RG,
                           est.NM_ESTAGIO AS TIPO,
                           aluest.SN_ATIVO AS TP_STATUS
                    FROM port_catraca.ALUNOS_ESTAGIO aluest
                    INNER JOIN port_catraca.ALUNOS alu
                     ON aluest.CD_ALUNO = alu.CD_ALUNO
                    INNER JOIN port_catraca.ESTAGIO est
                     ON aluest.CD_ESTAGIO = est.CD_ESTAGIO
                    WHERE alu.CD_CRACHA = '$cd_pesquisa'";
        $nm_campo = 'RG';
        $nm_campo2 = 'Estágio';
        $nm_campo3 = 'RG';
    }elseif($tp_pesquisa == 5){
        //Médicos
        $ds_tipo = 'M';
        $querry =  "SELECT LPAD((tip.DS_TIP_COMUN_PREST || '00'), '12', '0') AS CRACHA,
                           pre.NM_PRESTADOR AS NOME,
                           pre.DS_CODIGO_CONSELHO AS CRM,
                           pre.DS_CARGO AS TIPO,
                           pre.TP_SITUACAO AS TP_STATUS 
                    FROM dbamv.PRESTADOR_TIP_COMUN tip
                    INNER JOIN dbamv.PRESTADOR pre
                     ON pre.CD_PRESTADOR = tip.CD_PRESTADOR
                    WHERE tip.DS_TIP_COMUN_PREST = '$cd_pesquisa'
                    AND tip.CD_TIP_COMUN = 15";
        $nm_campo = 'CRM';
        $nm_campo2 = 'Função';
        $nm_campo3 = 'CRM';
    }elseif($tp_pesquisa == 6){
        //Prestadores
        $ds_tipo = 'PR';
        $querry =  "SELECT pre.CRACHA,
                           pre.NM_PRESTADOR AS NOME,
                           SUBSTR(pre.CPF, 1, 3) || '.' || SUBSTR(pre.CPF, 3, 3) || '.' || SUBSTR(pre.CPF, 7, 3) || '-' || SUBSTR(pre.CPF, 10, 2) AS CPF,
                           DECODE (pre.TIPO,
                                   'PR', 'PROVEDORIA',
                                   'IN', 'INSTRUMENTADOR',
                                   'NÃO ENCONTRADO') AS TIPO,
                           pre.TP_STATUS
                    FROM port_catraca.PRESTADORES pre
                    WHERE pre.CRACHA = '$cd_pesquisa'";
        $nm_campo = 'CPF';
        $nm_campo2 = 'Tipo';
        $nm_campo3 = 'CPF';
    }

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);
?>

<div class="div_br"></div>  

<table class="table table-striped" style="text-align: center;">
    <thead>
        <th style="text-align: center;">Crachá</th>
        <th style="text-align: center;">Nome</th>
        <?php echo '<th style="text-align: center;">' . $nm_campo . '</th>'?>
        <?php echo '<th style="text-align: center;">' . $nm_campo2 . '</th>'?>
        <th style="text-align: center;">Status</th>
        <th style="text-align: center;">Adicionar Catraca</th>
    </thead>
    <tbody>
        <?php
        while($row_crachas = oci_fetch_array($result)){
            echo '<tr style="text-align: center;">';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_crachas['CRACHA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_crachas['NOME'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_crachas[$nm_campo3] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">'  .  $row_crachas['TIPO'] . '</td>';
                if($row_crachas['TP_STATUS'] == 'A'){
                    echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Ativo  "><img src="http://10.200.0.50:8080/imagens/dot_verde.png"></span></td>';
                }else{
                    echo '<td class="align-middle" style="text-align: center;"><span data-tooltip="  Inativo  "><img src="http://10.200.0.50:8080/imagens/dot_amarelo.png"></span></td>';
                }
                ?><td class="align-middle" style="text-align: center;"><button onclick="editar_acesso_cracha('<?php echo $row_crachas['CRACHA']; ?> ',' <?php echo $row_crachas['NOME']; ?>', '<?php echo $ds_tipo; ?>');" class="btn btn-adm" style="background-color: #3185c1 !important; border-color: #3185c1 !important; color: white !important; "><i class="fa-solid fa-link"></i></button></td><?php
            echo '</tr>';
        }
        ?>
    </tbody>
</table>