<?php
include_once($_SERVER['DOCUMENT_ROOT']."/adm/_inc/adm_header.php");
$idx = $_GET['idx'];
$sql = "select * from tbl_notice where nseq='".$idx."'";
$query = $db->query($sql);
if($query->rowCount() == false){
	header("HTTP/1.1 400 Bad Request");
	go_href("잘못된 접근입니다.", "/adm/page/s5.s1.php", "go");
	exit;
}else{
	$data = $query->fetch();
}
?>
<script type="text/javascript" src="/lib/smarteditor2-2.8.2.4/js/HuskyEZCreator.js?v=testbed" charset="utf-8"></script>      
	<!-- STR contents -->
	<section id="contents">
		<form name="frm" action="/lib/admin_notice_update.php" method="post" enctype="multipart/form-data" onsubmit="return noticefrm(this);return false">
			<input type="hidden" name="mode" />
			<input type="hidden" name="idx" value="<?=$idx?>" />
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
				<thead>
					<tr>
						<th colspan="2" class="txt_l">
							<span>등록일 : <?=date('Y-m-d H:i', strtotime($data['n_regdate']))?></span>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>제목</th>
						<td>
							<input type="text" class="w_input2" value="<?=$data['n_title']?>" name="n_title" id="tit" placeholder="">
						</td>
					</tr>
					<tr>
						<th>내용</th>
						<td class="con_editor1">
							<textarea name="n_content" class="w_input1" id="n_content" cols="30" rows="10" style="height: 200px;"><?=$data['n_content']?></textarea>
						</td>
					</tr>
					<tr>
						<th>첨부파일</th>
						<td>
							<div class="filebox">
								<input class="upload_name w_input1" value="<?=$data['n_filename_ori']?>" name="" placeholder="" disabled="disabled" />
								<label for="tb_file" class="bt_3">찾아보기</label>
								<input type="file" class="upload_hidden" value="" name="n_filename_ori" placeholder="" id="tb_file"/>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="bt_wrap1">
			<div class="right_box">
				<button type="button" class="bt_1" onclick="noticefrm(document.frm);">수정</button>
				<button type="button" class="bt_1" onclick="del_notice('<?=$data['nseq']?>');">삭제</button>
				<a href="s1.php" class="bt_1">목록</a>
			</div>
		</div>
		</form>
	</section>
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
        if(isok == 1 && confirm('공지사항을 수정하시겠습니까?') == true){
        	frm.mode.value = "U";
            frm.submit();
        }
        
    }    
    function del_notice(idx){
    	if(confirm("정말로 삭제하시겠습니까?\n삭제한 자료는 복구할 수가 없습니다.")){
    		location.href="/lib/notice_del.php?idx="+idx;
    	}
    }
</script>

</body>
</html>