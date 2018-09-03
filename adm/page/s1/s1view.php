<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");

$query = "select * from tbl_member a join tbl_member_file b on a.mseq=b.mf_meq where a.mseq='".$_GET['idx']."'";
$r = $db->query($query);
$member = $r->fetch();
if(empty($member)){
	go_href("잘못된 접근입니다.", "/adm/page/s1/s1.php", "go");
}

switch($member['m_auth']){
	case "Y" :
		$mem_auth = "승인";
		break;
	case "N" :
		$mem_auth = "거절";
		break;
	default :
		$mem_auth = "대기";
		break;
}

if($member['m_del_flag'] == true){
	$mem_stat = "삭제";
}else{
	$mem_stat = "가입";
}
?>
	<!-- STR lng_wrap -->
	<nav id="lng_wrap">
		<div class="member_wrap">
			<div class="m_info">
				<div class="name">최고관리자님</div>
				<a href="javascript:void(0);">로그아웃</a>
			</div>
			<dl class="data">
				<dt>로그인 IP</dt><dd>14.32.121.97</dd>
				<dt>등급</dt><dd>최고관리자</dd>
			</dl>
		</div>
		<h2 class="title s11">사용자회원관리</h2>
	</nav>
	<!-- END lng_wrap -->
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>사용자 회원관리</h2>
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
							<span>등록일 : <?=date('Y-m-d H:i', strtotime($member['m_regdate']))?></span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>이름</td>
						<td><?=$member['m_name']?></td>
					</tr>
					<tr>
						<td>이메일</td>
						<td><?=$member['m_id']?></td>
					</tr>
					<tr>
						<td>휴대폰번호</td>
						<td><?=$member['m_phone']?></td>
					</tr>
					<tr>
						<td>닉네임</td>
						<td><?=$member['m_nick']?></td>
					</tr>
					<tr>
						<td>첨부파일</td>
						<td><a href="/lib/download.php?idx=<?=$member['mseq']?>"><?=$member['mf_file_name']?></a></td>
					</tr>
					<tr>
						<td>상태</td>
						<td><?=$mem_auth?></td>
					</tr>
					<tr>
						<td>승인</td>
						<td><?=$mem_stat?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="bt_wrap3">
			<button type="button" class="bt_2" onclick="change_stat('<?=$member['mseq']?>', 'Y')">승인</button>
			<button type="button" class="bt_2" onclick="change_stat('<?=$member['mseq']?>', 'N')">거절</button>
			<button type="button" class="bt_2" onclick="change_stat('<?=$member['mseq']?>', 'D')">삭제</button>
			<a href="s1.php" class="bt_2">목록</a>
		</div>
	</section>
	<!-- END contents -->
</div>
<script>
function change_stat(idx, mode){
	$.ajax({
		type : "POST",
		data : {"idx" : idx, "mode" : mode},
		dataType : "json",
		url : "/common/ajax/change_stat.php",
		success : function(result){
			//console.log(result);
			alert(result.msg);
			location.reload();
		}, error :function(){
			console.log('errrr');
		}
	});
}
</script>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>