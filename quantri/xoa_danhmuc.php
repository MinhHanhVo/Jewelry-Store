<?php
require "../cauhinh/ketnoi.php";

// Lấy ID của danh mục cần xóa từ URL
if (isset($_GET['id'])) {
    $id_dm = $_GET['id'];

    // Xóa danh mục khỏi cơ sở dữ liệu
    $sql = "DELETE FROM dmsanpham WHERE id_dm='$id_dm'";
    if (mysqli_query($conn, $sql)) {
        echo "Xóa danh mục thành công!";
        header("Location:quantri.php?page_layout=danhmucsp");
        exit;
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    header("Location:quantri.php?page_layout=danhmucsp");
    exit;
}
?>
