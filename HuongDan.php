<?php
session_start();
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
if(isset($_POST['login'])){
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$sql = "select * from dangnhap where Usename='".$username."' and Password='".$password."'";
	$query=mysql_query($sql);
	$nums=mysql_num_rows($query);
	if($nums == 0){
			header('location:DangNhap.php');
	}else{
	
        $_SESSION['login']=$username;
		header('location:TrangChu.php');
	}
}
?>
<html>
<title>Đăng nhập</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head> <link rel="stylesheet" type="text/css" href="style-dangnhap.css" />
</head>

<body> 
<?php 
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
?>
<form action="DangNhap.php" method="post">
Usename: <input type="text" name="user"/> <br> <br>
Password: <input type="password" name="pass"/><br> <br>
<input type="submit" value="Dang nhap" name="login"/>
</form>
</body>
</html>