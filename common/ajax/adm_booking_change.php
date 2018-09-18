<?php
/*
Ryan skymanla
Accept Booking  Member
Random Id , Pwd
 */
header("Content-Type:application/json");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
$id = $_REQUEST['getIdx'];
$mode = $_REQUEST['getMode'];

//mode check
$mode_arr = array("A", "R", "D");
if(!in_array($mode, $mode_arr)){
	$r = array("msg", "잘못된 접근입니다");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}

//idx check
$sql = "select * from tbl_device_booking where bseq='".$id."'";
//$sql = "select * from tbl_device_booking where booking_seqnum='".$id."'";
$query = $db->query($sql);
if($query->rowCount() == false){
	$r = array("msg", "잘못된 접근입니다.");
	$r = (object) $r;
	echo json_endoe($r);
	exit;
}else{
	$data = $query->fetch();

	$msql = "select m_id, m_name, m_nick from tbl_member where mseq='".$data['booking_mseq']."'";
	$mquery = $db->query($msql);
	$member = $mquery->fetch();

	$d_cnt = 1;

	//1
	$device['booking_dvseq'][] = $data['booking_dvseq'];
	$device['device_type'][] = $data['booking_dv_type'];
	$device['device_name'][] = $data['booking_dv_name'];
	$device['device_version'][] = $data['booking_dv_version'];

	//2
	foreach($query as $key => $row){
		$device['booking_dvseq'][] = $row['booking_dvseq'];
		$device['device_type'][] = $row['booking_dv_type'];
		$device['device_name'][] = $row['booking_dv_name'];
		$device['device_version'][] = $row['booking_dv_version'];
		$d_cnt++;
	}
	

	if($mode == "A"){
		$curl_data = array("startTime"=>$data['booking_date']." ".$data['booking_start_time'],
							"endTime"=>$data['booking_date']." ".$data['booking_end_time'],
							"deviceList"=>$device['booking_dvseq']);//"deviceList"=>array($data['booking_dvseq']));

		$temp_id = post_curl($curl_data);		
		/*$temp_id = return_device_id();
		$temp_pwd = return_device_pwd();*/
		$sql_common = " booking_accept = 'Y', 
						booking_accept_date = now(),
						booking_device_id='".$temp_id."',
						booking_device_pwd='".$temp_id."' ";
	}else if($mode == "R"){
		$sql_common = "booking_accept = 'N',
						booking_accept_date = now(),
						booking_device_id = NULL,
						booking_device_pwd = NULL ";
	}else if($mode == "D"){
		$sql_common = "booking_accept = 'D',
						booking_accept_date = now(),
						booking_device_id = NULL,
						booking_device_pwd = NULL";
	}

	$sql = " update tbl_device_booking set ".$sql_common." where bseq='".$id."' ";
	//$sql = " update tbl_device_booking set ".$sql_common." where booking_seqnum='".$id."' ";
	$query = $db->query($sql);

	if($mode == "A"){//승인일 때 메일 발송 
		$make_content = $data['booking_date']." ".$data['booking_start_time']." ~ ".$data['booking_end_time'].'('.$d_cnt.'건)<br>';
		for($i=0;$i<$d_cnt;$i++){
			$make_content .= "[".$device['device_type'][$i]."]".$device['device_name'][$i]." ";
		}

		$make_content .= '<br><br>';

		$etc_cnt = '';
		if($d_cnt > 1){			
			$etc_cnt = "( 외 ".$d_cnt." 건)";
		}

		$header = "MIME-Version: 1.0\r\n";
		//$header.= "Content-Type: multipart/mixed; charset=utf-8;format=flowed\r\n";
		$header.= "Content-Type: text/html; charset=utf-8;format=flowed\r\n";
		$header.= "From: TestBed <worldcuplove@snip.or.kr> \r\n";
		//$header.= "From: TestBed <no-replay@itwinner.co.kr> \r\n";
		$header.="Content-Transfer-Encoding: 8bit\n"; // 헤더 설정

		$title = "[온라인테스트베드]".$device['device_name'][0]."".$etc_cnt." 예약이 승인되었습니다.";
		$content = '<div style="position:relative;width:800px;margin:0px auto;background-image:url('.__HOST__.'/img/test/email_title.jpg);background-repeat: no-repeat;">	
			<div style="position:relative;height:139px;"></div>
			<div style="position:relative;border:1px solid #cccccc;width:598px;">
				<div style="padding:23px">
					<p style="font-weight:bold;letter-spacing:1px">
						'.$member['m_name'].'('.$member['m_nick'].')님
					</p>
					'.$make_content.'
					신청이 승인되었습니다.<br><br>
					<p style="font-weight:bold">
					*사용시 유의사항<br>
					<ol>
						<li>신청하신 시간 안에서 사용이 가능합니다.</li>
						<li>신청하신 시간이 지나거나 디바이스를 종료하시면 설치했던 앱들은 삭제가 됩니다.</li>
						<li>
							<span style="color:red">다음 사람을 위해 설정에서 아래의 사항은 지켜주시기 바랍니다.</span><br>
							<span style="color:blue">
							- 안드로이드 : 개발자 옵션 > USB 디버깅 해제 금지<br>
							- 아이폰 : 제어센터 > 화면기록 해제, 재부팅 금지<br>
							- 디바이스 비밀번호 설정<br>
							- OS 업데이트 금지<br>
							- google 계정 및 apple 계정 설정 금지<br>
							- 제공되는 공유 단말정보를 사용해서 특정 서비스 가입 금지<br>
							- 페이지 로그인은 예약 시간에 가능합니다. 만약 접속이 되지 않는다면 5분정도 뒤에 접속해주시기 바랍니다.<br>
							- 사용 페이지는 크롬에 최적화 되어 있습니다.<br>
							- 기타 불법적인 앱 설치 및 사용 금지(테스트 목적과 무관한 행위 금지)
							</span>
						</li>						
						<li>테스트베드 사용 임시 아이디 및 패스워드는 홈페이지의<br> <span style="color:blue">"마이페이지->예약내역"</span> 에서 확인 가능합니다.</li>
					</ol>
					</p>
				</div>
			</div>
			<div style="position:relative;width:513px;margin:0px auto;padding:20px">
				<a href="'.__HOST__.'" target="_blank"><img src="'.__HOST__.'/img/test/hompage_button.png" alt="테스트베드 홈페이지 가기" /></a>
			</div>
		</div>';

		mail($member['m_id'], $title, $content, $header);
	}else if($mode == "R"){
		$make_content = $data['booking_date']." ".$data['booking_start_time']." ~ ".$data['booking_end_time'].'('.$d_cnt.'건)<br>';
		for($i=0;$i<$d_cnt;$i++){
			$make_content .= "[".$device['device_type'][$i]."]".$device['device_name'][$i]." ";
		}

		$make_content .= '<br><br>';

		$etc_cnt = '';
		if($d_cnt > 1){			
			$etc_cnt = "( 외 ".$d_cnt." 건)";
		}

		$header = "MIME-Version: 1.0\r\n";
		//$header.= "Content-Type: multipart/mixed; charset=utf-8;format=flowed\r\n";
		$header.= "Content-Type: text/html; charset=utf-8;format=flowed\r\n";
		$header.= "From: TestBed <worldcuplove@snip.or.kr> \r\n";
		//$header.= "From: TestBed <no-replay@itwinner.co.kr> \r\n";
		$header.="Content-Transfer-Encoding: 8bit\n"; // 헤더 설정

		$title = "[온라인테스트베드]".$device['device_name'][0]."".$etc_cnt." 예약이 승인되었습니다.";
		$content = '<div style="position:relative;width:800px;margin:0px auto;background-image:url('.__HOST__.'/img/test/email_title.jpg);background-repeat: no-repeat;">	
			<div style="position:relative;height:139px;"></div>
			<div style="position:relative;border:1px solid #cccccc;width:598px;">
				<div style="padding:23px">
					<p style="font-weight:bold;letter-spacing:1px">
						'.$member['m_name'].'('.$member['m_nick'].')님
					</p>
					'.$make_content.'
					신청이 거절되었습니다.
					<br>자세한 사항은 관리자에게 문의주시기 바랍니다.
					<br>관리자 메일 : worldcuplove@snip.or.kr
				</div>
			</div>
			<div style="position:relative;width:513px;margin:0px auto;padding:20px">
				<a href="'.__HOST__.'" target="_blank"><img src="'.__HOST__.'/img/test/hompage_button.png" alt="테스트베드 홈페이지 가기" /></a>
			</div>
		</div>';

		mail($member['m_id'], $title, $content, $header);
	}
	$r = array("msg"=>"회원의 상태가 변경되었습니다.", "co"=>$member['m_id']);
	$r = (object) $r;
	echo json_encode($r);
	exit;
}

//
?>