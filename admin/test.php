<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.43.96/programacionwebconstructora/ws/caso.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=5nm37v7m1e8p7vdp9r1m9pl0ao'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response=json_decode($response);
//print_r($response);

foreach ($response as $key=>$caso):
 echo $caso->caso_exito;
endforeach;
