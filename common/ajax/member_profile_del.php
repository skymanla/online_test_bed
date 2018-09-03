<?php
/* Ryan skymanla
member profile delete
*/
header("Content-Type:application/json");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
$sql = "select mseq from tbl_member where m_id='".$_REQUEST['member_data']."'";
$query = $db->query($sql);
if($query->rowCount()==false){
	$r = array("msg"=>"존재하지 회원입니다.\n관리자에게 문의해주세요.", "code"=>"99");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}else{
	$member = $query->fetch();
	$mseq = $member['mseq'];
}
$mfseq = $_REQUEST['file_data'];

//있는지 여부?
$sql = "select * from tbl_member_file where mfseq='".$mfseq."' and mf_meq='".$mseq."'";
$query = $db->query($sql);
if($query->rowCount() == false){
	$r = array("msg"=>"존재하지 않는 파일입니다.\n관리자에게 문의해주세요.", "code"=>"99");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}else{
	$data = $query->fetch();
}

//파일 삭제해봅시당
//$sql = "delete from tbl_member_file where mfseq='".$mfseq."' and mf_meq='".$mseq."'";
$sql = " update tbl_member_file set mf_file_name=NULL, mf_refile_name=NULL, mf_file_ext=NULL, mf_url=NULL, mf_size=NULL where mfseq='".$mfseq."' and mf_meq='".$mseq."'";

if($db->query($sql)){
	@unlink($_SERVER['DOCUMENT_ROOT'].$data['mf_url']."/".$mf_refile_name);
	$r = array("msg"=>"파일이 삭제되었습니다.\n첨부파일을 다시 등록해주시기 바랍니다.", "code"=>"88", "file_name"=>'');
	$r = (object) $r;
	echo json_encode($r);
	exit;
}

?>