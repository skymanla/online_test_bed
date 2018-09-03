<?php
/* Ryan skymanla */
//$url = "localhost:8080/admin/api/device";//호출대상 URL
////211.233.22.14:8888/admin/api/device
$url = "localhost:8080/admin/api/device";
$header_data = [];
$header_data[] = "Authorization: Basic YXBpLXVzZXI6YXBpLXBhc3N3b3Jk";
$ch = curl_init(); //파라미터:url -선택사항
    
curl_setopt($ch, CURLOPT_URL,$url); //여기선 url을 변수로
curl_setopt($ch, CURLOPT_USERPWD, "ubuntu:dkdlxldnlsj1!");
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ($ch, CURLOPT_HEADER, trur); // 헤더 출력 여부
curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOSIGNAL, true);
//curl_setopt($ch,CURLOPT_POST, 1); //Method를 POST로 지정.. 이 라인이 아예 없으면 GET
    
$data = curl_exec($ch);
$curl_errno = curl_errno($ch);
$curl_error = curl_error($ch);
    
curl_close($ch);

echo '<pre>';
var_dump($data);
echo '</pre>';
$decoder = json_decode($data, true);

$count_decoder = count($decoder);

/*$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
curl_exec($ch);

if (!curl_errno($ch)) {
  $info = curl_getinfo($ch);
  var_dump($info);
}

curl_close($ch);*/
?>