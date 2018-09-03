$(function(){
	bnrslide(); // bnrslide
	deviceslide(); // deviceslide
})

/* bnrslide */
function bnrslide(){
	$('.bnr_wrap').bxSlider({
		auto: true,
		speed: 300,
		pagerType: 'short',
		infiniteLoop: true,
	});
}

/* deviceslide */
function deviceslide(){
	var slickSlide = $('.device_inner'); // 슬라이드 할 부모 클래스명
	slickSlide.slick({
		autoplay:true, //오토
		slidesToShow: 5, //보이는양
		slidesToScroll: 1,
		autoplaySpeed: 3000, //스피드
		infinite: true, //loop기능
		nextArrow: '.arr_next', //버튼
		prevArrow: '.arr_prev', //버튼
		dots: false,
		pauseOnHover: true,//hover했을때 멈추는 기능 해제
		draggable: true, //스와이프기능 해제
	});
}
