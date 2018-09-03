<? include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php"); ?>	
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>관리자 회원관리</h2>
		</div>
		<form name="admin_form" method="post" onsubmit="return admFrm(this);return false;">
			<input type="hidden" name="ad_id_chk" />
			<div class="table_wrap1">
				<table>
					<caption>게시글 상세보기</caption>
					<colgroup>
						<col width="150">
						<col width="">
					</colgroup>
					<tbody>
						<tr>
							<td><label for="tb_name">이름</label></td>
							<td><input type="text" class="w_input1" value="" name="ad_name" placeholder="" id="tb_name" /></td>
						</tr>
						<tr>
							<td><label for="tb_id">아이디</label></td>
							<td>
								<div class="">
									<input type="text" class="w_input1" value="" name="ad_id" placeholder="" id="tb_id" />
									<button type="button" class="bt_2" onclick="adm_id_ahk();">중복확인</button>
								</div>
							</td>
						</tr>
						<tr>
							<td><label for="pw">비밀번호</label></td>
							<td><input type="password" class="w_input1" value="" name="ad_pwd" placeholder="" id="tb_pw" /></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="bt_wrap3">
				<a href="javascript:admFrm(document.admin_form);" class="bt_2">저장</a>
				<a href="s1.php" class="bt_2">목록</a>
			</div>
		</form>
	</section>
	<!-- END contents -->
</div>
<script>
function adm_id_ahk(){
	var getId = $('input[name=ad_id]').val();
	if(getId.trim() == ""){
		alert("아이디를 입력해 주세요.");
		$('input[name=ad_id]').focus();
		return false;
	}

	$.ajax({
		type : "POST",
		dataType : "json",
		data : {"ad_id" : getId},
		url : "/common/ajax/adm_id_check.php",
		success : function(result){
			alert(result.msg);
			$('input[name=ad_id_chk]').val(result.code);
			if(result.code == "readonly"){
				$('input[name=ad_id]').attr('readonly', 'readonly');
			}else{
				//$('input[name=ad_id]').attr('readonly', 'readonly');
			}
			
		}
	});
}

function admFrm(Frm){
	if(Frm.ad_name.value.trim() == ''){
		alert("이름을 입력해 주세요.");
		Frm.ad_name.focus();
		return;
	}

	if(Frm.ad_pwd.value.trim() == ''){
		alert("비밀번호를 입력해 주세요.");
		Frm.ad_pwd.focus();
		return;
	}

	if(Frm.ad_id_chk.value.trim() == '' || Frm.ad_id_chk.value != "readonly"){
		alert("중복확인을 해주세요.");
		return;
	}

	if(confirm("사용자를 추가하시겠습니까?")){
		Frm.action="/lib/adm_member_add.php";
		Frm.submit();
	}else{
		return;
	}
}
</script>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>