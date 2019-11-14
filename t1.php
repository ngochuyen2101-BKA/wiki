<?php 
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
 if (isset($_GET['id'])) $id = $_GET['id'];
 $sql = mysql_query("Select * from baiviet where MaBV =".$id);
 $row= mysql_fetch_array($sql);
 $content = $row['NoiDung'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style-trangchu.css" />
<title>view</title>
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
	width:645px;
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
<?php echo'
 <form action="t1.php?id='.$id.'" method="POST" enctype="multipart/form-data">
            <p style="margin-left: 65px;"><b>Nội dung</b></p><br>
            <div style="width: 78%; margin-left: 4.5%; padding-left: 3%; padding-right: 3%; height: 320px; overflow: auto; background-color: #F7F7F7; border: 1px solid gray;">
            '.$content.'</div><br>'; ?>
</body>
</html>