<?php
	//$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =10.114.0.23)(PORT = 1521))(CONNECT_DATA = (SID = trnmv)))";
	$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =10.200.0.211)(PORT = 1521))(CONNECT_DATA = (SERVICE_NAME = prdmv)))";

	//if(!($conn_ora = oci_connect('dbamv','treinamento123',$dbstr1,'AL32UTF8'))){
	if(!@($conn_ora = oci_connect('port_catraca','sinuquinha_championship_2023',$dbstr1,'AL32UTF8'))){
		echo "Conexão falhou!";
	}
?>