<?php
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");

$cur_page = (int)$_GET['cur_page'];
if($cur_page=="") $cur_page = 1; //페이지 번호가 없으면 1번 페이지

if(!empty($_GET['sword'])){
	switch($_GET['stx']){
		case "title":
			$whereis = " and n_title like '%".$_GET['sword']."%' ";
			$title_chk = "selected";
			break;
		case "content":
			$whereis = " and n_content like '%".$_GET['n_content']."%' ";
			$content_chk = "selected";
			break;
	}
}else{
	$whereis = "";
}

//board_cnt
$count = "select count(*) as cnt from tbl_notice where 1 $whereis";

$count_result = $db->query($count);

$count_result = $count_result->fetch();
$cnt = $count_result['cnt'];

$limit_num = 10; //몇개씩 리스트에 보여줄 것인지
$offset_num = 10; //몇번 부터 시작할지
$show_offset_num = ($cur_page - 1) * $offset_num; //페이지마다 보여주는 리스트

$board_no = $cnt - $show_offset_num;

$total_page = floor ( $cnt / $limit_num ) + 1;

$list_flag = true;
$sql = "select * from tbl_notice where 1 $whereis order by nseq desc limit $limit_num offset $show_offset_num";
$query = $db->query($sql);

if($query->rowCount() == false){
	$list_flag = false;
}else{

}
?>
		<div class="s1_sec">
			<div class="s1_sec_head">
				<h3>공지사항</h3>
				<div class="search_wrap">
					<select name="sch_tit" title="카테고리선택">
						<option value="title" <?=$title_chk?>>제목</option>
						<option value="content" <?=$content_chk?>>내용</option>
					</select>
					<div>
						<input type="text" name="search" value="<?=$_GET['sword']?>" />
						<button type="button" onclick="search_move();">검색</button>
					</div>
				</div>
			</div>

			<div class="s1_sec_main">
				<!-- END.table -->
				<table class="">
					<caption>공지사항</caption>
					<colgroup>
						<col width="110px" />
						<col width="" />
						<col width="172px" />
						<col width="220px" />
						<col width="150px" />
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>작성자</th>
							<th>등록일</th>
							<th>조회수</th>
						</tr>
					</thead>
					<tbody>
						<?
						if($list_flag == false){
							echo '<tr><td colspan="5">등록된 공지사항이 없습니다.</td></tr>';
						}else{
							foreach($query as $key => $list){
						?>
						<tr>
							<td><?=$board_no?></td>
							<td><a href="s1view.php?idx=<?=$list['nseq']?>&cur_page=<?=$cur_page?>"><?=$list['n_title']?></a></td>
							<td>관리자</td>
							<td><?=date('Y.m.d H:i', strtotime($list['n_regdate']))?></td>
							<td><?=$list['n_hit']?></td>
						</tr>
						<?
								$board_no--;
							}
						}
						?>						
					</tbody>
				</table>
				<!-- END.table -->

				<!-- STR.paging_wrap -->
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
				</div>
				<!-- END.paging_wrap -->
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
<script>
function search_move(){
	var stx = $('select[name=sch_tit]').val();
	var sword = $('input[name=search]').val();
	location.href="?stx="+stx+"&sword="+sword;
}
</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>