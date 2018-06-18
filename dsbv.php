<?php
    session_start();
    if ($_SESSION['quyen'] == 'Admin' || !isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }
    if (isset($_GET['message'])) {
       if ($_GET['message'] == 'SuccessDelete')echo "<script type='text/javascript'>alert('Xóa thông tin thành công');</script>";  
       if ($_GET['message'] == 'ErrorDelete') echo "<script type='text/javascript'>alert('Không thể xóa thông tin!');</script>";  
    }
    if(isset($_POST['find'])) {
       $cm = $_POST['cm'];
       $tt = $_POST['tt'];
       $name = $_POST['name'];
    }
    else 
        if (isset($_GET['cm'])) {
            $cm = $_GET['cm'];
            $tt = $_GET['tt'];
            $name = $_GET['name'];
        } 
        else {
            $cm = 'Tất cả';
            $tt = 'Tất cả';
            $name = '';
        }
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        /* Check/bỏ chek từng records */
        $(document).on('change','.checkitem', function(ev){
            var _dem = 0;
            var _checked = 1;
            /* Duyệt tất cả các checkitem */
            $('.checkitem').each(function(){
                if($(this).is(':checked')){
                    _dem ++;
                }else{
                    _checked = 0;
                }
            });
            if(_dem > 0){
                // Hiện nút xóa chọn
                $('button[name=btXoa]').show();
            }else{
                // Ẩn nút xóa chọn
                $('button[name=btXoa]').hide();
            }
        });
    });
</script>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Danh sách bài viết</title>
   <script src="file:///C|/Users/admin/Downloads/ckeditor/ckeditor.js"></script>
   <link rel="stylesheet" type="text/css"  href="file:///C|/Users/admin/Downloads/css/style.css" media = "all"/>
    <style>
        #left{
            margin-left: 8%;
            width: 84%;
            border: 0px solid #CDCDCD;
        }
    </style>
