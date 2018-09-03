<?
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");

$sql = "select * from tbl_admin where ad_seq='".$_GET['idx']."'";
$query = $db->query($sql);
if($query->rowCount() == false){
	header("HTTP/1.1 400 Bed Request");
	go_href("잘못된 회원정보입니다.", "/adm/page/s2/s1.php", "go");
	exit;
}

$r = $query->fetch();
?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>관리자 회원관리</h2>
		</div>
		<div class="table_wrap1">
			<table>
				<caption>게시글 상세보기</caption>
				<colgroup>
					<col width="150">
					<col width="">
				</colgroup>
				<thead>
					<tr>
						<th colspan="2" class="txt_l">
							<span>등록일 : <?=date('Y-m-d H:i', strtotime($r['ad_regdate']))?></span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><label for="tb_name">이름</label></td>
						<td><input type="text" class="w_input1" value="<?=$r['ad_name']?>" name="ad_name" placeholder="" id="tb_name" /></td>
					</tr>
					<tr>
						<td><label for="tb_id">아이디</label></td>
						<td>
							<div class="">
								<input type="text" class="w_input1" value="<?=$r['ad_id']?>" name="" placeholder="" id="tb_id" disabled="disabled"/>
							</div>
						</td>
					</tr>
					<tr>
						<td><label for="tb_pw">비밀번호</label></td>
						<td><input type="password" class="w_input1" value="" name="ad_pw" placeholder="" id="tb_pw" /></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="bt_wrap3">
			<button type="button" class="bt_2" onclick="adm_chg_stat('<?=$r['ad_seq']?>', 'U');">수정</button>
			<button type="button" class="bt_2" onclick="adm_chg_stat('<?=$r['ad_seq']?>', 'D');">삭제</button>
			<a href="s1.php" class="bt_2">목록</a>
		</div>
	</section>
	<!-- END contents -->
</div>
<script>
function adm_chg_stat(seq, mode){
	var chg_name = $('input[name=ad_name]').val();
	var chg_pw = $('input[name=ad_pw]').val();

	if(chg_name.trim() == ''){
		alert("이름은 공백이 되면 안됩니다.");
		$('input[name=ad_name]').focus();
		return false;
	}

	$.ajax({
		type : "POST",
		dataType : "json",
		data : {"seq" : seq, "mode" : mode, "chg_name" : chg_name, "chg_pw" : chg_pw},
		url : "/common/ajax/adm_chg_stat.php",
		success: function(result){
			alert(result.msg);
			location.reload();
		}, error : function(){
			console.log('errrrr');
		}
	});
}
</script>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>