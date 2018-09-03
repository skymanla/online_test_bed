<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();

//2018.08.27 Danny
//2018.08.27 Ryan skymanla
if(empty($_SESSION)){
    go_href("관리자만 접근 가능합니다.", "/adm/", "go");
    exit;
}

$writer = $_SESSION['id'];
$ip = $_SERVER['REMOTE_ADDR'];
$n_title = $_POST['n_title'];
$n_content = $_POST['n_content'];
$mode = $_POST['mode'];


//관리자만 가능
if($writer != ''){
    //Data Notice Insert
    ///File Upload//
    $file_flag = false;
    if(isset($_FILES)){
        $file_flag = true;
        $file = $_FILES['n_filename_ori'];
        $rename = time();
        $dir = dir."/data/notice";
            
        if(is_dir($dir) == false) mkdir($dir, 0755);
        //if(is_dir($seq_dir) == false) mkdir($seq_dir, 0755);

        move_uploaded_file($file['tmp_name'], $dir."/".$rename);
        
    }
    if($mode == '' || $mode == 'W'){        
        $sql = "INSERT INTO tbl_notice  (n_title, n_content, n_writer,n_filecnt, n_writer_ip, n_regdate, n_hit, n_filename_ori, n_filename_con, n_file_size ) values ";
        $sql .= " ('$n_title' , '$n_content', '$writer','1', '$ip', now(), 0, '".$file['name']."', '".$rename."', '".$file['size']."') ";
      //  $query = $db->prepare($sql);
        try{
            $db->exec($sql);
        }catch(Exception $e){
            echo $e->getMessage();
        }

        go_href("게시글 등록이 완료되었습니다.", "/adm/page/s5/s1.php", "go");
        exit;
    }
    //Data Notice Update
    else if($mode == 'U'){
        $sql_common = " n_title='".$n_title."',
                        n_content='".$n_content."',
                        n_writer='".$writer."',
                        n_modidate=now()";
        if($file_flag == true){
            $sql_common .= ", n_filename_ori='".$file['name']."', n_file_size='".$file['size']."', n_filename_con='".$rename."'";
        }

        $sql = "update tbl_notice set ".$sql_common." where nseq='".$_POST['idx']."'";
        $db->query($sql);

        go_href("게시글 수정이 완료되었습니다.", "/adm/page/s5/s1.php", "go");
        exit;
    }
}
////
?>