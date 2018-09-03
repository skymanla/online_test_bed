<?
/*
Ryan skymanla
device booking system
*/
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
/*if(empty($_SESSION['email'])){
	go_href("예약은 승인된 회원만 가능합니다.\\n로그인해주세요.", "/page/member/login.php" , "go");
	exit;
}*/
$year = date("Y");
$month = date("m");
$day = date("d");
?>
		<div class="s4_sec">
			<h3>테스트베드 예약현황</h3>
			<!-- STR.calendar_wrap -->
			<div class="s4_sec_top">
				<div class="calendar_wrap calendar_wrap2 calendar_wrap1">
					
				</div>
				<!-- END.calendar_wrap -->

				<!-- STR.chose_wrap2 -->
				<div class="chose_wrap2">
					<table class="c_table3">
						<caption>테스트베드 예약현황</caption>
						<colgroup>
							<col width="205px" />
							<col width="" />
						</colgroup>
						<tbody>
							<tr>
								<td>
									<label for="phone_os">분류</label>
								</td>
								<td>
									<div class="table_wrap">
										<div class="">
											<select name="phone_os" title="" id="phone_os" onchange="os_type(this, '')">
												<option value="" selected="selected">선택</option>
												<option value="iOS">IOS</option>
												<option value="Android">안드로이드</option>
											</select>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<label for="phone">테스트베드 분류</label>
								</td>
								<td>
									<div class="table_wrap phone_area" >
										
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="btn_sch_rsvd">
						<input type="hidden" name="h_year" />
						<input type="hidden" name="h_month" />
						<input type="hidden" name="h_day" />
						<button type="button" class="btn_sch" onclick="booking_search();">검색</button>
						<button type="button" class="btn_rsvd" onclick="booking_mv_page();">이 날짜로 예약하기</button>
					</div>
				</div>
				<!-- END.chose_wrap2 -->
			</div>
			<div class="rsvdtime_wrap">
				
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
<script>
$(function(){
	ryan_calendar('<?=$year?>', '<?=$month?>', '<?=$day?>');
});

function booking_search(){
	if($('select[name=phone_os]').val() == ''){
		alert("분류를 선택해 주세요.");
		return false;
	}

	var search_Year = $('input[name=h_year]').val();
	var search_Month = $('input[name=h_month]').val();
	var search_Day = $('input[name=h_day]').val();
	var device = $('select[name=phone]').val();

	if(device.trim() == ""){
		alert("디바이스를 선택해 주세요.");
		return false;
	}

	$.ajax({
		type : "POST",
		data : {"se_year" : search_Year, "se_month" : search_Month, "se_day" : search_Day, "device" : device},
		url : "/common/ajax/booking_time.php",
		success : function(result){
			$('.rsvdtime_wrap').html(result);
		}
	});
}

function booking_mv_page(){
	var year = $('input[name=h_year]').val();
	var month = $('input[name=h_month]').val();
	var day = $('input[name=h_day]').val();

	var now_date = getTimeStamp('');
	var select_date = getTimeStamp(year+"-"+month+"-"+day);	
	if(select_date < now_date){
		alert("오늘 이전 날짜는 예약이 불가능합니다.");
		return false;
	}
	location.href="/page/s3/s1.php?year="+year+"&month="+month+"&day="+day;
}

function getTimeStamp(date) {
	if(date == ''){
		var d = new Date();
	}else{
		var d = new Date(date);
	}
	var s =	leadingZeros(d.getFullYear(), 4) + '-' +leadingZeros(d.getMonth() + 1, 2) + '-' +leadingZeros(d.getDate(), 2);

    /*leadingZeros(d.getHours(), 2) + ':' +
    leadingZeros(d.getMinutes(), 2) + ':' +
    leadingZeros(d.getSeconds(), 2);*/

	return s;
}

function leadingZeros(n, digits) {
	var zero = '';
	n = n.toString();

	if (n.length < digits) {
		for (i = 0; i < digits - n.length; i++){
			zero += '0';
		}
	}
	return zero + n;
}

</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>