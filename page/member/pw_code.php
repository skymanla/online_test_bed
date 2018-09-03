<?
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
if(empty($_GET['getEmail'])){
	header("HTTP/1.1 400 Bad Request");
	go_href("잘못된 접근입니다.", "/", "go");
	exit;
}

$sql = "select m_id, m_sec_code from tbl_member where m_id='".$_GET['getEmail']."' and m_sec_code is not null ";
$q = $db->query($sql);
if($q->rowCount() == false){
	header("HTTP/1.1 400 Bad Request");
	go_href("잘못된 접근입니다.", "/", "go");
	exit;
}else{
	$r = $q->fetch();	
}
?>
		<div class="pw_code_sec">
			<form name="pw_codeFrm" method="post" onsubmit="return pw_Frm(this);">
				<input type="hidden" name="email" value="<?=$r['m_id']?>" />
				<fieldset>
					<legend>비밀번호 재설정</legend>
					<div class="pw_code_txt">
						<h4>비밀번호 재설정</h4>
						<p>보안코드를 입력해주세요</p>
						<div>
							<label for="tb_code">보안코드</label>
							<input type="password" class="" value="" name="code" placeholder="" id="tb_code"/>
						</div>
					</div>
					<div class="btn_lost">
						<a href="login.php">취소</a>
						<a href="javascript:pw_Frm(document.pw_codeFrm);" class="btn_lost_c">계속</a>
					</div>
				</fieldset>
			</form>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
		<script>
			function pw_Frm(Frm){
				if(Frm.code.value.trim() == ''){
					alert("보안코드를 입력해주세요.");
					Frm.code.focus();
					return;
				}

				Frm.action="/lib/lost_pw_code.php";
				Frm.submit();
			}
		</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>