<?
$cook = $_REQUEST['popcookie'];

unset($_COOKIE['popupcookie']);
setcookie("popupcookie", "", time() -1 );

if($cook == "1day"){
	//setcookie("popupcookie", "1day", mktime(0, 0, 0, date('m'), date('j'), date('Y')) + 86400);
	setcookie("popupcookie", "1day", mktime(0, 0, 0, date('m'), date('j'), date('Y')) + 86400, "/");
	print_r($_COOKIE);
}
?>