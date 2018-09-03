<?php
/*
Ryan skymanla
select os type -> select option box
 */
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");

$tbl_info = "tbl_device";
$system = $_REQUEST['os_type'];
$sql = "select dvseq, dv_name from $tbl_info where dv_system='$system' order by dvseq asc";
$q = $db->query($sql);

$rownct = $q->rowCount();
?>

<div>
	<select name="phone" title="" id="phone">
		<option value="" selected="selected">선택</option>
		<? 
		if($rowcnt == "0"){
			//pass
		}else{
			foreach($q as $key => $row){
		?>
		<option value="<?=$row['dvseq']?>"><?=$row['dv_name']?></option>
		<? 
			}
		}
		?>
	</select>
</div>
<? exit; ?>

<!--
	<option value="iphone8">아이폰8</option>
		<option value="iphoneX">아이폰X</option>
		<option value="galaxy9">갤럭시9</option>
		<option value="galaxy note8">갤럭시 노트8</option>
-->