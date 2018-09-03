<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php"); ?>
		<div class="lost_sec">
			<div class="lost_wrap">
				<div>
					<h4>계정찾기</h4>
					<div class="lost_txt">
						<!-- 이메일 주소나 휴대폰 번호를 입력하세요 -->
						<label for="tb_email_num">이메일 주소를 입력하세요</label>						
						<input type="text" class="" value="" name="email_num" placeholder="" id="tb_email_num" />
					</div>
				</div>
				<a href="javascript:lost_move();">검색</a>
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
		<script>
			function lost_move(){
				if($.trim($('input[name=email_num]').val()) == '' ){
					alert("이메일을 입력해 주세요.");
					return;
				}else{
					location.href="lost_pw.php?email="+$('input[name=email_num]').val();
				}			
			}
		</script>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>