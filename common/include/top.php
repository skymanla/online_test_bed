<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();
/*unset($_COOKIE['popupcookie']);
setcookie("popupcookie", "", time() -1 );*/
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>테스트베드</title>
	<link rel="stylesheet" type="text/css" href="<?=__HOST__?>/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?=__HOST__?>/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="<?=__HOST__?>/css/main.css" />
	<script type="text/javascript" src="<?=__HOST__?>/js/jquery-1.12.4.min.js"></script>
	<!--[if lt IE 9]>
	<script src="/js/html5.js"></script>
	<![endif]-->
</head>
<body>
<div id="wrap">
	<!-- STR #header -->
	<header id="header">
		<div class="util">
			<div class="util_w">
				<h1><a href="/">성남산업진흥원</a></h1>
				<h2>온라인 테스트베드</h2>
				<div class="log_wrap">
					<? if($_SESSION['email']){ ?>
					<a href="<?=__HOST__?>/lib/logout.php">로그아웃</a>
					<a href="<?=__HOST__?>/page/s6/s1.php">MyPage</a>
					<? }else{ ?>
					<a href="<?=__HOST__?>/page/member/login.php">로그인</a>
					<a href="<?=__HOST__?>/page/member/register_from.php">회원가입</a>
					<? } ?>
				</div>
			</div>
		</div>
		<ul class="gnb">
			<li><a href="<?=__HOST__?>/page/s1/s1.php">공지사항</a></li>
			<li><a href="<?=__HOST__?>/page/s2/s1.php">테스트베드 소개</a></li>
			<li><a href="<?=__HOST__?>/page/s3/s1.php">테스트베드 예약</a></li>
			<li><a href="<?=__HOST__?>/page/s4/s1.php">테스트베드 예약 현황</a></li>
			<li><a href="http://211.233.22.14:8888/auth/login/" target="_blank">테스트베드 접속</a></li>
			<li><a href="<?=__HOST__?>/page/s6/s1.php">마이페이지</a></li>
		</ul>
	</header>
	<!-- END #header -->

	<!-- STR #contents-->
	<div id="contents">
