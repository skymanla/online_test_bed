<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php"); ?>
		<div class="register_sec">
			<div class="register_sec_wrap">
				<form method="post" action="" name="joinFrm" enctype="multipart/form-data" onsubmit="return join_register(this);return false;">
					<fieldset>
						<legend>회원가입</legend>
						<div class="register_txt">
							<h4>회원가입</h4>
							<span>이메일 회원가입</span>
							<div>
								<label for="tb_email">로그인 이메일 입력</label>
								<input type="text" class="" value="" name="email" placeholder="" id="tb_email" autocomplete="off" />
							</div>
							<div>
								<label for="tb_pw">비밀번호 입력</label>
								<input type="password" class="" value="" name="pw" placeholder="" id="tb_pw"/>
							</div>
							<div>
								<label for="tb_pw2">비밀번호 확인</label>
								<input type="password" class="" value="" name="pw2" placeholder="" id="tb_pw2"/>
							</div>
							<div>
								<label for="tb_name">이름 입력</label>
								<input type="text" class="" value="" name="name" placeholder="" id="tb_name"  autocomplete="off"/>
							</div>
							<div>
								<label for="tb_num">휴대폰 번호 입력</label>
								<input type="tel" class="" value="" name="num" placeholder="01011112222" id="tb_num" autocomplete="off"/>
							</div>
							<div>
								<label for="tb_nickname">닉네임 입력</label>
								<input type="text" class="" value="" name="nickname" placeholder="" id="tb_nickname" autocomplete="off"/>
							</div>
							<div class="filebox">
								<p>첨부파일</p>
								<input class="upload_name" value="" name="" placeholder="" disabled="disabled" />
								<label for="tb_file">찾아보기</label>
								<input type="file" name="box_navi" id="tb_file"/><br />
							</div>
							<ul class="register_desc">
								<li>필수등록</li>
								<li>기업은 사업자등록증, 개인은 소개하는 콘텐츠 등록하시기 바랍니다.</li>
							</ul>
						</div>
					</fieldset>
				</form>
				<div class="register_btn">
					<a href="login.php" class="btn_cancel">취소</a>
					<!-- <a href="register_complete.php" class="btn_complete">가입완료</a> -->
					<a href="javascript:join_register(document.joinFrm);" class="btn_complete">가입완료</a>
				</div>
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
		<script>
			$(document).ready(function(){
				
				var fileTarget = $('.filebox #tb_file');
				fileTarget.on('change', function(){ // 값이 변경되면 
					if(window.FileReader){ // modern browser 
						var filename = $(this)[0].files[0].name;
					} else { // old IE 
						var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출 
					} 

					// 추출한 파일명 삽입 
					$(this).siblings('.upload_name').val(filename);
				});
			});

			
		</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>