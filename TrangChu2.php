
<html>
<head>
<meta charset="UTF-8"/>
<title>Trang chủ</title>
<head>
<link rel="stylesheet" type="text/css" href="style-trangchu.css" />
</head>
<body>
<style>
body{
    background:url(image/nen6.jpg);
	background-size:cover;}
  </style>
<div id="menu_top"><ul>
       <li><a href="#" title="Trang chủ" class="active"> Trang chủ</a></li>
       <li><a href="#" title="Thể loại">Thể loại</a>
       <ul>
          <li><a href="#"> Văn học dân gian</a></li>
          <li><a href="#"> Văn học trung đại</a></li>
          <li><a href="#"> Văn học hiện đại</a></li>
        </ul></li>
       <li><a href="#" title="Tìm truyện">Truyện</a></li>
       <li><a href="#" title="Liên hệ"> Liên hệ </a> </li>
       <li><a href="#" title="Đăng nhập">Đăng nhập</a>    </li>
    </ul> 
    </div>
<br>
<?php 
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
?>
<table id="table" align="left" border="1" width="600">
	<tr align="center"> 
    	<td>Truyen</td>
        <td>The loai</td>
        <td>Nguoi Dang</td>
  </tr>
    
            <tr align="center">
            	<td> 
                 <?php 
		          $sl= mysql_query("select * from baiviet");
		          while($row = mysql_fetch_array($sl)){?> 
		<?php  echo $row['TieuDe']; ?> <?php } ?></td>
                <td><?php 
		          $s2= mysql_query("select * from chuyenmuc");
		          while($row = mysql_fetch_array($s2)){?> 
		<?php  echo $row['TenCM']; ?> <?php } ?></td>
                <td><?php 
		          $s3= mysql_query("select * from nguoidangbai");
		          while($row = mysql_fetch_array($s3)){?> 
		<?php  echo $row['HoTen']; ?> <?php } ?></td>
</table>
<p>
  <?php error_reporting(E_ALL ^ E_DEPRECATED); ?>
  <?php mysql_close($con);?>
</p>
</body>
</html>