<?
$w_http_host = $_SERVER['HTTP_HOST'];
$w_request_uri = $_SERVER['REQUEST_URI'];
$w_file_name = basename($_SERVER['PHP_SELF']);
$w_sub_name = explode('/',$w_request_uri);
$w_index = true;


if(isset($w_sub_name[3])){
	$w_index = false;
	$w_b_num = explode('.',$w_file_name);
	$w_b_num = explode('s',$w_b_num[0]);
	$w_b_num = $w_b_num[1];

	switch($w_sub_name[3]){
		case "s1" : 
			$w_a_num = 1; 
			$w_s_title_1="사용자회원관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="사용자회원관리"; break;
			}
		break;

		case "s2" : 
			$w_a_num = 2; 
			$w_s_title_1="관리자회원관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="관리자회원관리"; break;
			}
		break;

		case "s3" : 
			$w_a_num = 3; 
			$w_s_title_1="테스트베드예약관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="테스트베드예약관리"; break;
			}
		break;

		case "s4" : 
			$w_a_num = 4; 
			$w_s_title_1="기기관리";
			switch($w_b_num){
				case "1" : $w_s_title_2="기기관리"; break;
			}
		break;

		case "s5" : 
			$w_a_num = 5; 
			$w_s_title_1="공지사항";
			switch($w_b_num){
				case "1" : $w_s_title_2="공지사항"; break;
			}
		break;
	}
	if($w_a_num){
		$w_a_num = $w_a_num-1;
	}
	$w_b_num = $w_b_num-1;
}
?>