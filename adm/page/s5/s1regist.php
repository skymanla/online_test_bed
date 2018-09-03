<?php
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");
$mode = isset($_GET['mode']) ? $_GET['mode']: 'W';
?>
    <script type="text/javascript" src="/lib/smarteditor2-2.8.2.4/js/HuskyEZCreator.js?v=testbed" charset="utf-8"></script>      
    <form name="frm" action="/lib/admin_notice_update.php" method="post" enctype="multipart/form-data" onsubmit="return noticefrm(this);return false">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
	<section id="contents">
		<div class="headgroup1">
			<h2>공지사항</h2>
		</div>
		<div class="table_wrap1 line">
			<table>
				<caption>공지사항</caption>
				<colgroup>
					<col width="150">
					<col width="">
				</colgroup>
				<tbody>
					<tr>
						<th>제목</th>
						<td>
							<input type="text" name="n_title" class="w_input2" value="" id="tit" placeholder="">
						</td>
					</tr>
					<tr>
						<th>내용</th>
						<td class="con_editor1">
							<textarea name="n_content" class="w_input1" id="n_content" cols="30" rows="10" style="height: 200px;"></textarea>
						</td>
					</tr>
					<tr>
						<th>첨부파일</th>
						<td>
							<div class="filebox">
								<input class="upload_name w_input1" value="" name="" placeholder="" disabled="disabled" />
								<label for="tb_file" class="bt_3">찾아보기</label>
								<input type="file" name="n_filename_ori" class="upload_hidden" value="" name="" placeholder="" id="tb_file"/>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="bt_wrap1">
			<div class="right_box">
				<button type="button" class="bt_1" onclick="noticefrm(document.frm);">저장</button>
				<a href="s1.php" class="bt_1">목록</a>
			</div>
		</div>
	</section>
    </form>
	<!-- END contents -->
</div>
<!-- END warp -->
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script>
    
    ////Smart Editor Part
    //
   var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
	    oAppRef: oEditors,
	    elPlaceHolder: "n_content",
	    sSkinURI: "/lib/smarteditor2-2.8.2.4/SmartEditor2Skin.html",
	    fCreator: "createSEditor2",
	    htParams : { 
	    	bSkipXssFilter : true
	    }
	});
        
    function noticefrm(frm){
        var n_title = frm.n_title.value;
        var n_content = frm.n_content.value;
        var n_filename_ori = frm.n_filename_ori.value;
         oEditors.getById["n_content"].exec("UPDATE_CONTENTS_FIELD", []);
       
        var isok = 1;
        if(n_title == ''){
            alert('제목을 입력해주십시오.');
            frm.n_title.focus();
            isok = 0;
            return false;
        }
//        if(n_content == '' || n_content == "<P>&nbsp;</P>"){
//            alert('내용을 입력해주십시오.');
//            frm.n_content.focus();
//            isok = 0;
//            return false;
//        }
        if(isok == 1 && confirm('공지사항을 등록하시겠습니까?') == true){
            frm.submit();
        }
        
    }

    
    
</script>
</body>
</html>