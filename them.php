<?php
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");?>
<?php
$id=$_GET['id'];
if (isset($_POST['them']) || isset($_POST['sua']) || isset($_POST['xoa'])) {
$MaBV=$_POST['MaBV'];
$MaCM=$_POST['MaCM'];
$TieuDe=$_POST['TieuDe'];
$NgayTao=$_POST['NgayTao'];
$NoiDung=$_POST['NoiDung'];
$TrangThai=$_POST['TrangThai']; 
}
if(isset($_POST['them'])){
	if (empty($_POST['MaBV']) ||empty($_POST['MaCM']) ||empty($_POST['TieuDe']) ||empty($_POST['NgayTao']) ||empty($_POST['NoiDung']) ||empty($_POST['TrangThai'])){
		 echo "<script type='text/javascript'>alert('Vui lòng nhập đủ thông tin!');</script>";  
		}
		else {
$sql="insert into baiviet (MaBV, MaCM, TieuDe, NgayTao, NoiDung, TrangThai) values ('".$MaBV."', '".$MaCM."', '".$TieuDe."', '".$NgayTao."', '".$NoiDung."', '".$TrangThai."')";
mysql_query($sql);
$rs = mysql_query($sql);
if (!$rs) echo mysql_error();}}
if (isset($_GET['id'])) {
	$sql="delete from baiviet where MaBV=".$_GET['id'];
	mysql_query($sql);
	header('location:them.php');
}
?>
<?php 
if(isset($_GET['ac'])&&$_GET['ac']=='logout'){
	unset($_SESSION['login']);
	header('location:DangNhap.php');
}?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style-trangchu.css" />
<title>thêm</title>
</head><body>
<body>
        <div align="center" >
          <h2><strong><u>TRANG ĐỌC TRUYỆN-THƠ WIKI</u></strong><br>
            <br>
            <style>
body{
    background:url(image/nen6.jpg);
	background-size:contain;}
            </style>
            <style> 
          #menu_top{
	width:647px;
	alignment-adjust:central;}
            </style>
          </h2>
        </div>
<div id="menu_top" ><ul>
        <li><a href="TrangChu.php" title="Trang chủ" class="active"> Trang chủ</a></li>
       <li><a href="TheLoai-DanGian.php" title="Thể loại">Thể loại</a></li>
       <li><a href="TimTruyen.php" title="Tìm truyện">Truyện</a></li>
       <li><a href="LienHe.php" title="Liên hệ"> Liên hệ </a> </li>
       <li><a href="TrangChu.php?ac=logout" title="Đăng nhập">Đăng xuất</a>    </li>
    </ul> 
    </div>
<div id="footer"></div><br>
<br><div align="center">
<form action="them.php" method="POST">
  <table width="400" height="474" border="1" align="center">
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
      <td><input type="text"name="NgayTao"></td>
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
      </div></td>
    </tr>
    </table>
  <br>
</div>
<br><br>
<?php 
$sql="select * from baiviet order by MaBV desc";
$run=mysql_query($sql);
?>
<table width="650" height="80" border="1" align="center">
  <tr></tr>
  <tr></tr>
  <tr>
    <td>Mã bài viết</td>
    <td>Mã chuyên mục</td>
    <td>Tiêu đề</td>
    <td>Ngày tạo</td>
    <td>Trạng thái</td>
    <td colspan="3">Quản lý</td>
  </tr>
  <?php 
  while($dong=mysql_fetch_array($run)){
  ?>
  <tr>
    <td><?php echo $dong['MaBV'] ?></td>
    <td><?php echo $dong['MaCM'] ?></td>
    <td><?php echo $dong['TieuDe'] ?></td>
    <td><?php echo $dong['NgayTao'] ?></td>
    <td><?php echo $dong['TrangThai'] ?></td>
     <?php echo '<td><a href="sua.php?id='.$dong['MaBV'].'">Sửa</a></td></tr>';  ?>
    <td><a href="them.php?id=<?php echo $dong['MaBV']?>"> Xóa</a></td>
     <?php echo '<td><a href="t1.php?id='.$dong['MaBV'].'">Xem</a></td></tr>';  ?>
  </tr>
  <?php } ?>
</table>
</body>
  </html>
