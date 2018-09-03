$(function(){
	$('.gnb').niceScroll();
	$('#lng_wrap').niceScroll();
	filebox();
});

function filebox(){
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