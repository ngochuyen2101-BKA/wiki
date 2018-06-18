<?php 
if(isset($_GET['ac'])&&$_GET['ac']=='logout'){
	unset($_SESSION['login']);
	header('location:DangNhap.php');
}?>
<html>
<body>
<a href="DangXuat.php?ac=logout">DangXuat</a>
</body>
</html>