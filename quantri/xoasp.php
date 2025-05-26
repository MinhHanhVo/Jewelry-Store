<?php
	session_start();
	require "../config/ketnoi.php";
	if(isset($_SESSION['tk'])){
		$id_sp = $_GET['id_sp'];
		$sql = "DELETE FROM sanpham WHERE id_sp = $id_sp";
		$query = mysqli_query($conn, $sql);
		header('location:quantri.php?page_layout=danhsachsp');
	}else{
		header('location:index.php');
	}
?>