<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
//hash
//password_hash($pw, PASSWORD_BCRYPT)
$new_pw = $_POST['new_pw'];
$email = $_POST['email'];

$sql = "select m_id, m_sec_code from tbl_member where m_id=?";
$query = $db->prepare($sql);

try{
	$query->execute([$email]);
}catch(PDOException $e){

}

$data = $query->fetch();

if(empty($data)){
	header("HTTP/1.1 400 Bad Request");
	exit;
}else{
	if(empty($data['m_sec_code'])){
		go_href("보안코드를 확인할 수가 없습니다.\\n메일을 확인해주세요.", "/page/member/login.php", "go");
		exit;
	}
}

$sql = " update tbl_member set m_sec_code=NULL, m_pwd=:pwd where m_id=:id ";
$query = $db->prepare($sql);
$query = $query->execute(array("pwd"=>password_hash($new_pw, PASSWORD_BCRYPT),
								"id"=>$email
								));
if($query == true){
	go_href("비밀번호가 변경되었습니다.\\n로그인페이지로 이동합니다.", "/page/member/login.php", "go");
	exit;
}
?>