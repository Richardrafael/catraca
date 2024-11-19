<?php
if (!isset($_SESSION['usuarioNome'])) {
	unset(
		$_SESSION['usuarioLogin'],
		$_SESSION['usuarioNome'],
		$_SESSION['SN_USUARIO'],
		$_SESSION['SN_IEP'],
		$_SESSION['SN_ADM'],
		// $_SESSION['SN_TERCEIROS']
	);

	$_SESSION['msgerro'] = "Sessão expirada!";
	header("Location: index.php");
};
