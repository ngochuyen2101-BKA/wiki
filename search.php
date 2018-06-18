<?php
	include('config.php');
	$page_url = 'http://localhost/DataTable/index.php'; 
	$display = 5; 
	$num_links = 2; 
	
	// tìm kiếm 
	$search = ''; // giá trị tìm kiếm mặc định ban đầu = ''
 // lấy yêu cầu từ URL
	if(isset($_GET['search']) && !empty($_GET['search']))
	{
		 $search = $_GET['search'];
		 echo '<div class="txtsearch">Kết quả tìm kiếm cho từ khóa:<strong> '. $search.'</strong></div>';
	}
	else
	{
		 $search = '';
	}
	// Sắp xếp kết quả theo cột
	$col='ma'; // cột lựa chọn sắp xếp mặc định là 'ma'
	$sort='ASC'; // biến sắp xếp mặc định là ASC
	$order_by = ' ORDER BY '.$col.' '.$sort; // câu lệnh sắp xếp mặc định theo cột 'ma' chiều tăng dần ASC
			
	if(isset($_GET['col']))
	{
				// lấy cột được lựa chọn để sắp xếp từ URL
				$col = $_GET['col'];
	}
	else
	{
				$col = '';
	}
	// nếu có yêu cầu sắp xếp thì lấy loại sắp xếp từ URL qua $_GET['sort']
	if(isset($_GET['sort']))
	{
			  // nếu $sort hiện tại = 'ASC' thì đặt lại giá trị là 'DESC'
		if($_GET['sort']=='ASC')
		{
			 $sort='DESC';
		}
		else // ngược lại $sort hiện tại = 'DESC' thì đặt lại giá trị là 'ASC'
		{
			 $sort='ASC';
		}
	}
	// với 3 cột dùng cấu trúc lựa chọn Switch-case để lấy những câu truy vấn tương ứng
	switch($col)
	{
		case 'ma':
			  $order_by = ' ORDER BY ma '.$sort; // sắp xếp theo cột 'ma' với 2 lựa chọn ASC và DESC
			  break;
		case 'ten':
			  $order_by = ' ORDER BY ten '.$sort;
			  break;
		case 'gia':
			  $order_by = ' ORDER BY gia '.$sort;
			  break;
	}
	
	// phân trang
	if(isset($_GET['page']) && is_numeric($_GET['page']))
	{
   		$curr_page = $_GET['page'];
	}
	else
	{
		$curr_page = 1; 
	}	
	// truy vấn lấy kết quả trả về có từ cần tìm 
	$query_search = "SELECT * FROM monan WHERE ma LIKE '%".$search."%' or ten LIKE '%".$search."%' or gia LIKE '%".$search."%'";
	$result_search = $db->query($query_search);
	
	// đếm số kết quả tìm được
	$total_rows = $result_search->rowCount($result_search);
	// tính vị trí của món ăn bắt đầu một trang
	$position = ($curr_page - 1)*$display;
	// truy vấn đầy đủ với tìm kiếm +  sắp xếp
	$query_full = $query_search.$order_by." LIMIT $position, $display";
	// tổng số trang
	$total_pages = ceil($total_rows/$display);
	
	if($curr_page > $num_links)
	{
		  $start = $curr_page - ($num_links - 1);
	}
	else
	{
		  $start = 1;
	}
	if(($curr_page + $num_links ) < $total_pages)
	{
		  $end = $curr_page + $num_links;
	}
	else
	{
		  $end = $total_pages;
	}
?>