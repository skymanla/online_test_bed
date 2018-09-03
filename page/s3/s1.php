<?
/*
Ryan skymanla
device booking system
*/
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
if(empty($_SESSION['email'])){
	go_href("예약은 승인된 회원만 가능합니다.\\n로그인해주세요.", "/page/member/login.php" , "go");
	exit;
}
if(isset($_GET['year'])){
	$year = $_GET['year'];
	$month = $_GET['month'];
	$day = $_GET['day'];
}else{	
	$year = date("Y");
	$month = date("m");
	$day = date("d");
}
$getOs_flag = false;
if(isset($_GET['os_type'])){
	$os_type = $_GET['os_type'];
	$os_serial = $_GET['serial'];
	$getOs_flag = true;
}
?>
		<div class="s3_sec">
			<h3>테스트베드 예약</h3>
			<!-- STR.calendar_wrap -->
			<div class="">
				<div class="calendar_wrap calendar_wrap1">
				</div>
				<!-- STR.chose_wrap -->
				<div class="chose_wrap">
					<div class="c_top">
						<table class="c_table1">
							<input type="hidden" name="h_year" />
							<input type="hidden" name="h_month" />
							<input type="hidden" name="h_day" />
							<caption>테스트베드 예약</caption>
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
										<div class="table_wrap phone_area">

										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="phone_time1">예약 시간</label>
									</td>
									<td>
										<div class="table_wrap">
											<div>
												<select name="start_time" title="" id="phone_time1" class="tt">
													<option value="09:00" selected="selected">09:00</option>
													<option value="10:00">10:00</option>
													<option value="11:00">11:00</option>
													<option value="12:00">12:00</option>
													<option value="13:00">13:00</option>
													<option value="14:00">14:00</option>
													<option value="15:00">15:00</option>
													<option value="16:00">16:00</option>
													<option value="17:00">17:00</option>
													<option value="18:00">18:00</option>
													<option value="19:00">19:00</option>
													<option value="20:00">20:00</option>
													<option value="21:00">21:00</option>
													<option value="22:00">22:00</option>
													<option value="23:00">23:00</option>
													<option value="24:00">24:00</option>
												</select>
											</div>
											<div style="text-align:center;">~</div>
											<div>
												<select name="end_time" title="" id="phone_time2" class="tt">
													<option value="09:00">09:00</option>
													<option value="10:00" selected="selected">10:00</option>
													<option value="11:00">11:00</option>
													<option value="12:00">12:00</option>
													<option value="13:00">13:00</option>
													<option value="14:00">14:00</option>
													<option value="15:00">15:00</option>
													<option value="16:00">16:00</option>
													<option value="17:00">17:00</option>
													<option value="18:00">18:00</option>
													<option value="19:00">19:00</option>
													<option value="20:00">20:00</option>
													<option value="21:00">21:00</option>
													<option value="22:00">22:00</option>
													<option value="23:00">23:00</option>
													<option value="24:00">24:00</option>
												</select>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<button type="button" class="btn_add" onclick="booking_deviec()">추가</button>
					</div>
					<form method="post" name="device_booking_Frm" onsubmit="return bookingFrm(this);return;">
						<input type="hidden" name="booking_cnt" value="0" />
						<input type="hidden" name="choose_year_arr" />
						<input type="hidden" name="choose_month_arr" />
						<input type="hidden" name="choose_day_arr" />
						<input type="hidden" name="choose_stime_arr" />
						<input type="hidden" name="choose_etime_arr" />
						<input type="hidden" name="choose_seq_arr" />
						<input type="hidden" name="choose_seq_name_arr" />
						<input type="hidden" name="choose_seq_type_arr" />
						<input type="hidden" name="choose_seq_version_arr" />
						<div class="c_bot">
							<table class="c_table2">
								<caption></caption>
								<colgroup>
									<col width="205px" />
									<col width="" />
									<col width="" />
								</colgroup>
								<tbody>
									<tr>
										<td>선택된 테스트베드</td>
										<td colspan="2" class="booking_area">
											<!--<div class="chosebox">
												<strong>2018.08.16</strong>
												<span>08:00~15:00</span>
												<span>[안드로이드]갤럭시9</span>
												<button type="button" class="btn_close"><i>닫기</i></button>
											</div>
											<div class="chosebox">
												<strong>2018.08.16</strong>
												<span>08:00~15:00</span>
												<span>[안드로이드]갤럭시9</span>
												<button type="button" class="btn_close"><i>닫기</i></button>
											</div>-->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</form>
				</div>
				<!-- END.chose_wrap -->
			</div>

			<div class="btn_sub_reset">
				<div class="">
					<label for="inp_reset">초기화</label>
					<input type="reset" class="" id="inp_reset" onclick="location.href='?'" value="초기화">
				</div>
				<div class="">
					<label for="inp_sub">신청</label>
					<input type="submit" class="" id="inp_sub" onclick="bookingFrm(document.device_booking_Frm);return;"  value="신 청">
				</div>
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
<script>
$(function(){
	ryan_calendar('<?=$year?>', '<?=$month?>', '<?=$day?>');
	<? if($getOs_flag == true){ ?>
	$('#phone_os option[value="<?=$os_type?>"]').attr('selected', 'selected');
	os_type($('#phone_os')[0], "<?=$os_serial?>");
	<? } ?>
});

