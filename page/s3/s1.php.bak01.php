<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php"); ?>
		<div class="s3_sec">
			<h3>테스트베드 예약</h3>
			<!-- STR.calendar_wrap -->
			<div class="">
				<div class="calendar_wrap calendar_wrap1">
					<div class="month">
						<button type="button" class="calendar_prev"><i>이전</i></button>
						<span>2018.07</span>
						<button type="button" class="calendar_next"><i>다음</i></button>
					</div>
					<ul class="weekdays">
						<li>SUN</li>
						<li>MON</li>
						<li>TUE</li>
						<li>WED</li>
						<li>THU</li>
						<li>FRI</li>
						<li>SAT</li>
					</ul>
					<ul class="days">
						<li><a href="javascript:void(0);">1</a></li>
						<li><a href="javascript:void(0);">2</a></li>
						<li><a href="javascript:void(0);">3</a></li>
						<li><a href="javascript:void(0);">4</a></li>
						<li><a href="javascript:void(0);">5</a></li>
						<li><a href="javascript:void(0);">6</a></li>
						<li><a href="javascript:void(0);">7</a></li>
						<li><a href="javascript:void(0);">8</a></li>
						<li><a href="javascript:void(0);">9</a></li>
						<li><a href="javascript:void(0);">10</a></li>
						<li><a href="javascript:void(0);">11</a></li>
						<li><a href="javascript:void(0);">12</a></li>
						<li><a href="javascript:void(0);">13</a></li>
						<li><a href="javascript:void(0);">14</a></li>
						<li><a href="javascript:void(0);">15</a></li>
						<li><a href="javascript:void(0);">16</a></li>
						<li><a href="javascript:void(0);">17</a></li>
						<li class="active"><a href="javascript:void(0);">18</a></li>
						<li class="rsvd"><a href="javascript:void(0);">19</a></li>
						<li class="rsvd"><a href="javascript:void(0);">20</a></li>
						<li><a href="javascript:void(0);">21</a></li>
						<li><a href="javascript:void(0);">22</a></li>
						<li class="rsvd"><a href="javascript:void(0);">23</a></li>
						<li class="rsvd"><a href="javascript:void(0);">24</a></li>
						<li><a href="javascript:void(0);">25</a></li>
						<li><a href="javascript:void(0);">26</a></li>
						<li><a href="javascript:void(0);">27</a></li>
						<li><a href="javascript:void(0);">28</a></li>
						<li><a href="javascript:void(0);">29</a></li>
						<li><a href="javascript:void(0);">30</a></li>
						<li><a href="javascript:void(0);">31</a></li>
						<li class="m_next"><a href="javascript:void(0);">1</a></li>
						<li class="m_next"><a href="javascript:void(0);">2</a></li>
						<li class="m_next"><a href="javascript:void(0);">3</a></li>
						<li class="m_next"><a href="javascript:void(0);">4</a></li>
					</ul>
					<div class="m_desc">
						<span class="active_c">선택한 날짜</span>
						<span class="rsvd_c">예약이 되어 있는 날</span>
					</div>
				</div>
				<!-- END.calendar_wrap -->

				<!-- STR.chose_wrap -->
				<div class="chose_wrap">
					<div class="c_top">
						<table class="c_table1">
							<caption>테스트베드 예약</caption>
							<colgroup>
								<col width="205px" />
								<col width="" />
							</colgroup>
							<tbody>
								<tr>
									<td>
										<label for="phone_os">분류</label>
									</td>
									<td>
										<div class="table_wrap">
											<div class="">
												<select name="phone_os" title="" id="phone_os">
													<option value="" selected="selected">선택</option>
													<option value="iso">IOS</option>
													<option value="android">안드로이드</option>
												</select>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="phone">테스트베드 분류</label>
									</td>
									<td>
										<div class="table_wrap">
											<div>
											<select name="phone" title="" id="phone">
												<option value="" selected="selected">선택</option>
												<option value="iphone6s">아이폰6s</option>
												<option value="iphone8">아이폰8</option>
												<option value="iphoneX">아이폰X</option>
												<option value="galaxy9">갤럭시9</option>
												<option value="galaxy note8">갤럭시 노트8</option>
											</select>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="phone_time1">예약 시간</label>
									</td>
									<td>
										<div class="table_wrap">
											<div>
												<select name="phone_time" title="" id="phone_time1" class="tt">
													<option value="" selected="selected">09:00</option>
													<option value="">10:00</option>
													<option value="">11:00</option>
													<option value="">12:00</option>
													<option value="">14:00</option>
													<option value="">15:00</option>
													<option value="">16:00</option>
													<option value="">17:00</option>
													<option value="">18:00</option>
													<option value="">19:00</option>
													<option value="">20:00</option>
													<option value="">21:00</option>
													<option value="">22:00</option>
													<option value="">23:00</option>
													<option value="">24:00</option>
												</select>
											</div>
											<div style="text-align:center;">~</div>
											<div>
												<select name="phone_time" title="" id="phone_time2" class="tt">
													<option value="">09:00</option>
													<option value="" selected="selected">10:00</option>
													<option value="">11:00</option>
													<option value="">12:00</option>
													<option value="">14:00</option>
													<option value="">15:00</option>
													<option value="">16:00</option>
													<option value="">17:00</option>
													<option value="">18:00</option>
													<option value="">19:00</option>
													<option value="">20:00</option>
													<option value="">21:00</option>
													<option value="">22:00</option>
													<option value="">23:00</option>
													<option value="">24:00</option>
												</select>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<button type="button" class="btn_add">추가</button>
					</div>
					<div class="c_bot">
						<table class="c_table2">
							<caption></caption>
							<colgroup>
								<col width="205px" />
								<col width="" />
								<col width="" />
							</colgroup>
							<tbody>
								<tr>
									<td>선택된 테스트베드</td>
									<td colspan="2">
										<div class="chosebox">
											<strong>2018.08.16</strong>
											<span>08:00~15:00</span>
											<span>[안드로이드]갤럭시9</span>
											<button type="button" class="btn_close"><i>닫기</i></button>
										</div>
										<div class="chosebox">
											<strong>2018.08.16</strong>
											<span>08:00~15:00</span>
											<span>[안드로이드]갤럭시9</span>
											<button type="button" class="btn_close"><i>닫기</i></button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END.chose_wrap -->
			</div>

			<div class="btn_sub_reset">
				<div class="">
					<label for="inp_reset">초기화</label>
					<input type="reset" class="" id="inp_reset" value="초기화">
				</div>
				<div class="">
					<label for="inp_sub">신청</label>
					<input type="submit" class="" id="inp_sub" value="신 청">
				</div>
			</div>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>