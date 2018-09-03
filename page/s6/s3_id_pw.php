<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
session_start();

$getIdx = $_GET['idx'];

//열람하는 내용이 본인 것과 같은지 확인
$sql = "select mseq from tbl_member where m_id='".$_SESSION['email']."'";
$q = $db->query($sql);
$r = $q->fetch();

$sql = "select booking_device_id, booking_device_pwd from tbl_device_booking where bseq='".$getIdx."' and booking_mseq='".$r['mseq']."'";
$query = $db->query($sql);
if($query->rowCount() == false){
	header("HTTP/1.1 400 Bad Request");
	echo '<script>alert("신청한 예약이 아닙니다.\n다시 확인해보시기 바랍니다.");self.close();</script>';
	exit;
}else{
	$data = $query->fetch();
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>테스트베드</title>
	<link rel="stylesheet" type="text/css" href="../../css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../../css/sub.css" />
	<script type="text/javascript" src="../../js/jquery-1.12.4.min.js"></script>
	<!--[if lt IE 9]>
	<script src="../js/html5.js"></script>
	<![endif]-->
</head>
<body>
<div id="wrap">
	<div class="s6s3_sec_idpw">
		<h3>임시 아이디 및 비밀번호 확인</h3>
			<table class="">
				<caption>임시 아이디 및 비밀번호 확인</caption>
				<colgroup>
					<col width="150px" />
					<col width="" />
				</colgroup>
				<tbody>
					<tr>
						<td>아이디</td>
						<td><?=$data['booking_device_id']?></td>
					</tr>
					<tr>
						<td>비밀번호</td>
						<td><?=$data['booking_device_pwd']?></td>
					</tr>
				</tbody>
			</table>
		<a href="javascript:window.close();">닫기</a>
	</div>
</div>
</body>
</html>