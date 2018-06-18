<?php

mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");?>
<?php
if (isset($_POST['them']) || isset($_POST['sua']) || isset($_POST['xoa'])) {
$MaBV=$_POST['MaBV'];
$MaCM=$_POST['MaCM'];
$TieuDe=$_POST['TieuDe'];
$NgayTao=$_POST['NgayTao'];
$NoiDung=$_POST['NoiDung'];
$TrangThai=$_POST['TrangThai']; 
}
if(isset($_POST['them'])){
$sql="insert into baiviet (MaBV, MaCM, TieuDe, NgayTao, NoiDung, TrangThai) values ('".$MaBV."', '".$MaCM."', '".$TieuDe."', '".$NgayTao."', '".$NoiDung."', '".$TrangThai."')";
mysql_query($sql);
header('location:t2.php');}

if(isset($_POST['sua'])){
    
}
if (isset($_POST['xoa'])) {
	
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>thêm</title>
</head><body>
<form action="them.php" method="POST">
<table width="400" height="474" border="1">
  <tr>
    <td colspan="2"><div align="center">Thêm bài viết</div></td>
  </tr>
  <tr>
    <td width="120">Mã bài viết</td>
    <td width="264"><input type="text"name="MaBV"></td>
  </tr>
  <tr>
    <td>Mã chuyên mục</td>
    <td><input type="text"name="MaCM"></td>
  </tr>
  <tr>
    <td>Tiêu đề</td>
    <td><input type="text"name="TieuDe"></td>
  </tr>
  <tr>
    <td>Ngày tạo</td>
    <td><input type="text"name="NgayTao">;</td>
  </tr>
  <tr>
    <td height="168">Nội dung</td>
    <td><input type="text"name="NoiDung" width="300px" height="300px"></td>
  </tr>
  <tr>
    <td>Trạng thái</td>
    <td><input type="text"name="TrangThai"></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="them" id="them" value="Thêm">
      <input type="submit" name="sua" id="sua" value="Sửa">
      <input type="submit" name="xoa" id="xoa" value="Xóa">
    </div></td>
  </tr>
  </table>
  </form>
  </body>
  </html>