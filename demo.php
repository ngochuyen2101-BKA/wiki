
<html>
<head>
<meta charset="UTF-8"/>
<title>Trang chủ</title>
<head>
<link rel="stylesheet" type="text/css" href="style-trangchu.css" />
</head>
<body>
<style> #menu_top{
	width:647px;}</style>
<div id="menu_top" ><ul>
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
<div id="footer"></div>
<?php 
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
?><br> <br>
<table id="table" align="left" border="1" width="600">
	<tr align="center"> 
    	<td>Truyen</td>
        <td>The loai</td>
        <td>Nguoi Dang</td>
        <td></td>
  </tr>
    
            <tr align="center">
            	 
                 <?php 
		          $sl= mysql_query("select * from baiviet, chuyenmuc, phancong, nguoidangbai where baiviet.MaBV = phancong.MaBV and baiviet.MaCM = chuyenmuc.MaCM and phancong.MaNDang = nguoidangbai.MaNDang");
		          while($row = mysql_fetch_array($sl)){?> 
		<td><?php  echo  $row['MaBV']; ?></td>
        <td><?php  echo $row['TenCM'];?></td>
        <td><?php  echo $row['HoTen']; ?></td>
        <?php echo '<td><a href="t1.php?id='.$row['MaBV'].'">Xem</a></td></tr>';  ?>
        <?php } ?>
        
        
</table>
<?php error_reporting(E_ALL ^ E_DEPRECATED); ?>
<?php mysql_close($con);?>
</body>
</html>