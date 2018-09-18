<?
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");

$cur_page = (int)$_GET['cur_page'];
if($cur_page=="") $cur_page = 1; //페이지 번호가 없으면 1번 페이지

$dating_flag = false;
if(!empty($_GET['search_word'])){
	$key = $_GET['search_word'];
	switch($_GET['stx']){
		case "rdate":
			$dating_flag = true;
			$whereis = " and booking_date='".$key."' ";
			$rdate_chk = "selected";
			break;
		case "testbed":
			$whereis = " and booking_dv_name like '%".$key."%' ";
			$testbed_chk = "selected";
			break;
		case "nickname":
			$whereis = " and booking_mseq in (select mseq from tbl_member where m_nick like '%".$key."%') ";
			$nickname_chk = "selected";
			break;
		case "stat":
			$whereis = " and booking_accept='".$key."' ";
			if($key == 'Y'){
				$y_check = "checked";
			}else if($key == "N"){
				$n_check = "checked";
			}else{
				$w_check = "checked";
			}
			break;
		case "condition":
			$dating_flag = true;
			$whereis = " and date_format(booking_regdate, '%Y-%m-%d')='".$key."' ";
			$condition_chk = "selected";
			break;
	}
}
//개수
$count = "select count(*) as cnt from tbl_device_booking where 1 $whereis";

$count_result = $db->query($count);

$count_result = $count_result->fetch();
$cnt = $count_result['cnt'];

$limit_num = 10; //몇개씩 리스트에 보여줄 것인지
$offset_num = 10; //몇번 부터 시작할지
$show_offset_num = ($cur_page - 1) * $offset_num; //페이지마다 보여주는 리스트

$board_no = $cnt - $show_offset_num;

$total_page = floor ( $cnt / $limit_num ) + 1;


$sql = "select * from 
		tbl_device_booking a join tbl_member c on a.booking_mseq=c.mseq 
		where 1 $whereis
		order by unix_timestamp(date_format(concat(a.booking_date,' ',a.booking_start_time), '%Y-%m-%d %H:%i')) desc, bseq desc
		limit $limit_num offset $show_offset_num
		";
$query = $db->query($sql);
$list_flag = true;
if($query->rowCount() == 0){
	$list_flag = false;
}else{
	//$list = $query->fetch();
}

