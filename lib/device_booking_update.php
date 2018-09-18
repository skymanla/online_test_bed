<?php
/*
Ryan skymanla
device booking update
 */
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();

$choose_year_arr = explode("|", $_POST['choose_year_arr']);
$choose_month_arr = explode("|", $_POST['choose_month_arr']);
$choose_day_arr = explode("|", $_POST['choose_day_arr']);
$choose_stime_arr = explode("|", $_POST['choose_stime_arr']);
$choose_etime_arr = explode("|", $_POST['choose_etime_arr']);
$choose_seq_arr = explode("|", $_POST['choose_seq_arr']);
$choose_seq_name_arr = explode("|", $_POST['choose_seq_name_arr']);
$choose_seq_type_arr = explode("|", $_POST['choose_seq_type_arr']);
$chosse_seq_version_arr = explode("|", $_POST['choose_seq_version_arr']);

$booking_cnt = $_POST['booking_cnt'];

$sql = "select * from tbl_member where m_id='".$_SESSION['email']."'";
$q = $db->query($sql);
$r = $q->fetch();

$seqnum_arr = array();
for($i=0; $i<$booking_cnt; $i++){
	//같은 시간대에 신청한 값이 있는지
	$sql = "select booking_seqnum as seq_num from tbl_device_booking where booking_mseq='".$r['mseq']."'
			 and booking_date='".$choose_year_arr[$i]."-".$choose_month_arr[$i]."-".$choose_day_arr[$i]."'
			and booking_start_time='".$choose_stime_arr[$i]."'
			and booking_end_time='".$choose_etime_arr[$i]."' limit 1";	
	$q = $db->query($sql);
	$seq = $q->fetch();
	if($seq['seq_num'] > 0){
		$max_seq = $seq['seq_num'];
	}else{
		$sql = "select max(booking_seqnum) as max_seq from tbl_device_booking";
		$q = $db->query($sql);
		$max = $q->fetch();
		if(empty($max)){
			$max_seq = 1;	
		}else{
			$max_seq = $max['max_seq']+1;
		}
	}
	
	$sql_common = " booking_dvseq='".$choose_seq_arr[$i]."',
					booking_dv_name='".$choose_seq_name_arr[$i]."',
					booking_dv_type='".$choose_seq_type_arr[$i]."',
					booking_dv_version='".$chosse_seq_version_arr[$i]."',
					booking_date='".$choose_year_arr[$i]."-".$choose_month_arr[$i]."-".$choose_day_arr[$i]."',
					booking_start_time='".$choose_stime_arr[$i]."',
					booking_end_time='".$choose_etime_arr[$i]."',
					booking_mseq='".$r['mseq']."',
					booking_regdate=now(),
					booking_ip='".$_SERVER['REMOTE_ADDR']."',
					booking_seqnum='".$max_seq."'";

	$sql = "insert into tbl_device_booking set".$sql_common;
	$db->query($sql);

	if(in_array($max_seq, $seqnum_arr)){
		//pass
	}else{
		$seqnum_arr[] = $max_seq;
	}
}
//print_r($seqnum_arr);exit;
//make title

$make_content = '';
for($j=0;$j<count($seqnum_arr);$j++){
	$sql = " select count(booking_seqnum) as cnt from tbl_device_booking where booking_seqnum='".$seqnum_arr[$j]."'";
	$q = $db->query($sql);
	$seq_cnt = $q->fetch();

	$sql = " select * from tbl_device_booking where booking_seqnum='".$seqnum_arr[$j]."'";
	$q = $db->query($sql);
	$first = $q->fetch();
	$make_content .= $first['booking_date']." ".$first['booking_start_time']." ~ ".$first['booking_end_time']."(".$seq_cnt['cnt'].'건)<br>';
	$make_content .= "[".$first['booking_dv_type']."] ".$first['booking_dv_name'];
	if($seq_cnt['cnt'] > "1"){
		foreach($q as $key => $br){
			$make_content .= " [".$br['booking_dv_type']."] ".$br['booking_dv_name'];
		}
	}else{
		$make_content .= '';
	}

	$make_content .= '<br><br>';
}

$header = "MIME-Version: 1.0\r\n";
//$header.= "Content-Type: multipart/mixed; charset=utf-8;format=flowed\r\n";
$header.= "Content-Type: text/html; charset=utf-8;format=flowed\r\n";
$header.= "From: TestBed <no-replay@snip.or.kr> \r\n";
//$header.= "From: TestBed <no-replay@itwinner.co.kr> \r\n";
$header.="Content-Transfer-Encoding: 8bit\n"; // 헤더 설정

$title = "[온라인테스트베드]".$r['m_name']."(".$r['m_nick'].")님께서 ".$booking_cnt."건을 예약신청 하셨습니다.";
$content = '<div style="position:relative;width:800px;margin:0px auto;background-image:url('.__HOST__.'/img/test/email_title.jpg);background-repeat: no-repeat;">	
	<div style="position:relative;height:139px;"></div>
	<div style="position:relative;border:1px solid #cccccc;width:598px;">
		<div style="padding:23px">
			<p style="font-weight:bold;letter-spacing:1px">
				'.$r['m_name'].'('.$r['m_nick'].')님
			</p>
			'.$make_content.'
			을 신청하셨습니다.
		</div>
	</div>
</div>';


mail("worldcuplove@snip.or.kr", $title, $content, $header);

go_href($booking_cnt."건의 예약이 신청되었습니다.\\n관리자의 승인 후 사용하시기 바랍니다.", "/page/s3/s1.php", "go");
?>