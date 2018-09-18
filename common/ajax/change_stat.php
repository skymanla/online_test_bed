<?php
/*
Ryan skymanla
change member auth
ajax/json
 */
header("Content-Type:application/json");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");

$MSEQ = $_REQUEST['idx'];
$mode = $_REQUEST['mode'];
$sql = "select * from tbl_member where mseq='".$MSEQ."'";
$query = $db->query($sql);
//$query = $db->prepare($sql);
//$query->execute();
//$count = $query->rowCount();
$member = $query->fetch();
//if($count == '0'){
if(empty($member)){
	$r = array("msg"=>"등록되지 않은 회원입니다.");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}else{
	
	if($mode == "D"){
		$sql = "update tbl_member set m_del_flag='1', m_deldate=now() where mseq='".$MSEQ."'";
	}else if($mode == "N"){
		$sql = "update tbl_member set m_auth='".$mode."', m_authdate=now() where mseq='".$MSEQ."'";

		$header = "MIME-Version: 1.0\r\n";
		//$header.= "Content-Type: multipart/mixed; charset=utf-8;format=flowed\r\n";
		$header.= "Content-Type: text/html; charset=utf-8;format=flowed\r\n";
		$header.= "From: TestBed <worldcuplove@snip.or.kr> \r\n";
		//$header.= "From: TestBed <no-replay@itwinner.co.kr> \r\n";
		$header.="Content-Transfer-Encoding: 8bit\n"; // 헤더 설정

		$title = "[온라인테스트베드] 회원 승인이 거절되었습니다.";
		$content = '<div style="position:relative;width:800px;margin:0px auto;background-image:url('.__HOST__.'/img/test/email_title.jpg);background-repeat: no-repeat;">	
			<div style="position:relative;height:139px;"></div>
			<div style="position:relative;border:1px solid #cccccc;width:598px;">
				<div style="padding:23px">
					<p style="font-weight:bold;letter-spacing:1px">
						'.$member['m_name'].'('.$member['m_nick'].')님
					</p>
					프로젝트 및 사업자 등록증이 미비하여 
					회원 승인이 거절되었습니다.<br>
					자세한 문의는 관리자에게 해주시기 바랍니다.
					관리자 메일 : worldcuplove@snip.or.kr
				</div>
			</div>
			<div style="position:relative;width:513px;margin:0px auto;padding:20px">
				<a href="'.__HOST__.'" target="_blank"><img src="'.__HOST__.'/img/test/hompage_button.png" alt="테스트베드 홈페이지 가기" /></a>
			</div>
		</div>';

		mail($member['m_id'], $title, $content, $header);
	}else if($mode == 'Y'){
		$sql = "update tbl_member set m_auth='".$mode."', m_authdate=now() where mseq='".$MSEQ."'";
		$header = "MIME-Version: 1.0\r\n";
		//$header.= "Content-Type: multipart/mixed; charset=utf-8;format=flowed\r\n";
		$header.= "Content-Type: text/html; charset=utf-8;format=flowed\r\n";
		$header.= "From: TestBed <worldcuplove@snip.or.kr> \r\n";
		//$header.= "From: TestBed <no-replay@itwinner.co.kr> \r\n";
		$header.="Content-Transfer-Encoding: 8bit\n"; // 헤더 설정

		$title = "[온라인테스트베드] 회원 승인이 되었습니다.";
		$content = '<div style="position:relative;width:800px;margin:0px auto;background-image:url('.__HOST__.'/img/test/email_title.jpg);background-repeat: no-repeat;">	
			<div style="position:relative;height:139px;"></div>
			<div style="position:relative;border:1px solid #cccccc;width:598px;">
				<div style="padding:23px">
					<p style="font-weight:bold;letter-spacing:1px">
						'.$member['m_name'].'('.$member['m_nick'].')님
					</p>
					회원 가입이 되었습니다.
					홈페이지 이용이 가능합니다.	
					<br>현재 사이트는 크롬에 최적화 되어있습니다.
				</div>
			</div>
			<div style="position:relative;width:513px;margin:0px auto;padding:20px">
				<a href="'.__HOST__.'" target="_blank"><img src="'.__HOST__.'/img/test/hompage_button.png" alt="테스트베드 홈페이지 가기" /></a>
			</div>
		</div>';

		mail($member['m_id'], $title, $content, $header);
	}
	$db->query($sql);
	$r = array("msg"=>"회원 상태가 변경되었습니다.", "query"=>$member['m_id']);
	$r = (object) $r;
	echo json_encode($r);
	exit;
}
?>