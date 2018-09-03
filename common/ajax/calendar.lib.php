<?php
/*
Ryan skymanla
make calendar
v1
 */
$year = ($_REQUEST['ryan_year']=='' ? date('Y') : $_REQUEST['ryan_year']);
$month = ($_REQUEST['ryan_month']=='' ? date('m') : $_REQUEST['ryan_month']);
$day = ($_REQUEST['ryan_day']=='' ? date('d') : $_REQUEST['ryan_day']);


$now_time = '';
$now_date = date('Y.m', strtotime($year."-".$month));//달력 년월 생성
$now_time = mktime(0, 0, 0, $month, 1, $year);
$now_end_day = date('t', $now_time);//현재 달력의 마지막 날짜
$now_start_yoil = date('w', $now_time);//달의 첫날 요일(0:sun, 1:mon, 2:tue, 3:wen, 4:thu, 5:fri, 6:sat)

//click action
$current_date = date('Y.m', time());
if($now_date != $current_date){
	$click_flag  = false;
}else{
	$click_flag  = true;
}

//prev date
$prev_date = date('Y.m', strtotime(" -1 month ", $now_time));
$prev_date_arr = explode(".", $prev_date);
$prev_year = $prev_date_arr['0'];
$prev_month = $prev_date_arr['1'];
$prev_time = mktime(0, 0, 0, $prev_month, 1, $prev_year);
$prev_end_day = date('t', $prev_time);

//next date
$next_date = date('Y.m', strtotime(" +1 month ", $now_time));
$next_date_arr = explode(".", $next_date);
$next_year = $next_date_arr['0'];
$next_month = $next_date_arr['1'];
$next_time = mktime(0, 0, 0, $next_month, 1, $next_year);
$next_end_day = date('t', $next_time);
?>

<div class="month">
	<button type="button" class="calendar_prev" onclick="ryan_calendar('<?=$prev_year?>','<?=$prev_month?>', '');"><i>이전</i></button>
	<span><?=$now_date?></span>
	<button type="button" class="calendar_next" onclick="ryan_calendar('<?=$next_year?>','<?=$next_month?>', '');"><i>다음</i></button>
</div>
<ul class="weekdays">
	<li>SUN</li>
	<li>MON</li>
	<li>TUE</li>
	<li>WED</li>
	<li>THU</li>
	<li>FRI</li>
	<li>SAT</li>
</ul>
<ul class="days">
	<?
	$prev_day_cnt = 0;
	for($j=0; $j<$now_start_yoil+1; $j++){
		if($now_start_yoil == "0"){
			//pass
			break;
		}else if($now_start_yoil > 0){
			//일요일이 아니면 앞에가 빈다 그만큼 채워준다
			$prev_day = $prev_end_day-$now_start_yoil+$j+1;
			$prev_day_sp = sprintf("%02d", $prev_day);
			if($prev_day > $prev_end_day) break;
			$prev_day_cnt++;
	?>
	<li class="m_next"><a href="javascript:choice_date('<?=$prev_year?>', '<?=$prev_month?>', '<?=$prev_day_sp?>');"><?=$prev_day?></a></li>
	<?
		}
	}
	for($i=1; $i<$now_end_day+1; $i++){
		$click_class = "";
		/*if($click_flag == true){
			if($i == $day){
				$click_class = "active";
			}
		}*/
		if($i == $day){
			$click_class = "active";
		}
		$cday = sprintf("%02d", $i);
	?>
	<li class="<?=$click_class?>"><a href="javascript:choice_date('<?=$year?>', '<?=$month?>', '<?=$cday?>');"><?=$i?></a></li>
	<?
	}
	//총 35개가 드가니까 짐까지 채워준거에서 남은 양만큼 채워보쟈꾸나
	//mother fu.....아 어머니
	$next_end_day_cnt = $now_end_day + $prev_day_cnt;
	$next_day = "1";
	for($k = $next_end_day_cnt; $k < 35; $k++){
		$next_day_sp = sprintf("%02d", $next_day);
	?>

	<li class="m_next"><a href="javascript:choice_date('<?=$next_year?>', '<?=$next_month?>', '<?=$next_day_sp?>')"><?=$next_day?></a></li>
	<?
		$next_day++;
	}
	?>
	<!--<li class="active"><a href="javascript:void(0);">18</a></li>
	<li class="rsvd"><a href="javascript:void(0);">24</a></li>
	<li class="m_next"><a href="javascript:void(0);">4</a></li>-->
</ul>
<!--<div class="m_desc">
	<span class="active_c">선택한 날짜</span>
	<span class="rsvd_c">예약이 되어 있는 날</span>
</div>-->

<script>
$(function(){
	daychoose() //달력 날자 선택
	<? if($click_flag == true){ ?>
	choice_date("<?=date('Y')?>", "<?=date('m')?>", "<?=date('j')?>");
	<? }else{ } ?>
});
// 달력 날자 선택
function daychoose(){
	$('.days li').on('click',function(){
		$(this).addClass('active').siblings().removeClass('active')
	})
}
</script>
<!-- END.calendar_wrap -->
<?
$now_date = '';
$prev_date = '';
$next_date = '';
exit;
?>
