<?php
require "../config/ketnoi.php";

// Lấy ID của danh mục cần chỉnh sửa từ URL
if (isset($_GET['id'])) {
    $id_dm = $_GET['id'];

    // Kiểm tra nếu người dùng đã gửi form chỉnh sửa
    if (isset($_POST['update'])) {
        $ten_dm = $_POST['ten_dm'];

        // Cập nhật tên danh mục trong cơ sở dữ liệu
        $sql = "UPDATE dmsanpham SET ten_dm='$ten_dm' WHERE id_dm='$id_dm'";
        if (mysqli_query($conn, $sql)) {
            echo "Cập nhật danh mục thành công!";
            header("Location: quantri.php?page_layout=danhmucsp");
            exit;
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }

    // Lấy thông tin của danh mục từ cơ sở dữ liệu
    $sql = "SELECT * FROM dmsanpham WHERE id_dm='$id_dm'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
} else {
    header("Location: quantri.php?page_layout=danhmucsp");
    exit;
}
?>


<link rel="stylesheet" type="text/css" href="css/them_sua_dm.css" />

<div class="form-container">
    <h1>Chỉnh sửa danh mục</h1>
    <form method="POST">
        <label for="ten_dm">Tên danh mục:</label>
        <input type="text" name="ten_dm" id="ten_dm" value="<?php echo $row['ten_dm']; ?>" required>
        <button type="submit" name="update">Cập nhật</button>
    </form>
</div>