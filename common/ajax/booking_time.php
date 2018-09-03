<?php
/* Ryan skymanla 
예약 현황 가져오기
*/
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");

$year = $_REQUEST['se_year'];
$month = $_REQUEST['se_month'];
$day = $_REQUEST['se_day'];
$date = $year."-".$month."-".$day;

$dvseq = $_REQUEST['device'];

$sql = " select booking_start_time, booking_end_time from tbl_device_booking where booking_dvseq='".$dvseq."' and booking_date='".$date."' and booking_accept='Y'";
$query = $db->query($sql);

foreach($query as $key => $time_list){
	$start_time_arr = explode(":", $time_list['booking_start_time']);
	$start_time_sp = sprintf("%01d", $start_time_arr[0]);

	$end_time_arr = explode(":", $time_list['booking_end_time']);
	$end_time_sp = sprintf("%01d", $end_time_arr[0])+1;

	$rev = '';
	for($i=$start_time_sp; $i<$end_time_sp;$i++){
		/*if($i == $end_time_sp-1){
			$rev .= sprintf("%02d", $i);
		}else{
			$rev .= sprintf("%02d", $i)."||";
		}*/
		//$ret[] = $rev = sprintf("%02d", $i);
		$ret[] = sprintf("%02d", $i);
	}
}
?>

<!-- 00:00 ~ 23:00 -->
<!-- red = span, blue no span -->
<?
for($i=0;$i<24;$i++){
	$t = sprintf("%02d", $i);
?>
<div>
	<p><?=$t?>:00</p>
	<p>
		<? if(in_array($t, $ret)){ ?>
		<span>신청불가</span>
		<? }else{ ?>
		신청가능
		<? } ?>
	</p>
</div>
<? } ?>

<? exit; ?>
