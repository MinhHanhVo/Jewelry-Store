<?php
	session_start();
	//include_once('./cauhinh/ketnoi.php');
	require "../cauhinh/ketnoi.php";
	$error = NULL;
	if(isset($_POST['submit'])){
		if($_POST['tk']==""){
			$error = "Vui lòng nhập tài khoản và mật khẩu";
		}else{
			$tk = $_POST['tk'];
		}

		if($_POST['mk']==""){
			$error = "Vui lòng nhập tài khoản và mật khẩu";
		}else{
			$mk = $_POST['mk'];
		}

		if(isset($tk) && isset($mk)){
			$sql = "SELECT * FROM thanhvien WHERE email = '$tk' AND mat_khau = '$mk'";
			$query = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($query);
			if($rows<=0){
				$error = 'Tài khoản hoặc mật khẩu chưa đúng';
			}else{
				$_SESSION['tk'] = $tk;
				$_SESSION['mk'] = $mk;
				header('location:quantri.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8" />
	<title>Trang sức Hạnh Phương</title>
	<link rel="stylesheet" type="text/css" href="css/dangnhap.css" />
</head>
<body>
	<?php
		if(!isset($_SESSION['tk'])){


	?>
	<form method="post">
	<div id="form-login">
		<h2>Đăng nhập hệ thống quản trị</h2>
		<center><span style="color:red;"><?php echo $error;?></span></center>
	    <ul>
	        <li><label>Tài khoản</label><input type="text" name="tk" /></li>
	        <li><label>Mật khẩu</label><input type="password" name="mk" /></li>
	        <li><label>Ghi nhớ <input type="checkbox" name="check" checked="checked" /></label></li>
	        <li><input type="submit" name="submit" value="Đăng nhập" /> <input type="reset" name="resset" value="Làm mới" /></li>
	    </ul>
	</div>
	</form>
	<?php
}else{
	header('location:quantri.php');
}
	?>
</body>
</html>
