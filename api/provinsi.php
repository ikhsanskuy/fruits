<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 82741f2eee55b02336b1105863d95b6a"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
  $array_reponse = json_decode($response,TRUE);
  $data_provinsi = $array_reponse["rajaongkir"]["results"];

  echo "<option value=''>--Pilih Provinsi--<</option>";

  foreach($data_provinsi as $key => $tiap_provinsi){
    echo "<option value='".$tiap_provinsi["province_id"]."' id_provinsi='".$tiap_provinsi["province_id"]."'>";
    echo $tiap_provinsi["province"];
    echo "</option>";
  }

}