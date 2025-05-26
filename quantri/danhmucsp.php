<?php
require "../cauhinh/ketnoi.php";
$sql = "SELECT * FROM dmsanpham ORDER BY id_dm ASC";
$query = mysqli_query($conn, $sql);
?>
<link rel="stylesheet" type="text/css" href="css/danhmucsp.css" />
<div class="table-container">
    <div class="row">
        <h1>Quản lý danh mục</h1>
         
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Hành động</th> <!-- Cột mới cho các hành động -->
        </tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $row['id_dm']; ?></td>
            <td><?php echo $row['ten_dm']; ?></td>
            <td>
                <!-- Nút Chỉnh sửa -->
                <a href="quantri.php?page_layout=sua_danhmuc&id=<?php echo $row['id_dm']; ?>" class="btn btn-edit">Chỉnh sửa</a>
                
                <!-- Nút Xóa -->
                <a href="xoa_danhmuc.php?id=<?php echo $row['id_dm']; ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <!-- Nút Thêm danh mục -->
    <a href="quantri.php?page_layout=them_danhmuc" class="btn-them">Thêm danh mục</a>
</div>
