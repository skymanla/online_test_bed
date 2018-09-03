<?
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
if(!isset($_GET['email'])){
	go_href("이메일을 입력해 주세요.", "/page/member/lost.php");
	exit;
}
?>
	
		<div class="lost_pw_sec">
			<form name="lostfrm" onsubmit="return lostFrm(this);return false;">
				<input type="hidden" name="getEmail" value="<?=$_GET['email']?>" />
			<div class="lost_pw_wrap">
				<div>
					<h4>비밀번호 재설정</h4>
					<p>비밀번호 재설정을 도와드릴까요</p>
					<div class="lost_pw_txt">
						<p>비밀번호 재설정 이메일로 받기<br /><?=$_GET['email']?></p>
					</div>
				</div>
			</div>
			<div class="btn_lost">
				<a href="register_from.php">회원님이 아니신가요?</a>
				<a href="javascript:lostFrm(document.lostfrm)" class="btn_lost_c">계속</a>
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
			</form>
		</div>	
		<script>
			function lostFrm(Frm){
				Frm.action = "/lib/lost_pw.php";
				Frm.submit();
			}
		</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>