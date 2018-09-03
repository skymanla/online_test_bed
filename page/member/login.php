<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php"); ?>
		<div class="login_sec">
			<form method="post" name="loginFrm" onsubmit="return login_chk(this);return false;">
				<fieldset>
					<legend>로그인</legend>
					<div class="login_txt">
						<h4>로그인</h4>
						<div>
							<label for="tb_email">이메일</label>
							<input type="text" class="" value="" name="email" placeholder="" id="tb_email" autocomplete="off"/>
						</div>
						<div>
							<label for="tb_pw">비밀번호</label>
							<input type="password" class="" value="" name="pw" placeholder="" id="tb_pw"/>
						</div>
						<ul>
							<li>아직 가입 전 이신가요?<a href="register_from.php">회원가입</a></li>
							<li><a href="lost.php">계정을 잊으셧나요?</a></li>
						</ul>
					</div>
					<input type="submit" class="btn_sbt" value="접속" name="join" id="tb_sbt"/>
				</fieldset>
			</form>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
	</div>
	<!-- END #contents-->
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>
