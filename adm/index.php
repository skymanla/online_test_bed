<?
session_start();
if($_SESSION['auth_flag'] == "admin"){
	echo "<script>location.replace('/adm/page/s1/s1.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>테스트베드 관리자</title>
	<link rel="stylesheet" type="text/css" href="/adm/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/adm/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="/adm/css/login.css" />
	<link rel="stylesheet" type="text/css" href="/adm/css/jquery-ui.min.css" />
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
</head>
<body>
<!-- STR warp -->
<div id="wrap">
	<div id="login_wrap">
		<h2>온라인 테스트베드</h2>
		<form id="loginForm" name="loginForm" action="./login.php" onsubmit="return logincheck(this);return false;" method="post">
			<fieldset>
				<legend>로그인</legend>
				<div class="input_box"><label for="">ID</label><input type="text" name="id" id="id" placeholder="아이디" autocomplete="off" /></div>
				<div class="input_box"><label for="">PW</label><input type="password" name="pw" id="pw" placeholder="패스워드" autocomplete="off" /></div>
				<button href="#" onclick="logincheck(document.loginForm);return false;" >LOGIN</button>
			</fieldset>
		</form>
	</div>
</div>
<!-- END warp -->
<script>
function logincheck(Frm){
	if(Frm.id.value.trim() == ''){
		alert("아이디를 입력해주세요.");
		Frm.id.focus();
		return false;
	}

	if(Frm.pw.value.trim() == ''){
		alert("패스워드를 입력해주세요.");
		Frm.pw.focus();
		return false;
	}

	Frm.submit();
}
</script>
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</body>
</html>