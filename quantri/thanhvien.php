

<?php
require "../config/ketnoi.php";
$sql="SELECT *FROM thanhvien ORDER BY id_thanhvien ASC";
$query=mysqli_query($conn,$sql);
?>
<link rel="stylesheet" type="text/css" href="css/thanhvien.css" />
<div class="table-container">
    <div class="row">
        <h1>Quản lý thành viên</h1>
        
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Hành động</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $row['id_thanhvien']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['mat_khau']; ?></td>
            <td>
                <a href="quantri.php?page_layout=sua_thanhvien&id=<?php echo $row['id_thanhvien']; ?>" class="btn-edit-thanhvien">Chỉnh sửa</a>
                <a href="xoa_thanhvien.php?id=<?php echo $row['id_thanhvien']; ?>" class="btn-delete-thanhvien" onclick="return confirm('Bạn có chắc chắn muốn xóa thành viên này?');">Xóa</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <!-- Add New Member Button -->
    <a href="quantri.php?page_layout=them_thanhvien" class="btn-add-thanhvien">Thêm thành viên</a>
</div>

