<?php
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");

$cur_page = (int)$_GET['cur_page'];
if($cur_page=="") $cur_page = 1; //페이지 번호가 없으면 1번 페이지

$tbl_info = "tbl_notice";

if(isset($_GET['stx'])){
	switch($_GET['stx']){
		case "name" :
			$whereis = " and m_name like '%".$_GET['search_word']."%' ";
			$name_chk = "selected";
			break;
		case "email" :
			$whereis = " and m_id like '%".$_GET['search_word']."%' ";
			$email_chk = "selected";
			break;
		case "phone" :
			$whereis = " and m_phone like '%".$_GET['search_word']."%' ";
			$phone_chk = "selected";
			break;
		case "nickname" :
			$whereis = " and m_nick like '%".$_GET['search_word']."%' ";
			$nick_chk = "selected";
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

$sql = "select * from $tbl_info where 1 $whereis order by nseq desc limit $limit_num offset $show_offset_num";
$query = $db->query($sql);

$list_flag = true;
if($query->rowCount() == false){
	$list_flag = false;
}else{

}
?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>공지사항</h2>
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
								<option value="tit" selected="selected">제목</option>
								<option value="writer">작성자</option>
								<option value="date">등록일</option>
							</select>
							<input type="text" class="w_input1" value="" name="search_word" id="search_word" style="width:180px">
							<button type="button" class="bt_s1 input_sel" id="cate_append_bt">검색</button>
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
					<col width="">
					<col width="200">
					<col width="200">
				</colgroup>
				<thead>
					<tr>
						<th>번호</th>
						<th>제목</th>
						<th>작성자</th>
						<th>등록일</th>
					</tr>
				</thead>
				<tbody>
					<?
					if($list_flag == false){
						echo '<tr><td colspan="4">등록된 공지사항이 없습니다.</td></tr>';
					}else{
						foreach($query as $key => $list){
					?>
					<tr>
						<td class="txt_c"><?=$board_no?></td>
						<td class="txt_c"><a href="s1view.php?idx=<?=$list['nseq']?>"><?=$list['n_title']?></a></td>
						<td class="txt_c"><?=$list['n_writer']?></td>
						<td class="txt_c"><?=date('Y.m.d H:i', strtotime($list['n_regdate']))?></td>
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