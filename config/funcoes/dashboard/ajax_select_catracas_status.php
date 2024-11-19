<?php 
    include '../../../conexao.php';

    $querry =  "SELECT cat.NM_CATRACA, cat.ID_CATRACA, cat.IP_CATRACA
                FROM port_catraca.CATRACA cat
                WHERE cat.SN_ATIVO = 'A'";

    $result = oci_parse($conn_ora, $querry);
    $valida = oci_execute($result);

    $array = [];
    while($row_catracas = oci_fetch_array($result)){
        $ID = $row_catracas['ID_CATRACA'];
        $IP = $row_catracas['IP_CATRACA'];
        $NOME = $row_catracas['NM_CATRACA'];

        $ch = curl_init("http://" . $IP);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        for($x = 0; $x < 5; $x++){
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($httpCode === 200) {
                $output = 'ON';
                break;
            } else {
                $output = 'OFF';
            }
        }

        curl_close($ch);

        /* Socket IO PING
        $socket = socket_create(AF_INET, SOCK_RAW, 1);
        if($socket !== false){
            socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
            
            $data = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingCheck";
            
            socket_sendto($socket, $data, strlen($data), 0, $IP, 0);
            
            $recv_data = '';
            $from_ip = '';
            $from_port = 0;
            socket_recvfrom($socket, $recv_data, 255, 0, $from_ip, $from_port);
            
            if(!empty($recv_data)){
                $output = "ON";
            }else{
                $output = "OFF";
            }
            
            socket_close($socket);
        }else{
            echo "ERRO";
        }*/

        array_push($array, [$ID, $IP, $NOME, $output]);
    }

    echo json_encode($array);
?>