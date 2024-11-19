<?php
session_start();
include '../../../conexao.php';

header('Content-Type: application/json');

$response = [];

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
  $cracha = isset($_POST['cracha']) ? $_POST['cracha'] : '';
  $nova_matricula = isset($_POST['nova_matricula']) ? $_POST['nova_matricula'] : '';
  $usuario = $_SESSION['usuarioLogin'] ?? null;

  if (!empty($matricula)) {

    // Verifica se o crachá já está associado a outra matrícula, se o crachá não estiver vazio
    if (!empty($cracha)) {
      $checkCrachaQuery = "SELECT COUNT(*) AS total FROM port_catraca.Alunos WHERE CD_CRACHA = :cracha AND MATRICULA != :matricula AND SN_ATIVO = 'A'";
      $checkCrachaStmt = oci_parse($conn_ora, $checkCrachaQuery);
      oci_bind_by_name($checkCrachaStmt, ':cracha', $cracha);
      oci_bind_by_name($checkCrachaStmt, ':matricula', $matricula);
      oci_execute($checkCrachaStmt);

      $rowCracha = oci_fetch_assoc($checkCrachaStmt);
      if ($rowCracha['TOTAL'] > 0) {
        // Crachá já está registrado em outra matrícula
        $response = [
          'status' => 'error',
          'message' => 'Crachá já cadastrado para outra matrícula'
        ];
        echo json_encode($response);
        exit;
      }
    }

    // Verifica se a nova matrícula já está em uso, se a nova matrícula não estiver vazia
    if (!empty($nova_matricula)) {
      $checkMatriculaQuery = "SELECT COUNT(*) AS total FROM port_catraca.Alunos WHERE MATRICULA = :nova_matricula AND MATRICULA != :matricula AND SN_ATIVO = 'A'";
      $checkMatriculaStmt = oci_parse($conn_ora, $checkMatriculaQuery);
      oci_bind_by_name($checkMatriculaStmt, ':nova_matricula', $nova_matricula);
      oci_bind_by_name($checkMatriculaStmt, ':matricula', $matricula);
      oci_execute($checkMatriculaStmt);

      $rowMatricula = oci_fetch_assoc($checkMatriculaStmt);
      if ($rowMatricula['TOTAL'] > 0) {
        // Nova matrícula já está registrada em outro aluno
        $response = [
          'status' => 'error',
          'message' => 'Matrícula já cadastrada para outro aluno'
        ];
        echo json_encode($response);
        exit;
      }
    }

    // Lógica de atualização
    if (!empty($nova_matricula) && empty($cracha)) {
      // **Verifica se a matrícula pode ser editada (não pode ser maior que 1029)**
      if ($matricula > 1036) {
        $response = [
          'status' => 'error',
          'message' => 'Essa matrícula não pode ser editada'
        ];
        echo json_encode($response);
        exit;
      }

      // Atualiza apenas a matrícula
      $updateQuery = "UPDATE port_catraca.Alunos
                      SET MATRICULA = :nova_matricula , CD_USUARIO_ULT_ALT = :cd_usuario_ult_alt , HR_ULT_ALT = Sysdate
                      WHERE MATRICULA = :matricula AND SN_ATIVO = 'A'";
      $updateStmt = oci_parse($conn_ora, $updateQuery);
      oci_bind_by_name($updateStmt, ':nova_matricula', $nova_matricula);
      oci_bind_by_name($updateStmt, ':matricula', $matricula);
      oci_bind_by_name($updateStmt, ':cd_usuario_ult_alt', $usuario);
    } elseif (empty($nova_matricula) && !empty($cracha)) {
      // Atualiza apenas o crachá
      $updateQuery = "UPDATE port_catraca.Alunos
                      SET CD_CRACHA = :cracha , CD_USUARIO_ULT_ALT = :cd_usuario_ult_alt , HR_ULT_ALT = Sysdate 
                      WHERE MATRICULA = :matricula AND SN_ATIVO = 'A'";
      $updateStmt = oci_parse($conn_ora, $updateQuery);
      oci_bind_by_name($updateStmt, ':cracha', $cracha);
      oci_bind_by_name($updateStmt, ':matricula', $matricula);
      oci_bind_by_name($updateStmt, ':cd_usuario_ult_alt', $usuario);
    } elseif (!empty($nova_matricula) && !empty($cracha)) {
      // **Verifica se a matrícula pode ser editada (não pode ser maior que 1029)**
      if ($matricula > 1036) {
        $response = [
          'status' => 'error',
          'message' => 'Essa matrícula não pode ser editada'
        ];
        echo json_encode($response);
        exit;
      }

      // Atualiza ambos, crachá e matrícula
      $updateQuery = "UPDATE port_catraca.Alunos
                      SET MATRICULA = :nova_matricula, CD_CRACHA = :cracha , CD_USUARIO_ULT_ALT = :cd_usuario_ult_alt , HR_ULT_ALT = Sysdate
                      WHERE MATRICULA = :matricula AND SN_ATIVO = 'A'";
      $updateStmt = oci_parse($conn_ora, $updateQuery);
      oci_bind_by_name($updateStmt, ':nova_matricula', $nova_matricula);
      oci_bind_by_name($updateStmt, ':cracha', $cracha);
      oci_bind_by_name($updateStmt, ':matricula', $matricula);
      oci_bind_by_name($updateStmt, ':cd_usuario_ult_alt', $usuario);
    } else {
      // Se nenhum dado foi preenchido
      $response = [
        'status' => 'error',
        'message' => 'Dados incompletos para atualização'
      ];
      echo json_encode($response);
      exit;
    }

    // Executa a atualização
    $result = oci_execute($updateStmt);
    if ($result) {
      $response = [
        'status' => 'success',
        'message' => 'Aluno atualizado com sucesso!'
      ];
    } else {
      $erro = oci_error($updateStmt);
      $response = [
        'status' => 'error',
        'message' => 'Erro ao atualizar: ' . htmlentities($erro['message'])
      ];
    }
  } else {
    $response = [
      'status' => 'error',
      'message' => 'Matrícula não informada'
    ];
  }
} else {
  $response = [
    'status' => 'error',
    'message' => 'Método de requisição inválido'
  ];
}

// Fecha a conexão
oci_close($conn_ora);

// Retorna a resposta em JSON
echo json_encode($response);
