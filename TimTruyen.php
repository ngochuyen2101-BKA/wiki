<?php
if(isset($_POST['search']))
{
	$valueToSearch = $_POST['valueToSearch'];
	$query = "SELECT * FROM `baiviet` WHERE CONCAT(`MaBV`, `TieuDe`, `TrangThai`)LIKE '%".$valueToSearch."%'";
	$search_result = filterTable($query);
}
else{
	$query = "SELECT * FROM `baiviet`";
	$search_result = filterTable($query);
	}
	function filterTable($query)
	{
		$connect = mysqli_connect("localhost", "root", "", "wiki");
		$filter_Result = mysqli_query($connect,$query);
		return $filter_Result;
		}
?>
<html>
<head>
<meta charset="UTF-8"/>
<title>Truyện</title>
<style>
table,tr,th,td
{
	border: 1px solid black;
}
</style>
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
<div id="footer"></div><br>
<form action="TimTruyen.php" method="post" >
<input type="text" name="valueToSearch" placeholder="" align="left">
  <br> 
  <br />
<input type="submit" name="search" value="Tìm kiếm"> <br> <br>
<table width="671">
<tr>
<th width="174">Mã bài viết</th>
<th width="268">Tiêu đề</th>
<th width="137">Trạng thái</th>
<th width="72"></th>
</tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
<tr>
<td><?php echo $row['MaBV'];?></td>
<td><?php echo $row['TieuDe'];?></td>
<td><?php echo $row['TrangThai'];?></td>
<?php echo '<td><a href="t1.php?id='.$row['MaBV'].'">Xem</a></td></tr>';  ?>
</tr>
<?php endwhile;?>
</table>
</form>
</body>
</html>