<?php
    session_start();
    if ($_SESSION['quyen'] != 'CTV' || !isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }
    mysql_pconnect("localhost", "root","")or die("Không thể kết nối CSDL.");
    mysql_select_db("duyetbaiviet")or die("Không tồn tại CSDL \"duyetbaiviet\".");
    mysql_query("SET NAME 'utf8'");
    if (isset($_GET['message'])) {
       if ($_GET['message'] == 'SuccessComment')echo "<script type='text/javascript'>alert('Đã gửi bình luận');</script>";  
       if ($_GET['message'] == 'ErrorComment') echo "<script type='text/javascript'>alert('Không thể gửi bình luận!');</script>";  
    }
    if (isset($_POST['new'])) { 
        header('Location: newBV.php');
        exit;
    }
    if (isset($_POST['send']) && isset($_POST['id'])) {
        $sql = mysql_query("Update tbl_baiviet set TrangThai = 'Chưa duyệt', NgayGui = now() where MaBV = ".$_POST['id']);
        if ($sql) {
            $sql = mysql_query("Select MaND from tbl_thuoccm where MaCM = ".$_POST['cm']);
            while ($row= mysql_fetch_array($sql)) {
                $t = mysql_query ("Insert into tbl_phancong (MaBV,MaND) values (".$_POST['id'].",".$row['MaND'].")");
            }
            echo "<script type='text/javascript'>alert('Gửi bài thành công');</script>";
        }
        else echo "<script type='text/javascript'>alert('Gửi bài thất bại');</script>";
    }
    if (isset($_POST['luusua'])) {
        if ($_POST['tt'] == 'Cần sửa') $sql = mysql_query("Update tbl_baiviet set TrangThai = 'Chưa duyệt', LanSuaCuoi = now(),TieuDe = '".$_POST['title']."', MaCM = ".$_POST['cm'].",NoiDung = '".$_POST['content']."', NguoiSuaCuoi='".$_SESSION['username']."' where MaBV = ".$_POST['id']);
        else $sql = mysql_query("Update tbl_baiviet set LanSuaCuoi = now(),TieuDe = '".$_POST['title']."', MaCM = ".$_POST['cm'].",NoiDung = '".$_POST['content']."' where MaBV = ".$_POST['id']);
        if ($sql) {
            $sql = mysql_query("Update tbl_tag set Tag = '".$_POST['tag']."' where MaBV = ".$_POST['id']);
            if ($sql) {
                $sql = mysql_query("DELETE FROM tbl_phancong WHERE MaND != 1 and MaBV = ".$_POST['id']);
                $sql = mysql_query("Select MaND from tbl_thuoccm where MaCM = ".$_POST['cm']);
                while ($row= mysql_fetch_array($sql)) {
                    $t = mysql_query ("Insert into tbl_phancong (MaBV,MaND) values (".$_POST['id'].",".$row['MaND'].")");
                }
                echo "<script type='text/javascript'>alert('Chỉnh sửa thành công!');</script>";
            }
            else echo "<script type='text/javascript'>alert('Không thể sửa bài viết');</script>";
        } else echo mysql_error();
    }
    if (isset($_POST['sands'])) {
        $sql = mysql_query("Update tbl_baiviet set NgayGui = now(), TrangThai = 'Chưa duyệt', LanSuaCuoi = now(),TieuDe = '".$_POST['title']."', MaCM = ".$_POST['cm'].",NoiDung = '".$_POST['content']."', NguoiSuaCuoi='".$_SESSION['username']."' where MaBV = ".$_POST['id']);
        if ($sql) {
            $sql = mysql_query("Update tbl_tag set Tag = '".$_POST['tag']."' where MaBV = ".$_POST['id']);
            if ($sql) {
                $sql = mysql_query("Select MaND from tbl_thuoccm where MaCM = ".$_POST['cm']);
                while ($row= mysql_fetch_array($sql)) {
                    $t = mysql_query ("Insert into tbl_phancong (MaBV,MaND) values (".$_POST['id'].",".$row['MaND'].")");
                }
                echo "<script type='text/javascript'>alert('Chỉnh sửa và gửi bài thành công!');</script>";
            }
            else echo "<script type='text/javascript'>alert('Không thể và gửi bài viết');</script>";
        } else echo "<script type='text/javascript'>alert('Không thể sửa và gửi bài viết');</script>";
    }
    if (isset($_GET['id'])) $id = $_GET['id'];
    else 
        if (isset($_POST['id'])) $id = $_POST['id'];
    $sql = mysql_query("Select DISTINCT * from tbl_baiviet, tbl_tag, tbl_chuyenmuc where tbl_baiviet.MaCM = tbl_chuyenmuc.MaCM and tbl_baiviet.MaBV = tbl_tag.MaBV and tbl_baiviet.MaBV =".$id);
    $row= mysql_fetch_array($sql);
    $title = $row['TieuDe'];
    $cm = $row['TenCM'];
    $tag = $row['Tag'];
    $content = $row['NoiDung'];
    $ng = $row['NgayGui'];
    $nt = $row['NgayTao'];
    $tt = $row['TrangThai'];
    $lsc = $row['LanSuaCuoi'];
    $nsc = $row['NguoiSuaCuoi'];
    $mcm = $row['MaCM'];
    $sql = mysql_query("Select HoTen,NgayDuyet from tbl_duyetbai,tbl_nguoiduyetbai where tbl_nguoiduyetbai.MaND = tbl_duyetbai.MaND and MaBV=".$id." order by NgayDuyet DESC");
    $row= mysql_fetch_array($sql);    
    $tdc = $row['HoTen'];
    $ndc = $row['NgayDuyet'];
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Xem, chỉnh sửa bài viết</title>
   <script src="ckeditor/ckeditor.js"></script>
   <link rel="stylesheet" type="text/css"  href="css/style.css" media = "all"/>
    <style>
    #left{
     width: 100%;
     border: 0px solid #CDCDCD;
    }
    <?php
        if (isset($_POST['modify'])) echo ' body{background:url(image/wall.jpg) repeat left top;} ';
        else echo ' body{background:url(image/test1.jpg) repeat left top;} #than{height: 910px;}' 
    ?> 
    </style>
