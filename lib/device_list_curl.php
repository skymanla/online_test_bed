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

$decoder = json_decode($data, true);

$count_decoder = count($decoder);
$rowcnt = '0';
$os_type = $_REQUEST['os_type'];
$serial = $_REQUEST['os_device'];
for($i=0; $i < $count_decoder; $i++){
	if($decoder[$i]['platform'] != $os_type){
		continue;
	}
	$ret[] = $decoder[$i];
	$rowcnt++;
}

/*$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
curl_exec($ch);

if (!curl_errno($ch)) {
  $info = curl_getinfo($ch);
  var_dump($info);
}

curl_close($ch);*/
?>

<div>
	<select name="phone" title="" id="phone">
		<option value="" selected="selected">선택</option>
		<? 
		if($rowcnt == "0"){
			//pass
		}else{
			foreach($ret as $key => $row){
		?>
		<option value="<?=$row['serial']?>|<?=$row['version']?>" <?=$row['serial']==$serial ? "selected" : '' ?>><?=$row['nickname']?></option>
		<? 
			}
		}
		?>
	</select>
</div>