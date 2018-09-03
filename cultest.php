<?php
/* Ryan skymanla */
$url = "localhost:8080/admin/api/schedule";
$header_data = [];
$header_data[] = "Content-Type: application/json";
$header_data[] = "Accept-Encoding: gzip";
$header_data[] = "Authorization: Basic YXBpLXVzZXI6YXBpLXBhc3N3b3Jk";

$postdata = array("startTime"=>"2018-08-27 20:00",
							"endTime"=>"2018-08-27 22:00",
							"deviceList"=>array("0715f774c5a0103a"));
$postdata = json_encode($postdata);
print_r($postdata);
$ch = curl_init(); //파라미터:url -선택사항

curl_setopt($ch, CURLOPT_URL,$url); //여기선 url을 변수로
curl_setopt($ch, CURLOPT_USERPWD, "ubuntu:dkdlxldnlsj1!");
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ($ch, CURLOPT_HEADER, trur); // 헤더 출력 여부
curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOSIGNAL, true);
curl_setopt($ch,CURLOPT_POST, 1); //Method를 POST로 지정.. 이 라인이 아예 없으면 GET
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	    
$data = curl_exec($ch);
$curl_errno = curl_errno($ch);
$curl_error = curl_error($ch);
    
curl_close($ch);

var_dump($data);
?>