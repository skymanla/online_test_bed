<?
/*
Ryan skymanla
Device update
 */
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();
if(empty($_SESSION)) go_href("관리자만 접근 가능합니다.", "/adm/", "go");exit;
$writer = $_SESSION['id'];
$ip = $_SERVER['REMOTE_ADDR'];
//post 변수 정리
$mode = $_POST['mode'];
$dv_seq = $_POST['dv_seq'];
$dv_system = $_POST['system'];
$dv_name = $_POST['device_name'];
$dv_main_use = $_POST['main_use'];
$dv_type = $_POST['device_type'];
$dv_size = $_POST['device_size'];
$dv_weight = $_POST['device_weight'];
$dv_ram = $_POST['device_ram'];
$dv_inmemory = $_POST['device_inmemory'];
$dv_os = $_POST['device_os'];
$dv_cpu = $_POST['device_cpu'];
$dv_screen = $_POST['device_screen'];
$dv_pixcel = $_POST['device_pixcel'];
$dv_display = $_POST['device_display'];
$dv_bettery = $_POST['device_bettery'];
$dv_frontcamera = $_POST['device_frontcamera'];
$dv_backcamera = $_POST['device_backcamera'];
$dv_etc = $_POST['device_etc'];
$dv_network = $_POST['device_network'];


$sql_common = " dv_name = :dv_name,
				dv_system = :dv_system,
				dv_main = :dv_main,
				dv_type = :dv_type,
				dv_weight = :dv_weight,
				dv_size = :dv_size,
				dv_ram = :dv_ram,
				dv_inmemory = :dv_inmemory,
				dv_os = :dv_os,
				dv_cpu = :dv_cpu,
				dv_screen = :dv_screen,
				dv_pixcel = :dv_pixcel,
				dv_display = :dv_display,
				dv_bettery = :dv_bettery,
				dv_frontcamera = :dv_frontcamera,
				dv_backcamera = :dv_backcamera,
				dv_etc = :dv_etc,
				dv_network = :dv_network
				";
if($mode == "W"){
	$sql_common .= ", dv_regdate = now(),
					dv_writer = '$id',
					dv_ip = '$ip'";
	$sql = "insert into tbl_device set ".$sql_common;
}else if($mode == "U"){
	$sql_common .= ", ";
	$sql = "update tbl_device set ".$sql_common." where dvseq='".$dv_seq."'";
}

$query = $db->prepare($sql);

try{
	$query->execute(array("dv_name"=>$dv_name,
							"dv_system"=>$dv_system,
							"dv_main"=>$dv_main_use,
							"dv_type"=>$dv_type,
							"dv_weight"=>$dv_weight,
							"dv_ram"=>$dv_ram,
							"dv_size"=>$dv_size,
							"dv_inmemory"=>$dv_inmemory,
							"dv_os"=>$dv_os,
							"dv_cpu"=>$dv_cpu,
							"dv_screen"=>$dv_screen,
							"dv_pixcel"=>$dv_pixcel,
							"dv_display"=>$dv_display,
							"dv_bettery"=>$dv_bettery,
							"dv_frontcamera"=>$dv_frontcamera,
							"dv_backcamera"=>$dv_backcamera,
							"dv_etc"=>$dv_etc,
							"dv_network"=>$dv_network
							));
}catch(Exception $e){
	echo $e->getMessage();
}
if(empty($dv_seq)){
	$dv_seq = $db->lastInsertId();
	if($dv_seq == false){
		go_href("기기 이름이 같은 내용이 존재합니다.\\n리스트에서 확인해주시기 바랍니다.", "/adm/page/s4/s1.php", "go");
		exit;
	}
}


if(isset($_FILES)){
	$file = $_FILES['device_img'];
	$dir = "/data/device";
	$seq_dir = $dir."/".$dv_seq;

	if(is_dir($dir) == false) mkdir($dir, 0755);
	if(is_dir($seq_dir) == false) mkdir($seq_dir, 0755);

	move_uploaded_file($file['tmp_name'], $seq_dir."/".$file['name']);
	$file_common = " dv_img_file = '".$seq_dir."/".$file['name']."'";
	$query = "update tbl_device set ".$file_common." where dvseq='".$dv_seq."'";
	echo $query;
	$db->query($query);
}

go_href("정보가 저장되었습니다.", "/adm/page/s4/s1view.php?idx=".$dv_seq, "go");
exit;
?>