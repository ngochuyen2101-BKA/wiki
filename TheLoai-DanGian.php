<?php
if(isset($_POST['search']))
{
	$valueToSearch = $_POST['valueToSearch'];
	$query = "SELECT * FROM baiviet, chuyenmuc WHERE  baiviet.MaCM=chuyenmuc.MaCM CONCAT(`TieuDe`, `TenCM`, `TrangThai`)LIKE '%".$valueToSearch."%'";
	$search_result = filterTable($query);
}
else{
	$query = "SELECT * FROM baiviet, chuyenmuc WHERE TenCM = N'Van hoc dan gian' baiviet.MaCM=chuyenmuc.MaCM";
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
<title>Thể Loại</title>
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
<form action="TheLoai-DanGian.php" method="post" >
<input type="text" name="valueToSearch" placeholder="" align="left">
  <br> 
  <br />
<input type="submit" name="search" value="Tìm kiếm"> <br> <br>
<table border="2px" width="671">
<tr>
<th width="142">Tiêu đề</th>
<th width="252">Tên chuyên mục</th>
<th width="103">Trạng thái</th>
<th width="94"></th>
</tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
<tr>
<td><?php echo $row['TieuDe'];?></td>
<td><?php echo $row['TenCM'];?></td>
<td><?php echo $row['TrangThai'];?></td>
<?php echo '<td><a href="t1.php?id='.$row['MaBV'].'">Xem</a></td></tr>';  ?>
</tr>
<?php endwhile;?>
</table>
</form>
</body>
</html>