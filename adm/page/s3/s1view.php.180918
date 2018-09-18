<?
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");

$idx = $_GET['idx'];
$sql = "select * from 
		tbl_device_booking a join tbl_member c on a.booking_mseq=c.mseq 
		where booking_seqnum='$idx'
		order by unix_timestamp(date_format(a.booking_date, '%Y-%m-%d')) desc";
		echo $sql;
$query = $db->query($sql);

$rowcnt = $query->rowCount();
if($rowcnt == 0){
	go_href("등록되지 않은 예약입니다.", "/adm/page/s3/s1.php", "go");
}else{
	$device_title = '';
	$list = $query->fetch();
	if($rowcnt > 1){
		foreach($query as $key => $row){
			$ret['booking_dv_name'][] = $row['booking_dv_name'];
			$ret['booking_dv_type'][] = $row['booking_dv_type'];
		}

		$count_dv = count($ret['booking_dv_name']);
		
		for($i=0; $i < $count_dv; $i++){
			if($ret['booking_dv_type'][$i] == "Android"){
				$sys_cate = "안드로이드";
			}else if($ret['booking_dv_type'][$i] == "iOS"){
				$sys_cate = "IOS";
			}else{
				$sys_cate = "None-Type";
			}
			$device_title .= "[".$sys_cate."] ".$ret['booking_dv_name'][$i]." | ";
		}
		
	}

	//device, os_type array
	switch($list['booking_dv_type']){
		case "Android" :
			$sys_cate = "안드로이드";
			break;
		case "iOS" :
			$sys_cate = "IOS";
			break;
		default :
			$sys_cate = "None-Type";
			break;
	}
	$device_title .= "[".$sys_cate."] ".$list['booking_dv_name'];

	switch($list['booking_accept']){
		case "Y":
			$booking_stat = "승인";
			break;
		case "N":
			$booking_stat = "거절";
			break;
		case "D":
			$booking_stat = "삭제";
			break;
		default :
			$booking_stat = "대기";
			break;
	}
}
?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>테스트베드 예약관리</h2>
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
							<span>작성일 : <?=$list['booking_regdate']?></span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>신청테스트베드</td>
						<td><?=$device_title?></td>
					</tr>
					<tr>
						<td>신청일자</td>
						<td><?=$list['booking_date']?> <?=$list['booking_start_time']?> ~ <?=$list['booking_end_time']?></td>
					</tr>
					<tr>
						<td>신청자</td>
						<td><?=$list['m_nick']?></td>
					</tr>
					<tr>
						<td>상태</td>
						<td><?=$booking_stat?></td>
					</tr>
					<tr>
						<td>임시아이디</td>
						<td><?=$list['booking_device_id']?></td>
					</tr>
					<tr>
						<td>임시비밀번호</td>
						<td><?=$list['booking_device_pwd']?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="bt_wrap3">
			<button type="button" class="bt_2" onclick="booking_change('<?=$list['booking_seqnum']?>', 'A');">승인</button>
			<button type="button" class="bt_2" onclick="booking_change('<?=$list['booking_seqnum']?>', 'R');">거절</button>
			<button type="button" class="bt_2" onclick="booking_change('<?=$list['booking_seqnum']?>', 'D');">삭제</button>
			<a href="s1.php" class="bt_2">목록</a>
		</div>
	</section>
	<!-- END contents -->
</div>
<script>
function booking_change(getIdx, getMode){
	$.ajax({
		type : "POST",
		//dataType : "json",
		data : {"getIdx" : getIdx, "getMode" : getMode},
		url : "/common/ajax/adm_booking_change.php",
		success : function(result){			
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