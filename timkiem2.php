<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style-lienhe.css"/>
<title>Phân trang với kết quả tìm kiếm trong PHP</title>
</head>
 
<body>
<div class="content">
	<center><h2>Danh sách món ăn</h2></center>
    <div class="box" align="center">
        <form method="get" action="timkiem2.php">
            <input type="search" id="search" name="search" placeholder="Search..."/>
            <button type="submit" id="search-button">Search</button>
        </form>
    </div>
		<?php
		include('search.php');
		echo '<table width="50%" align="center" cellpadding="5" cellspacing="0"><thead><tr>';    
		echo '<th><a href="'.$page_url.'?search='.$search.'&col=ma&sort='.$sort.'&page='.$curr_page.'">Mã Món Ăn</a></th>';
		echo '<th><a href="'.$page_url.'?search='.$search.'&col=ten&sort='.$sort.'&page='.$curr_page.'">Tên Món Ăn</a></th>';
		echo '<th><a href="'.$page_url.'?search='.$search.'&col=gia&sort='.$sort.'&page='.$curr_page.'">Giá</a></th>';
		echo '</tr></thead><tbody>';
		// nếu không tìm được kết quả in ra thông báo
		if($total_rows == 0)
		{
		 	                echo '<tr><td colspan="3" class="noresult">Không tìm thấy kết quả</td></tr>';
		}
		// in ra kết quả tìm được
		foreach($db->query($query_full) as $row)
		{
			echo '<tr>';
			echo '<td>'.$row['ma'].'</td>';
			echo '<td>'.$row['ten'].'</td>';
			echo '<td>'.$row['gia'].'</td>';
			echo '</tr>';
		}   
		?>
		</tbody>
     	</table> 
    
</body>
</html>