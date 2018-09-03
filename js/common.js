$(function(){
	filename() //첨부파일
	daychose() //달력 날자 선택
	goTop() //맨위로
})


// 첨부파일
function filename(){
	var fileTarget = $('.filebox .upload_hidden');

	fileTarget.on('change',function(){
		if(window.FileReader){
			var filename = $(this)[0].files[0].name;
		}
		else{
			var filename = $(this).val().split('/').pop().split('\\').pop();
		}
		$(this).siblings('.upload_name').val(filename);
	});
}

// 달력 날자 선택
function daychose(){
	$('.days li').on('click',function(){
		$(this).addClass('active').siblings().removeClass('active')
	})
}

function goTop(){
	$('.top_btn').on('click',function(){
		$('body, html').stop().animate({scrollTop:0},300);
	});
}

function email_check(getData){
	var exptext = /^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/;
	if(exptext.test(getData) == false){
		alert("이메일 형식이 아닙니다.");
		return;
	}
}

function id_check(getData){
	$.ajax({
		type : "GET",
		dataType : "json",
		data : {"regist_mod" : "join", "regist_id" : getData},
		url : "/common/ajax/register_ajax.php",
		success : function(result){
			if(result.code == false){
				alert("이미 가입된 이메일입니다.");
				return;
			}
		}, error : function(){
			console.log('errrrr');
			return;
		}
	});
}

function join_register(Frm){
	//validata
	var join_flag = false;
	//login id check
	if(Frm.email.value.trim() != ''){
		var check_email = email_check(Frm.email.value);
		if(check_email == false){
			join_flag = false;
			Frm.email.focus();
			return;
		}

		//var check_id = id_check(Frm.email.value);
	}else{
		join_flag = false;
		alert("로그인 이메일을 입력해주세요.");
		Frm.email.focus();
		return;
	}

	if(Frm.tb_pw.value.trim() == ''){
		join_flag = false;
		alert("비밀번호를 입력해주세요.");
		Frm.tb_pw.focus();
		return;
	}

	if(Frm.tb_pw2.value.trim() == ''){
		join_flag = false;
		alert("비밀번호를 확인해 주세요.");
		Frm.tb_pw2.focus();
		return;
	}

	if(Frm.tb_pw.value != Frm.tb_pw2.value){
		join_flag = false;
		alert("비밀번호가 다릅니다.\n확인 해주세요.");
		Frm.tb_pw.focus();
		return;
	}

	if(Frm.tb_name.value.trim() == ''){
		join_flag = false;
		alert("이름을 입력해 주세요.");
		Frm.tb_name.focus();
		return;
	}

	if(Frm.tb_num.value.trim() == ''){
		join_flag = false;
		alert("휴대폰 번호를 입력해 주세요.");
		Frm.tb_num.focus();
		return;
	}

	if(Frm.tb_nickname.value.trim() == ''){
		join_flag = false;
		alert("닉네임을 입력해 주세요.");
		Frm.tb_nickname.focus();
		return;
	}

	if(Frm.box_navi.value.trim() == ''){
		join_flag = false;
		alert("첨부파일을 등록해 주세요.");
		return;
	}

	join_flag = true;
	
	if(join_flag == true){
		Frm.action = "/lib/register_join.php";
		Frm.submit();
	}else{
		return;
	}
}

function login_chk(Frm){
	if(Frm.email.value.trim() == ''){
		alert('이메일을 입력해 주세요.');
		Frm.email.focus();
		return;
	}
	if(Frm.pw.value.trim() == ''){
		alert("비밀번호를 입력해 주세요.");
		Frm.pw.focus()
		return;
	}

	Frm.action="/lib/login_chk.php";
	//Frm.submit();
}

//ajax calendar module
function ryan_calendar(r_year, r_month, r_day){
	var current_year = new Date().getFullYear();
	var current_month = new Date().getMonth()+1;
	var date_flag = true;
	if(current_month < 10){
		current_month = '0'+current_month;
	}
	$.ajax({
		type : "POST",
		data : {ryan_year : r_year, ryan_month : r_month, ryan_day : r_day},
		//cache : false,Math.random()
		url : "/common/ajax/calendar.lib.php",
		success : function(result){
			//$('.calendar_wrap1').html(result);
			$('.calendar_wrap1').empty().append(result);
			if( (current_year != Number(r_year)) ){
				var date_flag = false;
			}

			if(current_month != r_month){
				var date_flag = false;
			}
			if(date_flag == false){
				$('input[name=h_year]').val('');
				$('input[name=h_month]').val('');
				$('input[name=h_day]').val('');
			}
		}, error : function(){
			console.log('errrr');
		}
	});
}

//분류 선택
function os_type(getVal, getDevice){
	if(getVal.value == ""){
		$('.phone_area').empty();
	}else{
		$.ajax({
			type : "POST",
			data : {"os_type" : getVal.value, "os_device" : getDevice},
			url  : "/lib/device_list_curl.php",
			success : function(result){
				//console.log(result);
				$('.phone_area').empty().append(result);
			}
		});
	}
}

function choice_date(se_year, se_month, se_day){
	$('input[name=h_year]').val(se_year);
	$('input[name=h_month]').val(se_month);
	$('input[name=h_day]').val(se_day);
}