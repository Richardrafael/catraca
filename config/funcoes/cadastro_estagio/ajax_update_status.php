<?php 

session_start();

include '../../../conexao.php';

$usuario = $_SESSION['usuarioLogin'];
$id = $_POST['cd_estagio'];
$status = $_POST['sn_ativo'];

if ($status == 'A') {
    $sql = "UPDATE port_catraca.ESTAGIO est
            SET est.SN_ATIVO = 'I',
                est.CD_USUARIO_ULT_ALT = '$usuario',
                est.HR_ULT_ALT = SYSDATE
            WHERE est.CD_ESTAGIO = '$id'";
}
else {
    $sql = "UPDATE port_catraca.ESTAGIO est
            SET est.SN_ATIVO = 'A',
                est.CD_USUARIO_ULT_ALT = '$usuario',
                est.HR_ULT_ALT = SYSDATE
            WHERE est.CD_ESTAGIO = '$id'";
}

$result = oci_parse($conn_ora, $sql);
$valida = oci_execute($result);

//VALIDACAO
if (!$valida) {   
        
    $erro = oci_error($result);																							
    $msg_erro = htmlentities($erro['message']);
    //header("Location: $pag_login");
    //echo $erro;
    echo $msg_erro;

}else{
    echo 'Sucesso';
}

?>