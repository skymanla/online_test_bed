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
//$sql = "select * from tbl_device_booking where bseq='".$id."'";
$sql = "select * from tbl_device_booking where booking_seqnum='".$id."'";
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

	//$sql = " update tbl_device_booking set ".$sql_common." where bseq='".$id."' ";
	$sql = " update tbl_device_booking set ".$sql_common." where booking_seqnum='".$id."' ";
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
		$header.= "From: TestBed <no-replay@unpl.co.kr> \r\n";
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
					1. 신청하신 시간안에서 사용이 가능합니다.<br>
					2. 신청하신 시간이 지나거나 디바이스를 종료하시면 설치했던 앱들은 삭제가 됩니다.<br>
					3. <span style="color:red">다음 사람을 위해 설정에서 디바이스 펌웨어(OS 업데이트)<br>는 진행하지 말아주시기 바랍니다</span>.<br>
					4. 테스트베드 사용 임시 아이디 및 패스워드는 홈페이지의<br> <span style="color:blue">"마이페이지->예약내역"</span> 에서 확인 가능합니다.
					</p>
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