function booking_deviec(){
	//se_year, se_month, se_day, se_stime, se_etime, seq
	var phone_os = $('select[name=phone_os]').val();
	if(phone_os == ""){
		alert("분류를 선택해 주세요.");
		return;
	}

	//seq array
	var seq = $('select[name=phone]').val();
	var seq_data = new Array();
	seq_data = seq.split("|");
	

	var seq_name = $('select[name=phone] option:checked').text();
	var seq_type = $('select[name=phone_os]').val();
	if(seq == ""){
		alert("디바이스를 선택해 주세요.");
		return;
	}	
	var se_year = $('input[name=h_year]').val();
	var se_month = $('input[name=h_month]').val();
	var se_day = $('input[name=h_day]').val();
	if(se_year =="" && se_month == "" && se_day == ""){
		alert("날짜를 선택해 주세요.");
		return;
	}

	var se_stime = $('select[name=start_time]').val();
	var se_etime = $('select[name=end_time]').val();

	stime_arr = se_stime.split(":");
	etime_arr = se_etime.split(":");

	//오늘 이전 날짜는 예약이 불가능하게
	//var select_date = new Date(se_year+"-"+se_month+"-"+se_day+" "+se_stime);
	
	var select_date = new Date(Number(se_year), Number(se_month)-1, Number(se_day), Number(stime_arr[0]), Number(stime_arr[1]));
	//var select_date = new Date(se_year+"-"+se_month+"-"+se_day+" "+se_stime);
	var now_date = new Date();	
	if(select_date < now_date){
		alert("현재 시각 이전은 예약이 불가능합니다.");
		return;
	}

	
	if(Number(stime_arr['0']) > Number(etime_arr['0'])){
		alert("시작 시간이 종료 시간보다 크면 안됩니다.");
		return;
	}

	if(Number(stime_arr['0']) == Number(etime_arr['0'])){
		alert("시작 시간과 종료 시간이 같습니다.");
		return;
	}

	if(Number(etime_arr['0'])-Number(stime_arr['0']) > 8){
		alert("예약 시간은 8시간을 넘길 수가 없습니다.");
		return;
	}
	$.ajax({
		type : "POST",
		data : {"se_year" : se_year, "se_month" : se_month, "se_day" : se_day, "se_stime" : se_stime, "se_etime" : se_etime, "seq" : seq_data[0], "version" : seq_data[1], "seq_name" : seq_name, "seq_type" : seq_type},
		url : "/common/ajax/device_booking.php",
		success : function(result){
			if(result == "99"){
				alert("현재 예약이 되어있습니다.");
			}else{
				var cnt = $('input[name=booking_cnt]').val();
				if(!$('.booking_area').children().hasClass('chosebox')){
					$('.booking_area').append(result);
					cnt = Number(cnt)+1;
					$('input[name=booking_cnt]').val(cnt);
				}else{
					$('.booking_area > .chosebox:last-child').after(result);
					$('.booking_area > .chosebox:last-child').hide();
					if($('.booking_area > .chosebox').last().index() >= 2){
						$('.booking_area > .chosebox:last-child').css({"margin-top": "5px"});
					}

					var lastId = $('.booking_area > .chosebox').last().index();
					var input_flag = true;
					for(var i=0; i < lastId; i++){
						var prev_sdate = Math.round(new Date($('input[name="choose_year"]').eq(i).val()+"-"+$('input[name=choose_month]').eq(i).val()+"-"+$('input[name=choose_day]').eq(i).val()).getTime() / 1000);
						var now_sdate = Math.round(new Date(se_year+"-"+se_month+"-"+se_day).getTime() / 1000);						

						var pstime_arr =  new Array();
						pstime_arr = $('input[name=choose_stime]').eq(i).val().split(":");

						var petime_arr = new Array();
						petime_arr = $('input[name=choose_etime]').eq(i).val().split(":");

						var sstime_arr = new Array();
						sstime_arr = se_stime.split(":");

						var estime_arr = new Array();
						estime_arr = se_etime.split(":");

						var prev_stime = Math.round(new Date($('input[name=choose_year]').eq(i).val(), Number($('input[name=choose_month]').eq(i).val())-1, $('input[name=choose_day]').eq(i).val(), pstime_arr[0], pstime_arr[1]).getTime() / 1000);

						var now_stime = Math.round(new Date(Number(se_year), Number(se_month)-1, Number(se_day), Number(sstime_arr[0]), Number(sstime_arr[1])).getTime() / 1000);

						var prev_etime = Math.round(new Date($('input[name=choose_year]').eq(i).val(), Number($('input[name=choose_month]').eq(i).val())-1, $('input[name=choose_day]').eq(i).val(), petime_arr[0], petime_arr[1]).getTime() / 1000);
						var now_etime = Math.round(new Date(Number(se_year), Number(se_month)-1, Number(se_day), Number(estime_arr[0]), Number(estime_arr[1])).getTime() / 1000);						
						
						if(prev_sdate == now_sdate){
							if($('input[name=choose_seq]').eq(i).val() == seq_data[0]){//장비가 같다면 시간체크를 하긴 해야겠지								
								console.log(prev_stime);
								console.log(now_stime);
								if( (prev_stime == now_stime) || (prev_etime == now_etime) ){//시작 시간이 같은 경우
									input_flag = false;
									alert("예약시간이 같습니다.");
									break;
								}
								if(prev_stime+prev_etime > now_stime+now_etime){
									input_flag = false;
									alert("예약시간이 이전 신청시간 안에 속합니다.");
									break;
								}
							}else{
								//pass
							}
						}
						/*if($('input[name=choose_seq]').eq(i-1).val() == $('input[name=choose_seq]').eq(i).val()){
							input_flag = false;
							alert("이미 추가하였습니다.");
							break;
						}*/
					}
					if(input_flag == true){
						$('.booking_area > .chosebox:last-child').show();
						cnt = Number(cnt)+1;
						$('input[name=booking_cnt]').val(cnt);
					}else{						
						$('.booking_area > .chosebox:last-child').remove();
						/*if(cnt > 0){
							cnt = Number(cnt)-1;
						$('input[name=booking_cnt]').val(cnt);
						}*/
					}
				}
			}
		}, error : function(){
			console.log('errrr');
		}
	});
}