</head>
<body>
<div id="main">
    <div id="head">
        <?php include "head.php"; ?>
    </div>
    <div id="secondary-Menu">
        <nav id="nav-1">
            <a class="link-1" href="CTV.php">Trang chủ</a>
            <a class="link-1" href="newBV.php">Tạo bài viết mới</a>
            <a class="link-1" href="dsbv.php">Danh sách bài viết</a>
            <a class="link-1" href="logout.php">Đăng xuất</a>
        </nav>
    </div>
    <div id="than">
    <div id="left">
    <?php
        if (isset($_POST['modify'])) include"changeBV.php";
        else {
            echo '
            <div style="width: 96%; margin-left: 4%; margin-right:4%">
            <div style="width:60%; float:left;">
            <fieldset style = "height: 150px; line-height: 1.5; background-color: #F7F7F7; ">
            <legend><b>Thông tin bài viết</b></legend>
            <input type="text" name="id" hidden="" value = "'.$id.'"/>
            <input type="text" name="cm" hidden="" value = "'.$mcm.'"/>
            <span style="color: #0F7D75; font-weight: bold;">Mã bài viết:</span> '.$id.'<br />
            <span style="color: #0F7D75; font-weight: bold;">Tiêu đề:</span> '.$title.'<br />
            <span style="color: #0F7D75; font-weight: bold;">Chuyên mục:</span> '.$cm.'<br />
            <span style="color: #0F7D75; font-weight: bold;">Tag:</span> '.$tag.'<br />
            <span style="color: #0F7D75; font-weight: bold;">Ngày tạo:</span> '.$nt.'
            <span style="color: #0F7D75; font-weight: bold; margin-left: 110px;">Ngày gửi:</span> '.$ng.'<br />
            <span style="color: #0F7D75; font-weight: bold;">Lần sửa cuối:</span> '.$lsc.'
            <span style="color: #0F7D75; font-weight: bold; margin-left: 81px;">Người sửa cuối:</span> '.$nsc.'<br/>
            <span style="color: #0F7D75; font-weight: bold;">Trạng thái:</span> '.$tt.'<br />
            </fieldset></div>
            <div style=" width: 28%; margin-left: 0.5%; margin-right: 11%; float: left;">
            <fieldset style = "height: 150px; line-height: 1.5; background-color: #F7F7F7;">
            <legend><b>Thông tin duyệt bài</b></legend>';
            if ($tt == 'Đã duyệt') echo '<span style="color: #CC0315"><b>Bài viết đã được duyệt.</b></span><br>';
            echo'
                Duyệt lần cuối: '.$ndc.'<br>
                Người duyệt cuối: '.$tdc.'<br><br>
                </fieldset>
                </div></div>';
            echo'
            <form action="viewBV.php?id='.$id.'" method="POST" enctype="multipart/form-data">
            &emsp;&emsp;&emsp;&ensp;<p style="margin-left: 65px;"><b>Nội dung</b></p><br>
            <div style="width: 78%; margin-left: 4.5%; padding-left: 3%; padding-right: 3%; height: 320px; overflow: auto; background-color: #F7F7F7; border: 1px solid gray;">
            '.$content.'</div><br>';
            if ($tt == 'Lưu nháp') {
                echo'<input type="submit" value="Tạo bài viết mới" name="new" style="margin-left: 65%; height: 25px"/>
                <input type="submit" value="Gửi bài" name="send" style="height: 25px"/>
                <input type="submit" value="Sửa bài" name="modify" style="height: 25px"/>';
            }
            else if ($tt != 'Đã duyệt') {
                    echo'<input type="submit" value="Tạo bài viết mới" name="new" style="margin-left: 70%; height: 25px"/>
                    <input type="submit" value="Sửa bài" name="modify" style="height: 25px"/>';
                } else {
                    echo'<input type="submit" value="Tạo bài viết mới" name="new" style="margin-left: 75%; height: 25px"/>';
                }
            echo '</form>
            <form action="sendComment.php" method="POST" style ="margin-left: 4.5%;">
                &emsp;<b>Bình luận</b><br />
                <input type="text" name="ma" hidden="" value = "'.$id.'"/>
                <textarea name="comment" cols="60" rows="3" style="overflow:hidden" required></textarea>
                <input type="submit" name="sendcmt" value="Gửi"/>
            </form><br/>
            <div style ="margin-left: 4.5%; height: 150px; overflow: auto; overflow-x: hidden; width: 510px">';
            $sql = mysql_query("Select Username, NoiDung,ThoiGian from tbl_binhluan where MaBV =".$id." order by ThoiGian ASC");
            while ($row = mysql_fetch_array($sql)) {
                echo '<div style="width: 500px; border-bottom: 1px solid grey; padding-bottom: 10px"><p><img src = "image/comment.png" style="float:left; margin-right: 10px"/><i>
                    '.$row['Username'].' | '.$row['ThoiGian'].'</i></p>'.
                $row['NoiDung'],'</div>';
            }
            echo '</div>';                    
        }
    ?>
    </div>
    </div>
    <div id="footer">
    </div>
</body>
</html>