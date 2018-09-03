<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
//유효성 검사
$email = $_POST['email'];
$pw = (string) $_POST['pw'];
$pw2 = (string) $_POST['pw2'];

$name = $_POST['name'];
$num = $_POST['num'];
$nickname = $_POST['nickname'];


$sql = "select count(*) as cnt from tbl_member where m_id=?";
$query = $db->prepare($sql);
$email_chk = $query->execute([$email]);

$email_chk = $query->fetch();
if($email_chk['cnt'] == '1'){
	go_href("이미 가입된 메일입니다.\\n로그인화면으로 이동합니다.", "/page/member/login.php", "go");
	exit;
}


$common_sql = " m_id = :id, m_pwd = :pwd, m_name = :name, m_phone = :num, m_nick = :nickname, m_regdate=now()";
$sql = "insert into tbl_member set ".$common_sql;
$query = $db->prepare($sql);

try{
	//$db->beginTransaction();
	$query->execute(array("id"=>$email,
					"name"=>$name,
					"num"=>$num,
					"nickname"=>$nickname,
					"pwd"=>password_hash($pw, PASSWORD_BCRYPT)));
	//$db->commit();
}catch(PDOException $e){
	echo "Error = ".$e->getMessage();
}
//예외 없으니 돌리자꾸나
$MSEQ = $db->lastInsertId();

$file = $_FILES['box_navi'];
$refuse_ext = array("exe", "php", "cpp", "java", "jar", "iso", "html", "css", "js", "php3", "php5", "php7");

if(empty($file)){
	header("HTTP/1.1 404 Not Found");
	$sql = "delete from tbl_member where MSEQ='".$MSEQ."'";
	$db->query($sql);
	die("잘못된 접근입니다.");
}

$dt_date = date('Ymd', time());
$file_name = $file['name'];
$refile_name = $MSEQ."_".$dt_date;
$size = $file['size'];
$ext = substr(strrchr($file["name"],"."),1);
$ext = strtolower($ext);
$file_url = "/data/member_profile/".$MSEQ;

if(in_array($ext, $refuse_ext)){
	header("HTTP/1.1 404 Not Found");
	$sql = "delete from tbl_member where MSEQ='".$MSEQ."'";
	$db->query($sql);
	die("잘못된 접근입니다.");
}

//make folder
if(is_dir(dir."/data") == false) mkdir(dir."/data", 0755);
if(is_dir(dir."/data/member_profile") == false) mkdir(dir."/data/member_profile", 0755);
if(is_dir(dir."/data/member_profile/".$MSEQ) == false) mkdir(dir."/data/member_profile/".$MSEQ, 0755);

move_uploaded_file($file['tmp_name'], dir."/data/member_profile/".$MSEQ."/".$refile_name);
$file_sql = "insert into tbl_member_file set mf_meq='$MSEQ', mf_file_name='$file_name', mf_refile_name='$refile_name', mf_file_ext='$ext', mf_url='$file_url', mf_size='$size'";
$query = $db->prepare($file_sql);
try{
	$query->execute([]);
}catch(PDOException $e){
	echo 'Error = '.$e->getMessage();
}

//send mail from admin

$header = "MIME-Version: 1.0\r\n";
//$header.= "Content-Type: multipart/mixed; charset=utf-8;format=flowed\r\n";
$header.= "Content-Type: text/html; charset=utf-8;format=flowed\r\n";
$header.= "From: TestBed <no-replay@unpl.co.kr> \r\n";
//$header.= "From: TestBed <no-replay@itwinner.co.kr> \r\n";
$header.="Content-Transfer-Encoding: 8bit\n"; // 헤더 설정

$title = "[온라인테스트베드]".$name."(".$nickname.")님께서 회원가입 요청을 하셨습니다.";
$content = '<div style="position:relative;width:800px;margin:0px auto;background-image:url('.__HOST__.'/img/test/1_2.jpg);background-repeat: no-repeat;height:270px;">	
	<div style="position:relative;top:184.5px;left:38px;">
		<p style="font-weight:bold;letter-spacing:1px">
			'.$name.'('.$nickname.')님
		</p>
		회원가입 요청을 하셨습니다.
	</div>
</div>';

mail("skymanla@winddesign.co.kr", $title, $content, $header);

go_href("회원가입이 완료되었습니다.\\n로그인하시기 바랍니다.", "/page/member/login.php", "go");

?>