function close_booking(getVal){
	//getVal.parentNode.remove();
	var node = getVal.parentNode;	
	node.parentNode.removeChild(node);

	var cnt = $('input[name=booking_cnt]').val();
	cnt = Number(cnt)-1;
	$('input[name=booking_cnt]').val(cnt);
}

function bookingFrm(Frm){
	if($('input[name=booking_cnt]').val() == "0"){
		alert("예약을 추가해주세요.");
		return;
	}

	//값 배열처리한거 쑤셔넣기
	var year_arr;
	$("input[name=choose_year]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_year]").eq(i).val();
			$("input[name='choose_year_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_year]").eq(i).val();
			$("input[name='choose_year_arr']").val(year_arr);
		}
	});

	var month_arr;
	$("input[name=choose_month]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_month]").eq(i).val();
			$("input[name='choose_month_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_month]").eq(i).val();
			$("input[name='choose_month_arr']").val(year_arr);
		}
	});

	var day_arr;
	$("input[name=choose_day]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_day]").eq(i).val();
			$("input[name='choose_day_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_day]").eq(i).val();
			$("input[name='choose_day_arr']").val(year_arr);
		}
	});

	var stime_arr;
	$("input[name=choose_stime]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_stime]").eq(i).val();
			$("input[name='choose_stime_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_stime]").eq(i).val();
			$("input[name='choose_stime_arr']").val(year_arr);
		}
	});

	var etime_arr;
	$("input[name=choose_etime]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_etime]").eq(i).val();
			$("input[name='choose_etime_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_etime]").eq(i).val();
			$("input[name='choose_etime_arr']").val(year_arr);
		}
	});

	var seq_arr;
	$("input[name=choose_seq]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_seq]").eq(i).val();
			$("input[name='choose_seq_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_seq]").eq(i).val();
			$("input[name='choose_seq_arr']").val(year_arr);
		}
	});

	var seq_name_arr;
	$("input[name=choose_seq_name]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_seq_name]").eq(i).val();
			$("input[name='choose_seq_name_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_seq_name]").eq(i).val();
			$("input[name='choose_seq_name_arr']").val(year_arr);
		}
	});

	var seq_type_arr;
	$("input[name=choose_seq_type]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_seq_type]").eq(i).val();
			$("input[name='choose_seq_type_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_seq_type]").eq(i).val();
			$("input[name='choose_seq_type_arr']").val(year_arr);
		}
	});

	var seq_version_arr;
	$("input[name=choose_seq_version]").each(function(i){
		if(i == 0){
			year_arr = $("input[name=choose_seq_version]").eq(i).val();
			$("input[name='choose_seq_version_arr']").val(year_arr);
		}else{
			year_arr += "|";
			year_arr += $("input[name=choose_seq_version]").eq(i).val();
			$("input[name='choose_seq_version_arr']").val(year_arr);
		}
	});

	Frm.action="/lib/device_booking_update.php";
	Frm.submit();

}
</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>
