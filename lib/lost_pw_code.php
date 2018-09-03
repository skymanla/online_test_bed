<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");

//email 및 sec_code check
$email = $_POST['email'];
$code = $_POST['code'];

$sql = "select m_id, m_sec_code from tbl_member where m_id=:id and m_sec_code=:code";
$query = $db->prepare($sql);
$data = $query->execute(array("id"=>$email, "code"=>$code));

$data = $query->fetch();
if(empty($data)){
	header("HTTP/1.1 400 Bad Request");
	go_href("잘못된 접근입니다.", "/", "go");
	exit;
}else{
	//보안코드 초기화
	/*$sql = "update tbl_member set m_sec_code=NULL where m_id=:id and m_sec_code=:code";
	$query = $db->prepare($sql);
	try{
		$query->execute(array("id"=>$email, "code"=>$code));
	}catch(PDOException $e){

	}*/

	go_href("보안코드가 확인되었습니다.\\n비밀번호 변경페이지로 이동합니다.", "/page/member/pw_re.php?getEmail=".$email, "go");
	exit;
}
?>