<?php
require "../cauhinh/ketnoi.php";

// Kiểm tra nếu người dùng đã gửi form thêm danh mục
if (isset($_POST['add'])) {
    $ten_dm = $_POST['ten_dm'];

    // Thêm danh mục mới vào cơ sở dữ liệu
    $sql = "INSERT INTO dmsanpham (ten_dm) VALUES ('$ten_dm')";
    if (mysqli_query($conn, $sql)) {
        echo "Thêm danh mục thành công!";
        header("Location: quantri.php?page_layout=danhmucsp");
        exit;
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

<link rel="stylesheet" type="text/css" href="css/them_sua_dm.css" />



    <div class="form-container">
        <h1>Thêm danh mục mới</h1>
        <form method="POST">
            <label for="ten_dm">Tên danh mục:</label>
            <input type="text" name="ten_dm" id="ten_dm" required>
            <button type="submit" name="add">Thêm danh mục</button>
        </form>
    </div>
