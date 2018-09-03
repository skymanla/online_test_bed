<?
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");

$cur_page = (int)$_GET['cur_page'];
if($cur_page=="") $cur_page = 1; //페이지 번호가 없으면 1번 페이지

$tbl_info = "tbl_admin";
if(!empty($_GET['search_word'])){
	switch($_GET['stx']){
		case "id" :
			$whereis = " and ad_id='".$_GET['search_word']."' ";
			$name_chk = "selected";
			break;
		case "name" :
			$whereis = " and ad_name like '%".$_GET['search_word']."%' ";
			$email_chk = "selected";
			break;
		case "date" :
			$whereis = " and date_format(ad_regdate, '%Y-%m-%d') = '".$_GET['search_word']."' ";
			$phone_chk = "selected";
			break;		
	}
}
//개수
$count = "select count(*) as cnt from $tbl_info where 1 $whereis";

$count_result = $db->query($count);

$count_result = $count_result->fetch();
$cnt = $count_result['cnt'];

$limit_num = 10; //몇개씩 리스트에 보여줄 것인지
$offset_num = 10; //몇번 부터 시작할지
$show_offset_num = ($cur_page - 1) * $offset_num; //페이지마다 보여주는 리스트

$board_no = $cnt - $show_offset_num;

$total_page = floor ( $cnt / $limit_num ) + 1;

$query = "select * from $tbl_info where 1 $whereis order by ad_seq desc limit $limit_num offset $show_offset_num";
$r = $db->query($query);

$rowcnt = $r->rowCount();
?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>관리자회원관리</h2>
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
							<select name="stx" id="stx" title="" class="w_input1">
								<option value="id" <?=$name_chk?>>아이디</option>
								<option value="name" <?=$email_chk?>>이름</option>
								<!--<option value="date">등록일</option>-->
							</select>
							<input type="text" class="w_input1" value="" name="search_word" id="search_word" style="width:180px">
							<button type="button" class="bt_s1 input_sel" id="cate_append_bt" onclick="document.searchFrm.submit()" >검색</button>
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
					<col width="200">
					<col width="400">
					<col width="400">
					<col width="600">
				</colgroup>
				<thead>
					<tr>
						<th>번호</th>
						<th>아이디</th>
						<th>이름</th>
						<th>등록일</th>
					</tr>
				</thead>
				<tbody>
					<? if($rowcnt == false){ ?>
					<tr>
						<td class="text_c" colspan="4">등록된 관리자가 없습니다.</td>
					</tr>
					<? }else{
						foreach($r as $key => $admin_row){
					?>
					<tr>
						<td class="txt_c"><?=$board_no?></td>
						<td class="txt_c"><a href="s1view.php?idx=<?=$admin_row['ad_seq']?>"><?=$admin_row['ad_id']?></a></td>
						<td class="txt_c"><?=$admin_row['ad_name']?></td>
						<td class="txt_c"><?=date("Y-m-d H:i", strtotime($admin_row['ad_regdate']))?></td>
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
				<a href="s1regist.php" class="bt_1">등록</a>
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
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>