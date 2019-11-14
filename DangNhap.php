<?php
session_start();
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
if(isset($_POST['submit'])){
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$sql = "select * from dangnhap where Usename='".$username."' and Password='".$password."'";
	$query=mysql_query($sql);
	$nums=mysql_num_rows($query);
	if($nums == 0){
			header('location:DangNhap.php');
	}else{
	
        $_SESSION['submit']=$username;
		header('location:them.php');
	}
}
?>
<html>
<title>Đăng nhập</title>
<head> 
</head>

<body>
<div align="center">
  <style>
body{
    background:url(image/nen5.jpg);
	background-size:cover;}
  </style>
  <?php 
mysql_connect("localhost","root","") or die ("no connect");
mysql_select_db('wiki');
mysql_query("SET NAME 'utf8'");
?>
</div>
<form action="DangNhap.php" method="post" >
  
  <div align="center">
  <br><br><br><br>
  <table width="274" border="1" >
    <tr>
      <td height="41" colspan="2"><div align="center" style="background-color:#FFF">
        <h3><strong>Đăng nhập</strong></h3>
      </div></td>
    </tr>
    <tr>
      <td width="60" height="49" style="background-color:#FFF">Usename</td>
      <td width="198"> <input type="text" name="user" align="middle"/></td>
    </tr>
    <tr>
      <td height="53" style="background-color:#FFF">Password</td>
      <td><input type="password" name="pass" align="middle"/></td>
    </tr>
    <tr>
      <td height="42" colspan="2"><div align="center">
        <input type="submit" value="Login" name="submit" align="middle"/>
      </div></td>
    </tr>
  </table>
</div>
</form>
</body>
</html>