</head>
<body>
<div id="main">
    <div id="head">
        <?php include "file:///C|/Users/admin/Downloads/head.php"; ?>
    </div>
    <div id="secondary-Menu">
        <?php if ($_SESSION['quyen'] == 'CTV') echo'
         <nav id="nav-1">
            <a class="link-1" href="CTV.php">Trang chủ</a>
            <a class="link-1" href="newBV.php">Tạo bài viết mới</a>
            <a class="link-1" href="dsbv.php">Danh sách bài viết</a>
            <a class="link-1" href="logout.php">Đăng xuất</a>
        </nav>';
        else echo'
            <nav id="nav-1">
            <a class="link-1" href="NDB.php">Trang chủ</a>
            <a class="link-1" href="dsbv.php">Danh sách bài viết</a>
            <a class="link-1" href="dsctv.php">Danh sách cộng tác viên</a>
            <a class="link-1" href="logout.php">Đăng xuất</a>
        </nav>';?>
    </div>
    <div id="than">
    <div id="left">
    <form method="POST" action="file:///C|/Users/admin/Downloads/dsbv.php">
    <fieldset style="line-height: 2; width: 90%; margin-left: 3%">
            <legend><b>Tìm kiếm</b></legend>
            &emsp;&emsp;<label for="">Trạng thái:</label>
            <select name="tt">
                <option value="Tất cả" <?php if (isset($tt) && $tt == 'Tất cả') echo 'selected="selected"'?>>Tất cả</option>
                <?php 
                    if ($_SESSION['quyen'] == 'CTV') {
                        echo '<option value="Lưu nháp" ';
                        if (isset($tt) && $tt == 'Lưu nháp') echo 'selected="selected">Lưu nháp</option>';
                        else echo '>Lưu nháp</option>';
                    }
                ?>
                <option value="Chưa duyệt" <?php if (isset($tt) && $tt == 'Chưa duyệt') echo 'selected="selected"'?>>Chưa duyệt</option>
                <option value="Cần sửa" <?php if (isset($tt) && $tt == 'Cần sửa') echo 'selected="selected"'?>>Cần sửa</option>
                <option value="Đã duyệt" <?php if (isset($tt) && $tt == 'Đã duyệt') echo 'selected="selected"'?>>Đã duyệt</option>
            </select>
            &emsp;&emsp;<label for="">Chuyên mục:</label>
            <select name="cm">
                <option value="Tất cả">Tất cả</option>
                <option value="Thể thao" <?php if (isset($cm) && $cm == 'Thể thao') echo 'selected="selected"'?>>Thể thao</option>
                <option value="Pháp luật" <?php if (isset($cm) && $cm == 'Pháp luật') echo 'selected="selected"'?>>Pháp luật</option>
                <option value="Giáo dục" <?php if (isset($cm) && $cm == 'Giáo dục') echo 'selected="selected"'?>>Giáo dục</option>
                <option value="Văn hóa" <?php if (isset($cm) && $cm == 'Văn học') echo 'selected="selected"'?>>Văn hóa</option>
                <option value="Giải trí" <?php if (isset($cm) && $cm == 'Giải trí') echo 'selected="selected"'?>>Giải trí</option>
                <option value="Thế giới" <?php if (isset($cm) && $cm == 'Thế giới') echo 'selected="selected"'?>>Thế giới</option>
                <option value="Sức khỏe" <?php if (isset($cm) && $cm == 'Sức khỏe') echo 'selected="selected"'?>>Sức khỏe</option>
                <option value="Nhịp sống trẻ" <?php if (isset($cm) && $cm == 'Nhịp sống trẻ') echo 'selected="selected"'?>>Nhịp sống trẻ</option>
                <option value="Tổng hợp" <?php if (isset($cm) && $cm == 'Tổng hợp') echo 'selected="selected"'?>>Tổng hợp</option>
            </select>
            &emsp;&emsp;Tên bài viết: <input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']?>"/>
            &ensp;<input type="submit" name="find" value="Tìm kiếm"/>
    </fieldset><br />
    </form>
    <form method="post" action="file:///C|/Users/admin/Downloads/deleteBV.php">
    <table>
        <thead>
        <tr>
            <th style="text-align:center; width: 2%"></th>
            <th style="text-align:center; width: 3%">Mã</th>
            <th style="text-align:center; width: 35%">Tiêu đề</th>
            <th style="text-align:center; width: 15%">Chuyên mục</th>
            <th style="text-align:center; width: 15%">Trạng thái</th>
            <th style="text-align:center; width: 10%"></th>
        </tr>
        </thead>
        <tbody>
            <?php 
                if ($_SESSION['quyen'] == 'CTV'){
                    include "file:///C|/Users/admin/Downloads/config3.php";
                    for( $i = 0; $i < count( $results->data ); $i++ ) :
                    echo '<tr>';
                    if ($results->data[$i]['TrangThai'] == 'Lưu nháp') 
                        echo '<td><input class="checkitem" type="checkbox" name="id[]" value="'.$results->data[$i]['MaBV'].'" /></td>';
                        else if ($results->data[$i]['TrangThai'] == 'Chưa duyệt') {
                                $conn = mysql_pconnect("localhost", "root","")or die("Không thể kết nối CSDL.");
                                mysql_select_db("duyetbaiviet")or die("Không tồn tại CSDL \"duyetbaiviet\".");
                                mysql_query("SET NAME 'utf8'");
                                $sql = mysql_query("Select MaLD from tbl_duyetbai where MaBV = ".$results->data[$i]['MaBV']);
                                $count = mysql_num_rows($sql);
                                if ($count > 0) echo '<td></td>';
                                else {
                                    $sql = mysql_query("Select MaND from tbl_thuoccm where MaCM = ".$results->data[$i]['MaCM']);
                                    $count = mysql_num_rows($sql);
                                    if ($count <= 2) echo '<td></td>';
                                    else {
                                        $sql = mysql_query("Select MaND from tbl_phancong where MaBV = ".$results->data[$i]['MaBV']);
                                        $count1 = mysql_num_rows($sql);
                                        if ($count1 != $count) echo '<td></td>';
                                        else echo '<td><input class="checkitem" type="checkbox" name="id[]" value="'.$results->data[$i]['MaBV'].'" /></td>';
                                    }
                                }
                            } else echo '<td></td>';
                    echo '<td>'.$results->data[$i]['MaBV'].'</td>
                        <td>'.$results->data[$i]['TieuDe'].'</td>
                        <td>'.$results->data[$i]['TenCM'].'</td>
                        <td>'.$results->data[$i]['TrangThai'].'</td>';      
                    echo '<td><a href="viewBV.php?id='.$results->data[$i]['MaBV'].'">Xem</a></td></tr>';
                    endfor;              
                } else {
                    include "file:///C|/Users/admin/Downloads/config4.php";
                    for( $i = 0; $i < count( $results->data ); $i++ ) :
                    echo '<tr>';
                    if ($results->data[$i]['TrangThai'] != 'Đã duyệt') 
                        echo '<td><input class="checkitem" type="checkbox" name="id[]" value="'.$results->data[$i]['MaBV'].'" /></td>';
                    else echo '<td></td>';
                    echo '<td>'.$results->data[$i]['MaBV'].'</td>
                        <td>'.$results->data[$i]['TieuDe'].'</td>
                        <td>'.$results->data[$i]['TenCM'].'</td>
                        <td>'.$results->data[$i]['TrangThai'].'</td>';
                    echo '<td><a href="view.php?id='.$results->data[$i]['MaBV'].'">Xem</a></td></tr>';
                    endfor;
                }  
            ?>
        </tbody>
    </table>  <br />
    <?php echo "Tổng số bài viết: $stt"?>
    <?php echo $paginator3->createLinks($links); ?> 
    <button type="submit" class="btn" name="btXoa" value="delete_all" style="display:none; height: 25; margin-left: 85%">Xóa bài viết</button>
    </form> 
    </div>
    </div>
    <div id="footer">
    </div>
</body>
</html>