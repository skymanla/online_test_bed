<?
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/top_sub.php");
include_once($_SERVER['DOCUMENT_ROOT']."/common/include/function.php");
session_start();
$sql = "select * from tbl_notice where nseq='".$_GET['idx']."'";
$query = $db->query($sql);

if($query->rowCount() == false){
	header("HTTP/1.1 400 Bad Request");
	go_href("잘못된 접근입니다.", "/page/ss1/s1.php", "go");
	exit;
}else{
	$list = $query->fetch();
	$idx = $_GET['idx'];
	if(empty($_SESSION['notice']['seq_'.$idx])){
		$_SESSION['notice']['seq_'.$idx] = $_GET['idx'];
		$sql = "update tbl_notice set n_hit=n_hit+1 where nseq='".$_GET['idx']."'";
		$db->query($sql);
	}else{

	}
}
?>
		<div class="s1view_sec">
			<h3>공지사항</h3>
			<div>
				<h4>공지사항 입니다.</h4>
				<div>
					<dl>
						<dt>작성자</dt>
						<dd>관리자</dd>
					</dl>
					<dl>
						<dt>조회수</dt>
						<dd><?=$list['n_hit']?></dd>
					</dl>
					<dl>
						<dt>등록일</dt>
						<dd><?=date('Y.m.d H:i', strtotime($list['n_regdate']))?></dd>
					</dl>
				</div>
				<p><?=$list['n_content']?></p>
				<p>첨부파일 : <a href="/lib/download2.php?idx=<?=$idx?>"><?=$list['n_filename_ori']?></a></p>
			</div>
			<a href="s1.php">목록</a>
			<button type="button" class="top_btn"><i>화면상단</i></button>
		</div>
<? include_once($_SERVER['DOCUMENT_ROOT']."/common/include/footer_sub.php"); ?>