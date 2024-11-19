<?php
	if(!isset($_SESSION['SN_DASH']) && !isset($_SESSION['SN_ADM'])){
		unset(
			$_SESSION['usuarioLogin'],
			$_SESSION['usuarioNome'],
			$_SESSION['SN_USUARIO'],
			$_SESSION['SN_IEP'],
			$_SESSION['SN_ADM'],
            $_SESSION['SN_REL'],
            $_SESSION['SN_DASH']
		);

		$_SESSION['msgerro'] = "Usuário sem permissão de Dashboard!";
		header("Location: index.php");
	}
?>