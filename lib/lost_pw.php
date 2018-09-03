<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
$email = $_GET['getEmail'];

//email chk
$sql = "select * from tbl_member where m_id=?";
$query = $db->prepare($sql);
$data = $query->execute([$email]);

$data = $query->fetch();
if(empty($data)){
	go_href("가입된 회원 아이디가 아닙니다.\\n이메일 주소를 확인해주세요.", "/page/member/login.php", "go");
	exit;
}else{
	$tmp_pwd = randomString();
	//$chg_pwd = password_hash($tmp_pwd, PASSWORD_BCRYPT);//랜덤문자 암호화
	$sql = "update tbl_member set m_sec_code='".$tmp_pwd."' where mseq='".$data['mseq']."'";	
	$db->query($sql);

	$header = "MIME-Version: 1.0\r\n";
	//$header.= "Content-Type: multipart/mixed; charset=utf-8;format=flowed\r\n";
	$header.= "Content-Type: text/html; charset=utf-8;format=flowed\r\n";
	$header.= "From: TestBed <no-replay@itwinner.co.kr> \r\n";
	$header.="Content-Transfer-Encoding: 8bit\n"; // 헤더 설정

	$title = "[온라인테스트베드]보안코드 발송하였습니다.";
	$content = "보안코드는 <br> {$tmp_pwd} <br> 입니다.<br>보안코드 입력페이지에서 입력하시기 바랍니다.";
	$content .= "보안코드 입력 URL : ".$_SERVER['HTTP_HOST']."/page/member/pw_code.php?getEmail=".$email;

	
	mail($email, $title, $content, $header);
	go_href("메일이 발송되었습니다.\\n메일의 URL로 접속하세요.", "/page/member/login.php", "go");
	/*if(mail($email, $title, $content, $header)){
		go_href("메일이 발송되었습니다.\\n메일의 URL로 접속하세요.", "/page/member/login.php", "go");
		exit;
	}*/
}
?>