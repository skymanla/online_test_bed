<?
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");

$cur_page = (int)$_GET['cur_page'];
if($cur_page=="") $cur_page = 1; //페이지 번호가 없으면 1번 페이지

$tbl_info = "tbl_member";

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

$query = "select * from $tbl_info where 1 $whereis order by mseq desc limit $limit_num offset $show_offset_num";
$r = $db->query($query);

$rowcnt = $r->rowCount();
?>	
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>사용자회원관리</h2>
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
							<select name="stx" id="stx" title="" class="w_input1">
								<option value="email" <?=$email_chk?>>이메일</option>
								<option value="name" <?=$name_chk?>>이름</option>
								<option value="phone" <?=$phone_chk?>>휴대폰번호</option>
								<option value="nickname" <?=$nick_chk?>>닉네임</option>
								<!--<option value="condition">승인상태</option>
								<option value="stat">가입상태</option>-->
							</select>
							<input type="text" class="w_input1" value="<?=$_GET['search_word']?>" name="search_word" id="search_word" style="width:180px">
							<button type="button" class="bt_s1 input_sel" id="cate_append_bt" onclick="stxFrm(document.searchFrm);">검색</button>
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
					<col width="">
					<col width="200">
					<col width="">
					<col width="200">
					<col width="200">
				</colgroup>
				<thead>
					<tr>
						<th>번호</th>
						<th>이메일</th>
						<th>이름</th>
						<th>휴대폰번호</th>
						<th>닉네임</th>
						<th>승인상태</th>
						<th>가입상태</th>
					</tr>
				</thead>
				<tbody>
					<?
					if($rowcnt == false){
					?>
					<tr>
						<td class="txt_c" colspan="6">가입한 회원이 없습니다.</td>
					</tr>
					<?
					}else{
						foreach($r as $key => $mem_list){
							switch($mem_list['m_auth']){
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
							if($mem_list['m_del_flag'] == true){
								$mem_stat = "탈퇴";
							}else{
								$mem_stat = "가입";
							}
					?>
					<tr>
						<td class="txt_c"><?=$board_no?></td>
						<td class="txt_c"><a href="./s1view.php?idx=<?=$mem_list['mseq']?>"><?=$mem_list['m_id']?></a></td>
						<td class="txt_c"><?=$mem_list['m_name']?></td>
						<td class="txt_c"><?=$mem_list['m_phone']?></td>
						<td class="txt_c"><?=$mem_list['m_nick']?></td>
						<td class="txt_c"><?=$mem_auth?></td>
						<td class="txt_c"><?=$mem_stat?></td>
					</tr>
					<? 
							$board_no--;
						}
					}
					?>
				</tbody>
			</table>
		</div>
		<!--<div class="bt_wrap1">
			<div class="right_box">
				<a href="javascript:void(0);" class="bt_1">등록</a>
			</div>
		</div>-->
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
<script>
function stxFrm(Frm){
	Frm.submit();
}
</script>
<!-- END warp -->
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</body>
</html>