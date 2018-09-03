<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
$idx = $_GET['idx'];
$dir = $_GET['dir'];

$sql = "select * from tbl_member_file where mf_meq = ? ";
$query = $db->prepare($sql);
try{
	$query->execute([$idx]);
}catch(PDOException $e){
	echo $e->getMessage();
}

$file_data = $query->fetch();
if(empty($file_data)){
	header("HTTP/1.1 500 Interval Error");
	die("");
}

$file_exist = $_SERVER['DOCUMENT_ROOT']."/".$file_data['mf_url']."/".$file_data['mf_refile_name'];
//$ori_name = iconv('UTF-8', 'CP949', $file_data['mf_file_name']);
$ori_name = $file_data['mf_file_name'];
//echo filesize($file_exist);
header("Pragma: public");
header("Expires: 0");
//header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Length: '.$file_data['mf_size']);//filesize($file_data['mf_size'])
header('Content-Disposition: attachment; filename='.$ori_name);
header('Content-Transfer-Encoding: binary');

/*$fp = fopen($file_exist, "r");
fpassthru($fp);
fclose($fp);*/

readfile($file_exist);
?>