<?
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");
?>
	<!-- STR contents -->
	<section id="contents">
		<div class="headgroup1">
			<h2>기기관리</h2>
		</div>
		<form name="deviceForm" method="post" enctype="multipart/form-data" onsubmit="return deviceFrm(this);return false">
			<input type="hidden" name="mode" value="W" />
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
								<select name="system" id="system" title="" class="w_input1"">
									<option value="AOS">안드로이드</option>
									<option value="IOS">아이폰</option>
								</select>
								<div class="radio_box_wrap" id="area_depth">
								</div>
							</td>
						</tr>
						<tr>
							<th>단말기명</th>
							<td>
								<input type="text" class="w_input1" value="" name="device_name" id="phone" placeholder="">
							</td>
						</tr>
						<tr>
							<th>메인등록</th>
							<td>
								<div class="label_box1_wrap" id="main_tab">
									<div class="label_box1"><input type="radio" name="main_use" id="check_1" value="Y" checked=""><label for="check_1">사용</label></div>
									<div class="label_box1"><input type="radio" name="main_use" id="check_2" value="N"><label for="check_2">사용안함</label></div>
								</div>
							</td>
						</tr>
						<tr>
							<th>제품정보</th>
							<td>
								<div class="label_box1">
									<label for="device_type">규격</label>&nbsp;<input type="text" name="device_type" class="w_input1" id="device_type" />
									<label for="device_weight">무게</label>&nbsp;<input type="text" name="device_weight" id="device_weight" class="w_input1" />
									<label for="device_size">크기</label>&nbsp;<input type="text" name="device_size" id="device_size" class="w_input1" />
								</div><br>
								<div class="label_box1">
									<label for="device_ram">RAM</label>&nbsp;<input type="text" name="device_ram" id="device_ram" class="w_input1" />
									<label for="device_inmemory">내장메모리</label>&nbsp;<input type="text" name="device_inmemory" id="device_inmemory" class="w_input1" />
									<label for="device_os">운영체제</label>&nbsp;<input type="text" name="device_os" id="device_os" class="w_input1" />
									<label for="device_cpu">CPU</label>&nbsp;<input type="text" name="device_cpu" id="device_cpu" class="w_input1" />
								</div><br>
								<div class="label_box1">
									<label for="device_screen">화면크기</label>&nbsp;<input type="text" name="device_screen" id="device_screen" class="w_input1" />
									<label for="device_pixcel">해상도</label>&nbsp;<input type="text" name="device_pixcel" id="device_pixcel" class="w_input1" />
									<label for="device_display">디스플레이타입</label>&nbsp;<input type="text" name="device_display" id="device_display" class="w_input1" />
								</div><br>
								<div class="label_box1">
									<label for="device_bettery">베터리</label>&nbsp;<input type="text" name="device_bettery" id="device_bettery" class="w_input1" />
								</div><br>
								<div class="label_box1">
									<label for="device_frontcamera">전면카메라화소</label>&nbsp;<input type="text" name="device_frontcamera" id="device_frontcamera" class="w_input1" />
									<label for="device_backcamera">후면카메라화소</label>&nbsp;<input type="text" name="device_backcamera" id="device_backcamera" class="w_input1" />
								</div><br>
								<div class="label_box1">
									<label for="device_etc">부가기능</label>&nbsp;<input type="text" name="device_etc" id="device_etc" class="w_input1" />
									<label for="device_network">무선방식</label>&nbsp;<input type="text" name="device_network" id="device_network" class="w_input1" />
								</div>
							</td>
						</tr>
						<tr>
							<th>첨부파일</th>
							<td>
								<div class="filebox">
									<input class="upload_name w_input1" value="" name="" placeholder="" disabled="disabled" />
									<label for="tb_file" class="bt_3">찾아보기</label>(최적 사이즈 : 210 x 260)
									<input type="file" class="upload_hidden" value="" name="device_img" placeholder="" id="tb_file"/>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="bt_wrap1">
				<div class="right_box">
					<button type="button" class="bt_1" onclick="deviceFrm(document.deviceForm);">저장</button>
					<a href="s1.php" class="bt_1">목록</a>
				</div>
			</div>
		</form>
	</section>
	<!-- END contents -->
</div>
<script>
function deviceFrm(Frm){
	if(Frm.device_name.value.trim() == ''){
		alert("단말기명은 필수로 등록해주세요");
		Frm.device_name.focus();
		return false;
	}

	if(Frm.device_img.value.trim() == ''){
		alert("첨부파일을 등록해 주세요.");
		return false;
	}

	if(confirm("해당 정보로 단말기를 저장하시겠습니까?")){
		Frm.action="/lib/admin_device_update.php";
		Frm.submit();
	}else{
		return false;
	}
	
}
</script>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
</body>
</html>