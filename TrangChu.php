
<html>
<head>
<meta charset="UTF-8"/>
<title>Trang chủ</title>
<head>
<link rel="stylesheet" type="text/css" href="style-trangchu.css" />
</head>
<body>
        <div align="center" >
          <h2><strong><u>TRANG ĐỌC TRUYỆN-THƠ WIKI</u></strong><br>
            <br>
            <style>
body{
    background:url(image/nen6.jpg);
	background-size:cover;}
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
       <li><a href="DangNhap.php" title="Đăng nhập">Đăng nhập</a>    </li>
    </ul> 
    </div>
<div id="footer"></div>
<div align="center">
  <?php 
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
?>
  <br> <br>
</div>
<table id="table" align="center" border="1" width="766">
	<tr align="center"> 
    	<td><strong>Truyện</strong></td>
        <td><strong>Thể loại</strong></td>
        <td><strong>Người Đăng</strong></td>
        <td></td>
  </tr>
            <tr align="left">
                 <?php 
		          $sl= mysql_query("select * from baiviet, chuyenmuc, phancong, nguoidangbai where baiviet.MaBV = phancong.MaBV and baiviet.MaCM = chuyenmuc.MaCM and phancong.MaNDang = nguoidangbai.MaNDang");
		          while($row = mysql_fetch_array($sl)){?> 
		<td><?php  echo  $row['TieuDe']; ?></td>
        <td><?php  echo $row['TenCM'];?></td>
        <td><?php  echo $row['HoTen']; ?></td>
        <?php echo '<td><a href="t1.php?id='.$row['MaBV'].'">Xem</a></td></tr>';  ?>
        <?php } ?>
        
        </tr>
</table>
<?php error_reporting(E_ALL ^ E_DEPRECATED); ?>
<?php mysql_close($con);?>
</body>
</html>