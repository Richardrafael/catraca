<?php
	include 'conexao.php';

	function extractColumnsFromCSV($csvFilePath, $columnsToExtract){
		$extractedData = array();

		if (($handle = fopen($csvFilePath, "r")) !== false) {
			$header = fgetcsv($handle);

			$columnIndices = array();
			foreach ($columnsToExtract as $columnName) {
				$columnIndex = array_search($columnName, $header);
				if ($columnIndex !== false) {
					$columnIndices[$columnName] = $columnIndex;
				}
			}

			while (($data = fgetcsv($handle)) !== false) {
				$rowData = array();
				foreach ($columnIndices as $columnName => $index) {
					$rowData[$columnName] = preg_replace('/[^0-9]/', '', $data[$index]);
				}
				$extractedData[] = $rowData;
			}

			fclose($handle);
		}
		return $extractedData;
	}

	function extractPrestadorFromDBAMV($conn_ora){
		$querry = "SELECT TRIM(pre.CD_PRESTADOR) AS CD_PRESTADOR, TRIM(pre.DS_CODIGO_CONSELHO) AS CRM
				   FROM dbamv.PRESTADOR pre
				   WHERE pre.CD_TIP_PRESTA = 8
				   AND pre.CD_CONSELHO = '1'
				   AND pre.CD_PRESTADOR NOT IN (SELECT tip.CD_PRESTADOR
												FROM dbamv.PRESTADOR_TIP_COMUN tip
												WHERE tip.CD_TIP_COMUN = 15)";

		$result = oci_parse($conn_ora, $querry);
		$valida = oci_execute($result);

		$array = array();
		while($row_prestadores = oci_fetch_array($result))
		{
			$row_data = [
				'CD_PRESTADOR' => $row_prestadores['CD_PRESTADOR'],
				'CRM' => $row_prestadores['CRM']
			];
			array_push($array, $row_data);
		}
		return $array;
	}

	$csvFilePath = "Relacao_Medicos.csv";
	$columnsToExtract = array('MATRICULA', 'CRM');
	$extractedColumnsData = extractColumnsFromCSV($csvFilePath, $columnsToExtract);
	$prestadores = extractPrestadorFromDBAMV($conn_ora);

	foreach ($extractedColumnsData as &$row) {
		$foundMatch = false;
		foreach ($prestadores as $prestador) {
			if ($row['CRM'] === $prestador['CRM']) {
				$row['CD_PRESTADOR'] = $prestador['CD_PRESTADOR'];
				$foundMatch = true;
				break;
			}
		}
		if (!$foundMatch) {
			$row['CD_PRESTADOR'] = 'NULL';
		}
	}
	$control = 0;
	$qtd_erros = 0;
	foreach ($extractedColumnsData as $row) {
		$matricula = $row['MATRICULA'];
		$crm = $row['CRM'];
		$cd_prestador = $row['CD_PRESTADOR'];
		
		if($cd_prestador != 'NULL'){
			echo "INSERT INTO dbamv.PRESTADOR_TIP_COMUN tip (CD_PRESTADOR, CD_TIP_COMUN, DS_TIP_COMUN_PREST, SN_MOSTRA_TIP_COMUN, SN_RECEBE_NOTIFIC_LAB) VALUES ('$cd_prestador', '15', '$matricula', 'S', 'N'); <br/>";
			$control++;
			//$result = oci_parse($conn_ora, $querry);
			//$valida = @oci_execute($result);
			//if(!$valida){ $qtd_erros++; }
		}
	}
	echo '<br/>Total: ' . $control . '<br/>';
	//echo 'QTD Erros: ' . $qtd_erros;
?>