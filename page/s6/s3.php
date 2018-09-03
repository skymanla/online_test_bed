<?php
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");

if(empty($_SESSION['email'])){
	go_href("로그인해주세요.", "/page/member/login.php" , "go");
	exit;
}

$cur_page = (int)$_GET['cur_page'];
if($cur_page=="") $cur_page = 1; //페이지 번호가 없으면 1번 페이지

//mseq
$sql = "select mseq from tbl_member where m_id='".$_SESSION['email']."'";
$q = $db->query($sql);
$v = $q->fetch();
$mseq = $v['mseq'];

//board_cnt
$count = "select count(*) as cnt from tbl_device_booking where booking_mseq='".$mseq."' and booking_accept!='D'";
//$count = "select count(distinct booking_seqnum) as cnt from tbl_device_booking where booking_mseq='".$mseq."'";

$count_result = $db->query($count);

$count_result = $count_result->fetch();
$cnt = $count_result['cnt'];

$limit_num = 10; //몇개씩 리스트에 보여줄 것인지
$offset_num = 10; //몇번 부터 시작할지
$show_offset_num = ($cur_page - 1) * $offset_num; //페이지마다 보여주는 리스트

$board_no = $cnt - $show_offset_num;

$total_page = floor ( $cnt / $limit_num ) + 1;

$list_flag = true;
/*$sql = " select * from tbl_device_booking  where booking_mseq='".$mseq."' 
		order by unix_timestamp(date_format(concat(booking_date,' ',booking_start_time), '%Y-%m-%d %H:%i')) desc
		limit $limit_num offset $show_offset_num";*/

$sql = " select *, count(booking_seqnum) as seq_cnt from tbl_device_booking  where booking_mseq='".$mseq."' and booking_accept!='D'
		group by booking_seqnum
		having count(booking_seqnum) > 0
		order by unix_timestamp(date_format(concat(booking_date,' ',booking_start_time), '%Y-%m-%d %H:%i')) desc
		limit $limit_num offset $show_offset_num";
$query = $db->query($sql);
if($query->rowCount() == false){
	$list_flag = false;
}else{

}
?>
		<div class="s6s3_sec s6">
			<div class="s6s3_sec_wrap s6_wrap">
				<!-- STR.s6_tab -->
				<div class="s6_tab">
					<a href="../../page/s6/s1.php">회원정보</a>
					<a href="../../page/s6/s2.php">비밀번호 변경</a>
					<a href="../../page/s6/s3.php" class="active">예약내역</a>
				</div>
				<!-- END.s6_tab -->

				<!-- STR.rsvdh_wrap -->
				<div class="rsvdh_wrap">
					<h4>예약내역</h4>
					<table class="">
						<caption></caption>
						<colgroup>
							<col width="145px" />
							<col width="" />
							<col width="112px" />
							<col width="178px" />
							<col width="213px" />
						</colgroup>
						<thead>
							<tr>
								<th>신청일자</th>
								<th>신청 테스트베드</th>
								<th>상태</th>
								<th>등록일</th>
								<th>임시 아이디 및 비밀번호</th>
							</tr>
						</thead>
						<tbody>
							<?
							if($list_flag == false){
								echo '<tr><td colspan="5">등록된 예약이 없습니다.</td></tr>';
							}else{
								foreach($query as $key => $list){
									$link_acc_stat = false;
									switch($list['booking_accept']){
										case "Y":
											$accept_stat = "승인";
											$link_acc_stat = true;
											break;
										case "N":
											$accept_stat = "거절";
											break;
										default:
											$accept_stat = "승인대기";
											break;
									}
									$etc_count = '';
									if($list['seq_cnt'] > '1'){
										$new_cnt = $list['seq_cnt'] - 1;
										$etc_count = " 외 ".$new_cnt."건";
									}
							?>
							<tr>
								<td><?=str_replace("-", ".", $list['booking_date'])?><br /><?=$list['booking_start_time']?> ~ <?=$list['booking_end_time']?></td>
								<td>[<?=$list['booking_dv_type']?>]<?=$list['booking_dv_name']?><?=$etc_count?></td>
								<td><?=$accept_stat?></td>
								<td><?=date('Y.m.d H:i', strtotime($list['booking_regdate']))?></td>
								<td>
									<? if($link_acc_stat == true){ ?>
									<a href="javascript:open_pop(<?=$list['bseq']?>);" class="rsvd_ok">확인</a>
									<? }else{ } ?>
								</td>
							</tr>
							<?
									$board_no--;
								}
							}
							?>
						</tbody>
					</table>
					<!-- STR.rsvdh_wrap -->
					<div class="paging_wrap">
						<div class="prev_wrap">
							<a href="<?=$move_prev_first?>" class="f_prev line_l"><i>이전</i></a>
							<a href="javascript:void(0);" class="prev"><i>이전</i></a>
						</div>
						<?
						$first_page_num = (floor ( ($cur_page - 1) / 10 )) * 10 + 1; // 1,11,21,31...
						$last_page_num = $first_page_num + 9; // 10,20,30...last
						$next_page_num = $last_page_num + 1;
						$prev_page_num = $first_page_num - 10;

						$move_prev_first = "?cur_page=".$first_page_num;
						$move_next_final = "?cur_page=".$total_page;

						if ($first_page_num != 1) { // It's not first page
							echo "<a href='?cur_page=$prev_page_num' class='arr prev'><i>이전</i></a>\n";
						}


						for($i = $first_page_num; $i <= $total_page && $i <= $last_page_num; $i ++) {
							if ($cur_page == $i) {
								echo "<a href='?cur_page=$i' class='line_l active'><em>$i</em></a>\n"; // Current page
							} else {
								echo "<a href='?cur_page=$i'><em>$i</em></a>\n";
							}
							if ($i % 10 == 0 && $last_page_num != $total_page) {
								echo "<a href='?cur_page=$next_page_num'><em>다음</em></a>";
							}
						}
						?>
						<div class="next_wrap">
							<a href="javascript:void(0);" class="next line_l"><i>다음</i></a>
							<a href="javascript:void(0);" class="f_next"><i>다음</i></a>
						</div>

						
						<!--<a href="javascript:void(0);" class="line_l active"><em>1</em></a>
						<a href="javascript:void(0);"><em>2</em></a>
						<a href="javascript:void(0);"><em>3</em></a>
						<a href="javascript:void(0);"><em>4</em></a>
						<a href="javascript:void(0);"><em>5</em></a>
						<a href="javascript:void(0);"><em>6</em></a>-->
						
					</div>
					<!-- END.paging_wrap -->
				</div>
				<!-- END.profile_wrap -->
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
		<script>
			function open_pop(getIdx){
				window.open('s3_id_pw.php?idx='+getIdx, '_blank', 'width=520 height=312');
				return;
			}
		</script>
	<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>