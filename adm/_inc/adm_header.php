<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();
if(isset($_SESSION['auth_flag']) == false){
	go_href("관리자 로그인하시기 바랍니다.", "/adm/", "go");
	exit;
}
$w_http_host = $_SERVER['HTTP_HOST'];
$w_request_uri = $_SERVER['REQUEST_URI'];
$w_file_name = basename($_SERVER['PHP_SELF']);
$w_sub_name = explode('/',$w_request_uri);
$w_index = true;


if(isset($w_sub_name[3])){
	$w_index = false;
	$w_b_num = explode('.',$w_file_name);
	$w_b_num = explode('s',$w_b_num[0]);
	$w_b_num = $w_b_num[1];
	switch($w_sub_name[3]){
		case "s1" : 
			$w_a_num = 1; 
			$w_s_title_1="사용자회원관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="사용자회원관리"; break;
			}
		break;

		case "s2" : 			
			$w_a_num = 2; 
			$w_s_title_1="관리자회원관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="관리자회원관리"; break;
			}
		break;

		case "s3" : 
			$w_a_num = 3; 
			$w_s_title_1="테스트베드예약관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="테스트베드예약관리"; break;
			}
		break;

		case "s4" : 
			$w_a_num = 4; 
			$w_s_title_1="기기관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="기기관리"; break;
			}
		break;

		case "s5" : 
			$w_a_num = 5; 
			$w_s_title_1="공지사항";
			switch($w_b_num){
				case "1" : $w_s_title_2="공지사항"; break;
			}
		break;
	}
	if($w_a_num){
		$w_a_num = $w_a_num-1;
	}
	$w_b_num = $w_b_num-1;
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
	<link rel="stylesheet" type="text/css" href="/adm/css/jquery-ui.min.css" />
	<script type="text/javascript" src="/adm/js/jquery-1.12.4.min.js"></script>
</head>
<body>
<!-- STR warp -->
<div id="wrap">
	<!-- STR header -->
	<header>
		<h1><a href="/adm/page/s1/s1.php">테스트베드</a></h1>
		<ul class="gnb">
			<li <?php if($w_a_num===0){ echo 'class="active"';}?>><a href="/adm/page/s1/s1.php">사용자회원관리</a></li>
			<li <?php if($w_a_num===1){ echo 'class="active"';}?>><a href="/adm/page/s2/s1.php">관리자회원관리</a></li>
			<li <?php if($w_a_num===2){ echo 'class="active"';}?>><a href="/adm/page/s3/s1.php">테스트베드예약관리</a></li>
			<li <?php if($w_a_num===3){ echo 'class="active"';}?>><a href="/adm/page/s4/s1.php">기기관리</a></li>
			<li <?php if($w_a_num===4){ echo 'class="active"';}?>><a href="/adm/page/s5/s1.php">공지사항</a></li>
		</ul>
	</header>
	<!-- END header -->
	<!-- STR lng_wrap -->
	<nav id="lng_wrap">
		<div class="member_wrap">
			<div class="m_info">
				<div class="name">최고관리자님</div>
				<a href="/lib/logout.php">로그아웃</a>
			</div>
			<dl class="data">
				<dt>로그인 IP</dt><dd><?=$_SERVER['REMOTE_ADDR']?></dd>
				<dt>등급</dt><dd>최고관리자</dd>
			</dl>
		</div>
		<h2 class="title s11"><?=$w_s_title_1?></h2>
	</nav>
	<!-- END lng_wrap -->