<?php
/*
Ryan skymanla
device bookking system : add booking
*/
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");

$se_year = $_REQUEST['se_year'];
$se_month = $_REQUEST['se_month'];
$se_day = $_REQUEST['se_day'];

$se_stime = $_REQUEST['se_stime'];
$se_etime = $_REQUEST['se_etime'];

$booking_date = $se_year."-".$se_month."-".$se_day;
$booking_sdate = $se_year."-".$se_month."-".$se_day." ".$se_stime;
$booking_edate = $se_year."-".$se_month."-".$se_day." ".$se_etime;

$seq = $_REQUEST['seq'];

$version = $_REQUEST['version'];

$seq_name = $_REQUEST['seq_name'];
$seq_type = $_REQUEST['seq_type'];

//if($seq_type == "Android") $seq_type = "AOS";

$select_common = " a.bseq, a.booking_date, a.booking_start_time, a.booking_end_time, a.booking_mseq,
				b.dvseq, b.dv_name, b.dv_system ";
$from_common = " tbl_device_booking a";

//a.booking_date='".$booking_date."' and booking_start_time='".$se_stime."'	 and
$where_common = " a.booking_dvseq='".$seq."' and a.booking_date='".$booking_date."' and a.booking_accept='Y' and 
				 ( date_format(convert(concat(a.booking_date,' ',a.booking_start_time), datetime), '%Y-%m-%d %H:%i') between '".$booking_sdate."' and '".$booking_edate."'
				 or
				 date_format(convert(concat(a.booking_date,' ',a.booking_end_time), datetime), '%Y-%m-%d %H:%i') between '".$booking_sdate."' and '".$booking_edate."'
				)";
$sql = "select count(a.bseq) as cnt from ".$from_common." where ".$where_common."";
$q = $db->query($sql);
$r = $q->fetch();
if($r['cnt'] > 0){//예약이 있는 경우임.
	echo "99";
}else{
	//device info	
?>
<div class="chosebox" style="height:auto !important">
	<input type="hidden" name="choose_year" value="<?=$se_year?>" />
	<input type="hidden" name="choose_month" value="<?=$se_month?>" />
	<input type="hidden" name="choose_day" value="<?=$se_day?>" />
	<input type="hidden" name="choose_stime" value="<?=$se_stime?>" />
	<input type="hidden" name="choose_etime" value="<?=$se_etime?>" />
	<input type="hidden" name="choose_seq" value="<?=$seq?>" />
	<input type="hidden" name="choose_seq_version" value="<?=$version?>" />
	<input type="hidden" name="choose_seq_name" value="<?=$seq_name?>" />
	<input type="hidden" name="choose_seq_type" value="<?=$seq_type?>" />
	<strong><?=$se_year?>.<?=$se_month?>.<?=$se_day?></strong>
	<span><?=$se_stime?>~<?=$se_etime?></span>
	<!--<span>[<?=$seq_type?>]<?=$seq_name?></span>-->
	<span><?=$seq_name?></span>
	<span><?=$version?></span>
	<button type="button" class="btn_close" onclick="close_booking(this)"><i>닫기</i></button>
</div>

<?
}
exit;
?>

<div class="chosebox">
	<strong>2018.08.16</strong>
	<span>08:00~15:00</span>
	<span>[안드로이드]갤럭시9</span>
	<button type="button" class="btn_close"><i>닫기</i></button>
</div>
