<?php
session_start();
include '../../../conexao.php';

header('Content-Type: application/json');

$response = [];

// Obtendo os dados da sessão e da requisição
$usuario = $_SESSION['usuarioLogin'] ?? null; // Usar null se não estiver setado
$cd_turma = $_POST['cd_turma'] ?? '';
$nm_aluno = $_POST['nm_aluno'] ?? '';
$rg = $_POST['rg'] ?? '';
$cracha = $_POST['cracha'] ?? '';
$matricula = $_POST['matricula'] ?? '';

// Validação dos campos obrigatórios
if (empty($cd_turma) || empty($nm_aluno) || empty($rg) || empty($cracha) || empty($matricula)) {
    echo json_encode(['status' => 'erro', 'message' => 'Todos os campos são obrigatórios.']);
    exit();
}

// Verifica se já existe outra pessoa com a mesma matrícula
$check_matricula_query = "SELECT COUNT(*) AS TOTAL FROM port_catraca.ALUNOS WHERE MATRICULA = :matricula";
$check_matricula_stmt = oci_parse($conn_ora, $check_matricula_query);
oci_bind_by_name($check_matricula_stmt, ':matricula', $matricula);
oci_execute($check_matricula_stmt);
$matricula_result = oci_fetch_assoc($check_matricula_stmt);

if ($matricula_result['TOTAL'] > 0) {
    // Se houver alguém com a mesma matrícula, retorne um erro.
    echo json_encode(['status' => 'erro', 'message' => 'Matrícula já está em uso por outra pessoa.']);
    exit();
}

// Verifica se o crachá já está em uso
$check_cracha_query = "SELECT COUNT(*) AS TOTAL, SUM(CASE WHEN SN_ATIVO = 'A' THEN 1 ELSE 0 END) AS ATIVOS FROM port_catraca.ALUNOS WHERE CD_CRACHA = :cracha";
$check_cracha_stmt = oci_parse($conn_ora, $check_cracha_query);
oci_bind_by_name($check_cracha_stmt, ':cracha', $cracha);
oci_execute($check_cracha_stmt);
$cracha_result = oci_fetch_assoc($check_cracha_stmt);

if ($cracha_result['TOTAL'] >= 2 && $cracha_result['ATIVOS'] >= 1) {
    // Se mais de 2 pessoas tiverem o crachá, ou se o crachá estiver com mais de uma pessoa ativa
    echo json_encode(['status' => 'erro', 'message' => 'Crachá já está em uso por duas pessoas ativas.']);
    exit();
}

// Prepara a query de inserção
$insert_query = "INSERT INTO port_catraca.ALUNOS
               SELECT
               port_catraca.SEQ_CD_ALUNO.NEXTVAL AS CD_ALUNO,
               :cd_turma AS CD_TURMA,
               UPPER(:nm_aluno) AS NM_ALUNO,
               UPPER(:rg) AS RG,
               :cracha AS CD_CRACHA,
               'A' AS SN_ATIVO,
               :usuario AS CD_USUARIO_CADATRO,
               SYSDATE AS HR_CADASTRO,
               NULL AS CD_USUARIO_ULT_ALT,
               NULL AS HR_ULT_ALT,
               UPPER(:matricula) AS MATRICULA
               FROM DUAL";

// Prepara a execução da query
$insert_stmt = oci_parse($conn_ora, $insert_query);
oci_bind_by_name($insert_stmt, ':cd_turma', $cd_turma);
oci_bind_by_name($insert_stmt, ':nm_aluno', $nm_aluno);
oci_bind_by_name($insert_stmt, ':rg', $rg);
oci_bind_by_name($insert_stmt, ':cracha', $cracha);
oci_bind_by_name($insert_stmt, ':usuario', $usuario);
oci_bind_by_name($insert_stmt, ':matricula', $matricula);

// Executa a inserção
if (oci_execute($insert_stmt)) {
    echo json_encode(['status' => 'sucesso', 'message' => 'Aluno cadastrado com sucesso.']);
} else {
    $erro = oci_error($insert_stmt);
    $msg_erro = htmlentities($erro['message']);
    echo json_encode(['status' => 'erro', 'message' => 'Erro ao cadastrar aluno: ' . $msg_erro]);
}

// Fecha a conexão
oci_close($conn_ora);