?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>테스트베드 예약관리</h2>
		</div>
		<div class="table_wrap1 no_line">
		<table>
			<caption>검색필터</caption>
			<colgroup>
				<col width="100">
				<col width="">
			</colgroup>
			<tbody>
				<tr>
					<th>검색필터</th>
					<td>
						<form method="get" name="searchFrm" id="searchFrm">
							<input type="hidden" name="memstat" id="memstat" value="">
							<select name="stx" id="stx" title="" class="w_input1" onchange="stxChange(this)">
								<option value="rdate" <?=$rdate_chk?>>신청일자</option>
								<option value="testbed" <?=$testbed_chk?>>테스트베드</option>
								<option value="nickname" <?=$nickname_chk?>>신청자</option>
								<option value="stat" <?=$stat_chk?>>상태</option>
								<option value="condition" <?=$condition_chk?>>등록일</option>
							</select>

							<input type="text" class="w_input1" value="<?=$key?>" name="search_word" id="search_word" style="width:180px" autocomplete="off">
							
							<span id="search_radio" style="display:none">
								<input type="radio" class="w_input1" value="Y" name="search_word" <?=$y_check?> />승인&nbsp;
								<input type="radio" class="w_input1" value="N" name="search_word" <?=$n_check?> />거절&nbsp;
								<input type="radio" class="w_input1" value="W" name="search_word" <?=$d_check?>  />대기&nbsp;
							</span>
							<button type="button" class="bt_s1 input_sel" id="cate_append_bt" onclick="document.searchFrm.submit()">검색</button>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
		<div class="table_wrap1">
			<table>
				<caption>게시글 목록</caption>
				<colgroup>
					<col width="150">
					<col width="200">
					<col width="">
					<col width="200">
					<col width="200">
					<col width="">
				</colgroup>
				<thead>
					<tr>
						<th>번호</th>
						<th>신청일자</th>
						<th>신청 테스트베드</th>
						<th>신청자</th>
						<th>상태</th>
						<th>등록일</th>
					</tr>
				</thead>
				<tbody>
					<?
					if($list_flag == false){
						echo '<tr><td class="txt_c" colspan="6">등록된 예약이 없습니다.<td></tr>';
					}else{
						foreach($query as $key => $row){
							switch($row['booking_dv_type']){
								case "Android":
									$sys_cate = "안드로이드";
									break;
								case "iOS":
									$sys_cate = "IOS";
									break;
								default :
									$sys_cate = "None-Type";
									break;
							}

							switch($row['booking_accept']){
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

							$etc_count = '';
							if($row['seq_cnt'] > '1'){
								$new_cnt = $row['seq_cnt'] - 1;
								$etc_count = " 외 ".$new_cnt."건";
							}
					?>
					<tr>
						<td class="txt_c"><?=$board_no?></td>
						<td class="txt_c"><?=date('Y.m.d', strtotime($row['booking_date']))?><br /><?=$row['booking_start_time']?> ~ <?=$row['booking_end_time']?></td>
						<td class="txt_c"><a href="s1view_b.php?idx=<?=$row['bseq']?>">[<?=$sys_cate?>] <?=$row['booking_dv_name']?><?=$etc_count?></a></td>
						<td class="txt_c"><?=$row['m_nick']?></td>
						<td class="txt_c"><?=$booking_stat?></td>
						<td class="txt_c"><?=date('Y.m.d H:i', strtotime($row['booking_regdate']))?></td>
					</tr>
					<?
							$board_no--;
						}
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="bt_wrap1">
			<div class="right_box">
				<a href="javascript:void(0);" class="bt_1">등록</a>
			</div>
		</div>
		<nav class="paging_type1">
			<?php 
			$first_page_num = (floor ( ($cur_page - 1) / 10 )) * 10 + 1; // 1,11,21,31...
			$last_page_num = $first_page_num + 9; // 10,20,30...last
			$next_page_num = $last_page_num + 1;
			$prev_page_num = $first_page_num - 10;

			if ($first_page_num != 1) { // It's not first page
				echo "<a href='?cur_page=$prev_page_num' class='arr prev'><i>이전</i></a>\n";
			}

			for($i = $first_page_num; $i <= $total_page && $i <= $last_page_num; $i ++) {
				if ($cur_page == $i) {
					echo "<a href='?cur_page=$i' class='active'>$i</a>\n"; // Current page
				} else {
					echo "<a href='?cur_page=$i'>$i</a>\n";
				}
				if ($i % 10 == 0 && $last_page_num != $total_page) {
					echo "<a href='?cur_page=$next_page_num' class='arr next'><i>다음</i></a>";
				}
			}
			?>
		</nav>
	</section>
	<!-- END contents -->
</div>
<script type="text/javascript" src="/adm/js/jquery-ui.min.js"></script>
<script>
$(function(){
	$('#stx option[value="<?=$_GET['stx']?>"]').attr('selected', 'selected');
	//console.log($('input[name=s_sido'));
	stxChange($('#stx')[0]);
});
function stxChange(opt){
	var Pt = opt.parentNode.getElementsByClassName('w_input1');
	if(opt.value == "rdate" || opt.value == "condition"){
		Pt[1].setAttribute('id', 'inp_date');
		$('#inp_date').val('');
		$('#inp_date').datepicker({
			dateFormat: 'yy-mm-dd'
		});
	}else{
		$('#inp_date').datepicker("destroy");
		Pt[1].removeAttribute('id');
	}

	if(opt.value == "stat"){
		Pt[1].style.display = "none";
		$("#search_radio").show();
	}else{
		$('input[type=radio]').removeAttr('checked');
		Pt[1].style.display = "inline-block";
		$("#search_radio").hide();
	}
}
</script>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>