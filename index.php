<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/table.css"/>
<title>Phân trang với kết quả tìm kiếm trong PHP</title>
</head>
 
<body>
<div class="content">
	<center><h2>Danh sách món ăn</h2></center>
    <div class="box" align="center">
        <form method="get" action="index.php">
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
     <!--phân trang-->
     <div class="navigation" align="center">
     	<ul>
      	<?php
            if(isset($total_pages))
            {  
               if($total_pages > 1)        
               {    // nếu tổng số trang > 1 in dòng Page... of...
		   echo '<li class="single">Page '.$curr_page. ' of '.$total_pages.'</li>';
				              	// nếu trang hiện tại lớn hơn số link muốn hiển thị
		   if($curr_page > $num_links)   
                    {   
			// thì in nút 'First'
                        echo '<li><a href="'.$page_url.'?search='.$search.'&page=1">First</a></li>';
                    }
					               // nếu trang hiện tại > 1
                    if($curr_page > 1) 
                    {
	                // in nút 'Previous'
			echo '<li><a href="'.$page_url.'?search='.$search.'&page='.($curr_page-1).'">Previous</a> </li>';
                    }     
					
					               // hiển thị các link bao gồm trang hiện tại và link trang hiển thị (trái và phải) bắt đầu từ $start, kết thúc là $end
					// $start và $end được tính trong pagination.php
                    for($pages = $start ; $pages <= $end ;$pages++)
                    {
                        if($pages == $curr_page)
			{
			       echo '<li class="active"><a href="'.$page_url.'?search='.$search.'&page='.$pages.'">'.$pages.'</a></li>';
			}
			else
			{
			       echo '<li><a href="'.$page_url.'?search='.$search.'&page='.$pages.'">'.$pages.'</a></li>'; 
			}
                }
                // nếu trang hiện tại < tổng số trang            
                if($curr_page < $total_pages )
                {  
	             // thì in nút 'Next'
                     echo '<li><a href="'.$page_url.'?search='.$search.'&page='.($curr_page+1).'">Next</a></li>';
                 }
					            // nếu trang hiện tại + số link muốn hiển thị (ở đây là + với số link bên phải) > tổng số trang
                 if(($curr_page + $num_links) <$total_pages )
                 {   
		      // thì in nút 'Last'
                      echo '<li><a href="'.$page_url.'?search='.$search.'&page='.$total_pages.'">Last</a> </li>'; 
                  }  
           }
       }
       ?>
    </ul>
  </div>
</div>
</body>
</html>