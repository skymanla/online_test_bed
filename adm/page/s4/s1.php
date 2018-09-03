<?
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/device_list_all_curl.php");
$board_no = $count_decoder;
?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>기기관리</h2>
		</div>
		<div class="table_wrap1 no_line">
		<!--<table>
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
								<option value="dtype">분류</option>
								<option value="name" selected="selected">단말기명</option>
								<option value="main">메인등록</option>
								<option value="regdate">등록일</option>
							</select>
							<input type="text" class="w_input1" value="" name="search_word" id="search_word" style="width:180px">
							<button type="button" class="bt_s1 input_sel" id="cate_append_bt">검색</button>
						</form>
					</td>
				</tr>
			</tbody>
		</table>-->
	</div>
		<div class="table_wrap1">
			<table>
				<caption>게시글 목록</caption>
				<colgroup>
					<col width="150">
					<col width="">
					<col width="">
					<col width="">
				</colgroup>
				<thead>
					<tr>
						<th>번호</th>
						<th>분류</th>
						<th>단말기명</th>
						<th>고유값</th>
					</tr>
				</thead>
				<tbody>
					<? if($count_decoder == false){ ?>
					<tr>
						<td class="txt_c" colspan="5">등록된 기기가 없습니다.</td>
					</tr>
					<? 
					}else{
						foreach($decoder as $key => $row){
					?>
					<tr>
						<td class="txt_c"><?=$board_no?></td>
						<td class="txt_c"><?=$row['platform']?></td>
						<td class="txt_c"><?=$row['nickname']?></a></td>
						<td class="txt_c"><?=$row['serial']?></a></td>
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
			<!--<div class="right_box">
				<a href="s1regist.php" class="bt_1">등록</a>
			</div>-->
		</div>
		<!--<nav class="paging_type1">
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
		</nav>-->
	</section>
	<!-- END contents -->
</div>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>