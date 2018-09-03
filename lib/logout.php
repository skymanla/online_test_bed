<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();

session_destroy();
unset($_SESSION);

go_href("", "/", "nomsg");
?>