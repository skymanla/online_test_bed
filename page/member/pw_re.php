<?
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
if(empty($_GET['getEmail'])){
	header("HTTP/1.1 400 Bad Request");
	go_href("잘못된 접근입니다.", "/", "go");
	exit;
}
$email = $_GET['getEmail'];
$sql = "select m_id, m_sec_code from tbl_member where m_id=?";
$query = $db->prepare($sql);
try{
	$query->execute([$email]);
}catch(PDOException $e){

}

$data = $query->fetch();
if(empty($data)){
	header("HTTP/1.1 400 Bad Request");
	go_href("잘못된 접근입니다.", "/", "go");
	exit;	
}else{
	if(empty($data['m_sec_code'])){
		header("HTTP/1.1 400 Bad Request");
		go_href("잘못된 접근입니다.", "/", "go");
		exit;		
	}
}


?>
		<div class="pw_re_sec">
			<form method="post" name="pr_reFrm" onsubmit="return pw_re(this);return false;">
				<input type="hidden" name="email" value="<?=$email?>" />
				<fieldset>
					<legend>비밀번호 재설정</legend>
					<div class="pw_re_txt">
						<h4>비밀번호 재설정</h4>
						<p>새로 사용할 비밀번호를 입력해 주세요</p>
						<div>
							<label for="tb_pw3">새 비밀번호 입력</label>
							<input type="password" class="" value="" name="new_pw" placeholder="새 비밀번호 입력" id="tb_pw3"/>
						</div>
						<div>
							<label for="tb_pw4">새 비밀번호 확인</label>
							<input type="password" class="" value="" name="new_pw2" placeholder="새 비밀번호 확인" id="tb_pw4"/>
						</div>
					</div>
					<div class="btn_lost">
						<a href="/">취소</a>
						<a href="javascript:pw_re(document.pr_reFrm)" class="btn_lost_c">비밀번호 저장</a>
					</div>
				</fieldset>
			</form>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
		<script>
			function pw_re(Frm){
				if(Frm.new_pw.value.trim() == ''){
					alert("비밀번호를 입력해 주세요.");
					Frm.new_pw.focus();
					return;
				}
				if(Frm.new_pw2.value.trim() == ''){
					alert("비밀번호를 입력해 주세요.");
					Frm.new_pw2.focus();
					return;
				}
				if(Frm.new_pw.value != Frm.new_pw2.value){
					alert("비밀번호가 다릅니다.");
					Frm.new_pw2.focus();
					return;
				}

				Frm.action="/lib/lost_pw_re.php";
				Frm.submit();
			}
		</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>