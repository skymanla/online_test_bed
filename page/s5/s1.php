<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>테스트베드</title>
	<link rel="stylesheet" type="text/css" href="../../css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../../css/layout.css" />
	<link rel="stylesheet" type="text/css" href="../../css/sub.css" />
	<script type="text/javascript" src="../../js/jquery-1.12.4.min.js"></script>
	<!--[if lt IE 9]>
	<script src="../js/html5.js"></script>
	<![endif]-->
</head>
<body>
<div id="wrap">
	<!-- STR #header -->
	<header id="header">
		<div class="util">
			<div class="util_w">
				<h1><a href="../../index.php">성남산업진흥원</a></h1>
				<h2>온라인 테스트베드</h2>
				<div class="log_wrap">
					<a href="../member/login.php">로그인</a>
					<a href="../member/register_from.php">회원가입</a>
				</div>
			</div>
		</div>
		<ul class="gnb">
			<li><a href="../../page/s1/s1.php">공지사항</a></li>
			<li><a href="../../page/s2/s1.php">테스트베드 소개</a></li>
			<li><a href="../../page/s3/s1.php">테스트베드 예약</a></li>
			<li><a href="../../page/s4/s1.php">테스트베드 예약 현황</a></li>
			<li><a href="../../page/s5/s1.php">테스트베드 접속</a></li>
			<li><a href="../../page/s6/s1.php">마이페이지</a></li>
		</ul>
	</header>
	<!-- END #header -->

	<!-- STR #contents-->
	<div id="contents">
		<div class="s5_sec">
			<form method="post" action="">
				<fieldset>
					<legend>테스트베드 접속</legend>
					<div class="login_txt">
						<h4>테스트베드 접속</h4>
						<div>
							<label for="tb_id">아이디</label>
							<input type="text" class="" value="" name="id" placeholder="" id="tb_id"/>
						</div>
						<div>
							<label for="tb_pw">비밀번호</label>
							<input type="password" class="" value="" name="pw" placeholder="" id="tb_pw"/>
						</div>
					</div>
					<input type="submit" class="btn_sbt" value="접속" name="join" id="tb_sbt"/>
				</fieldset>
			</form>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
	</div>
	<!-- END #contents-->

	<!-- STR #footer-->
	<footer id="footer">
		<div class="footer_w">
			<div class="foot_list">
				<a href="../srule/terms.php">이용약관</a>
				<a href="../srule/privacy.php">개인정보처리방책</a>
				<a href="../srule/sitemap.php">사이트맵</a>
			</div>
			<p class="copyright">COPYRIGHT ⓒ 2018 TESTBED CO, LTD. ALL RIGHTS RESERVED.</p>
		</div>
	</footer>
	<!-- END #footer-->
</div>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>