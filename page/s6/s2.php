<?php
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
if(empty($_SESSION['email'])){
	go_href("로그인해주세요.", "/page/member/login.php" , "go");
	exit;
}
?>
		<div class="s6s2_sec s6">
			<div class="s6s2_sec_wrap s6_wrap">
				<!-- STR.s6_tab -->
				<div class="s6_tab">
					<a href="../../page/s6/s1.php">회원정보</a>
					<a href="../../page/s6/s2.php" class="active">비밀번호 변경</a>
					<a href="../../page/s6/s3.php">예약내역</a>
				</div>
				<!-- END.s6_tab -->

				<!-- STR.profile_wrap -->
				<form name="pwdForm" method="post" onsubmit="return pwdFrm(this);return false">
					<div class="pw_wrap">
						<h4>회원정보</h4>
						
						<table class="">
								<caption>회원정보</caption>
								<colgroup>
									<col width="239" />
									<col width="" />
								</colgroup>
								<tbody>
									<tr>
										<td><label for="tb_pw">현재 비밀번호</label></td>
										<td><input type="password" class="" value="" name="now_pw" placeholder="" id="tb_pw"/></td>
									</tr>
									<tr>
										<td><label for="tb_pw3">새로운 비밀번호</label></td>
										<td><input type="password" class="" value="" name="new_pw" placeholder="" id="tb_pw3"/></td>
									</tr>
									<tr>
										<td><label for="tb_pw4">새로운 비밀번호 확인</label></td>
										<td><input type="password" class="" value="" name="new_pw2" placeholder="" id="tb_pw4"/></td>
									</tr>
								</tbody>
						</table>
						<input type="submit" class="" value="변경저장" name="save" />					
					</div>
				</form>
				<!-- END.profile_wrap -->
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
<script>
function pwdFrm(Frm){
	if(Frm.now_pw.value.trim() == ''){
		alert("현재 비밀번호를 입력해주세요.");
		Frm.now_pw.focus();
		return false;
	}

	if(Frm.new_pw.value.trim() == ''){
		alert("새로운 비밀번호를 입력해주세요.");
		Frm.new_pw.focus();
		return false;
	}

	if(Frm.new_pw2.value.trim() == ''){
		alert("새로운 비밀번호 확인을 해주세요.");
		Frm.new_pw2.focus();
		return false;
	}

	if(Frm.new_pw2.value != Frm.new_pw.value){
		alert("새로 입력한 비밀번호가 서로 다릅니다.");
		Frm.new_pw2.focus();
		return false;
	}


	if(confirm("패스워드를 변경하시겠습니까?")){
		Frm.action = "/lib/member_chg_pwd.php";
		Frm.submit();
	}
}
</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>