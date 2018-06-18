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
<title> PHP TABLE </title>
<style>
table,tr,th,td
{
	border: 1px solid black;
}
</style>
<body>
<form action="config.php" method="post">
<input type="text" name="valueToSearch" placeholder="Value To Search" <br> <br />
<input type="submit" name="search" value="Filter" <br> <br />
<table>
<tr>
<th>MaBV</th>
<th>TieuDe</th>
<th>TrangThai</th>
</tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
<tr>
<td><?php echo $row['MaBV'];?></td>
<td><?php echo $row['TieuDe'];?></td>
<td><?php echo $row['TrangThai'];?></td>
</tr>
<?php endwhile;?>
</table>
</form>
</body>
</html>