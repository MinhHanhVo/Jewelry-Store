<?php
session_start();
$id_sp = $_GET['id_sp'];
$quantity_to_add = 1; // Số lượng mặc định thêm vào giỏ hàng

// Nếu đã tồn tại sản phẩm trong giỏ hàng thì tăng số lượng lên 1 đơn vị. Ngược lại, số lượng được gán = 1
if (isset($_SESSION['giohang'][$id_sp])) {
    $_SESSION['giohang'][$id_sp] += $quantity_to_add;
} else {
    $_SESSION['giohang'][$id_sp] = $quantity_to_add;
}

// Chuyển hướng đến trang danh sách sản phẩm
header('location:../../index.php?page_layout');
?>
