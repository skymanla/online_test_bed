<?
/*
Ryan skymanla
device booking system
*/
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
if(empty($_SESSION['email'])){
	go_href("로그인해주세요.", "/page/member/login.php" , "go");
	exit;
}
$sql = "select * from tbl_member a join tbl_member_file b on a.mseq=b.mf_meq where m_id='".$_SESSION['email']."'";
$query = $db->query($sql);
$row = $query->fetch();
?>
		<div class="s6s1_sec s6">
			<form name="member_modify" method="post" enctype="multipart/form-data" onsubmit="return memberModi(this);return false;">
				<input type="hidden" name="getId" value="<?=$row['m_id']?>" />
				<input type="hidden" name="getFidx" value="<?=$row['mfseq']?>" />
				<div class="s6s1_sec_wrap s6_wrap">
					<!-- STR.s6_tab -->
					<div class="s6_tab">
						<a href="../../page/s6/s1.php" class="active">회원정보</a>
						<a href="../../page/s6/s2.php">비밀번호 변경</a>
						<a href="../../page/s6/s3.php">예약내역</a>
					</div>
					<!-- END.s6_tab -->

					<!-- STR.profile_wrap -->
					<div class="profile_wrap">
						<h4>회원정보</h4>
						<table class="">
							<caption>회원정보</caption>
							<colgroup>
								<col width="209" />
								<col width="" />
							</colgroup>
							<tbody>
								<tr>
									<td>아이디(이메일)</td>
									<td><?=$row['m_id']?></td>
								</tr>
								<tr>
									<td><label for="tb_name">이름</label></td>
									<td><input type="text" class="" value="<?=$row['m_name']?>" name="name" placeholder="" id="tb_name"/></td>
								</tr>
								<tr>
									<td>휴대폰번호</td>
									<td><?=$row['m_phone']?></td>
								</tr>
								<tr>
									<td><label for="tb_nickname">닉네임</label></td>
									<td><input type="text" class="" value="<?=$row['m_nick']?>" name="nickname" placeholder="" id="tb_nickname"/></td>
								</tr>
								<tr>
									<td>첨부파일</td>
									<td>
										<div class="filebox">
											<input class="upload_name" value="<?=$row['mf_file_name']?>" name="file_name" placeholder="" disabled="disabled" />
											<label for="tb_file">첨부파일</label>
											<input type="file" class="upload_hidden" name="file" id="tb_file"/><br />
											<span class="file_del_click"><?=$row['mf_file_name']?></span>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<input type="submit" class="" value="변경저장" name="save" onclick="return memberModi(document.member_modify);return false;" />
					</div>
					<!-- END.profile_wrap -->
				</div>
				<button type="button" class="top_btn"><i>화면상단</i></button>
			</form>
		</div>
<script>
$(function(){
	$('.file_del_click').on("click", function(e){
		if(confirm("첨부파일을 삭제하시겠습니까?\n삭제하면 복구할 수 없습니다.")){
			$.ajax({
				type : "POST",
				data : {"member_data" : "<?=$row['m_id']?>", "file_data" : "<?=$row['mfseq']?>"},
				url : "/common/ajax/member_profile_del.php",
				success : function(result){
					alert(result.msg);
					$('input[name=file_name]').val(result.file_name);
					$('file_del_click').hide();
				}, error : function(){
					console.log('errrr');
				}
			})
		}else{
			return false;
		}
	});
});

function memberModi(Frm){
	if(Frm.name.value.trim() == ''){
		alert("이름을 입력해주세요.");
		Fm.name.focus();
		return false;
	}
	if(Frm.nickname.value.trim() == ''){
		alert("닉네임을 입력해주세요.");
		Frm.nickname.focus();
		return false;
	}

	if(Frm.file_name.value.trim() == ''){
		alert("첨부파일을 추가해주세요.");
		return false;
	}

	Frm.action="/lib/register_modify.php";
	Frm.submit();
}
</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>