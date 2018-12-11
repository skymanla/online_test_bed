<?
define(__HOST__, "http://".$_SERVER['HTTP_HOST']);
?>
<html>
	<head>
		<title>온라인 테스트베드 공지</title>
		<script type="text/javascript" src="<?=__HOST__?>/js/jquery-1.12.4.min.js"></script>
	</head>
	<body>
		<div style="position:relative;width:600px;margin:0px auto;background-image:url(<?=__HOST__?>/img/test/email_title.jpg);background-repeat: no-repeat;">
			<div style="position:relative;height:139px;"></div>
			<div style="position:relative;border:1px solid #cccccc;width:598px;">
				<!-- <p style="font-weight:bold">
					*사용시 유의사항<br>
					<ol>
						<li>신청하신 시간 안에서 사용이 가능합니다.</li>
						<li>신청하신 시간이 지나거나 디바이스를 종료하시면 설치했던 앱들은 삭제가 됩니다.</li>
						<li>
							<span style="color:red">다음 사람을 위해 설정에서 아래의 사항은 지켜주시기 바랍니다.</span><br>
							<span style="color:blue">
							- 안드로이드 : 개발자 옵션 > USB 디버깅 해제 금지<br>
							- 아이폰 : 제어센터 > 화면기록 해제, 재부팅 금지<br>
							- 디바이스 비밀번호 설정<br>
							- OS 업데이트 금지<br>
							- google 계정 및 apple 계정 설정 금지<br>
							- 제공되는 공유 단말정보를 사용해서 특정 서비스 가입 금지<br>
							- 기타 불법적인 앱 설치 및 사용 금지(테스트 목적과 무관한 행위 금지)
							</span>
						</li>						
						<li>테스트베드 사용 임시 아이디 및 패스워드는 홈페이지의<br> <span style="color:blue">"마이페이지->예약내역"</span> 에서 확인 가능합니다.</li>
					</ol>
				</p> -->
				<p style="font-weight:bold">
					*온라인 테스트베드 서비스 종료*<br>
					<ol style="list-style:none;">
						<li>온라인 테스트베드가 서비스를 종료하게 됩니다.</li>
						<li>서비스 종료일 이후 홈페이지 접속 및 이용은 불가능합니다.</li>
						<li>서비스 종료 일시 : <span style="color:red">2018년 12월 15일 자정 이후</span></li>
						<li>이용해 주셔서 감사합니다.</li>												
					</ol>
				</p>
			</div>
			<input type="checkbox" name="pop_cookie" value="1day" />오늘 하루 팝업 열지 않기
		</div>
		<script>
			$(function(){
				$('input[name=pop_cookie]').on("click", function(e){
					$.ajax({
						type : "POST",
						data : {'popcookie' : $('input[name=pop_cookie').val()},
						url : "/common/ajax/popcookie.php",
						success : function(result){
							self.close();
						}, error : function(){
							console.log('ererr');
						}
					});
				});
			});
		</script>
	</body>
</html>