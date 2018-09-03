<?
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");
?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>기기관리</h2>
		</div>
		<div class="table_wrap1">
			<table>
				<caption>기기 작성</caption>
				<colgroup>
					<col width="150">
					<col width="">
				</colgroup>
				<thead>
					<tr>
						<th colspan="4" class="txt_l">기기 작성</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>분류</th>
						<td>
							<select name="tb_system" id="tb_system" title="" class="w_input1"">
								<option value="A">선택</option>
								<option value="0" selected="selected">안드로이드</option>
								<option value="1">아이폰</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>단말기명</th>
						<td>
							<input type="text" class="w_input1" value="Galaxy S9+" name="tb_phone" id="tb_phone" placeholder="">
						</td>
					</tr>
					<tr>
						<th>메인등록</th>
						<td>
							<div class="label_box1_wrap" id="main_tab">
								<div class="label_box1"><input type="radio" name="use" id="check_1" value="use" checked=""><label for="check_1">사용</label></div>
								<div class="label_box1"><input type="radio" name="use" id="check_2" value="not_used"><label for="check_2">사용안함</label></div>
							</div>
						</td>
					</tr>
					<tr>
						<th>내용</th>
						<td class="con_editor1">
							<textarea name="content" class="w_input1" id="inp_3" cols="30" rows="10" style="height: 200px;">에디터 삽입</textarea>
						</td>
					</tr>
					<tr>
						<th>첨부파일</th>
						<td>
							<div class="filebox">
								<input class="upload_name w_input1" value="" name="" placeholder="" disabled="disabled" />
								<label for="tb_file" class="bt_3">찾아보기</label>
								<input type="file" class="upload_hidden" value="" name="" placeholder="" id="tb_file"/>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="bt_wrap1">
			<div class="right_box">
				<button type="button" class="bt_1">수정</button>
				<button type="button" class="bt_1">삭제</button>
				<a href="s1.php" class="bt_1">목록</a>
			</div>
		</div>
	</section>
	<!-- END contents -->
</div>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>