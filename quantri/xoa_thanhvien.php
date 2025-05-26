<?php
require "../cauhinh/ketnoi.php";

// Lấy ID của danh mục cần xóa từ URL
if (isset($_GET['id'])) {
    $id_thanhvien = $_GET['id'];

    // Xóa danh mục khỏi cơ sở dữ liệu
    $sql = "DELETE FROM thanhvien WHERE id_thanhvien='$id_thanhvien'";
    if (mysqli_query($conn, $sql)) {
        echo "Xóa thành viên thành công!";
        header("Location:quantri.php?page_layout=thanhvien");
        exit;
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    header("Location:quantri.php?page_layout=thanhvien");
    exit;
}
?>
