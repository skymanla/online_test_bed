<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();

if($_SESSION['auth_flag'] != "admin"){
    go_href("관리자만 접근 가능합니다.", "/adm/", "go");
    exit;
}


$sql = "delete from tbl_notice where nseq='".$_GET['idx']."'";
$db->query($sql);

go_href("", "/adm/page/s5/s1.php", "nomsg");
?>