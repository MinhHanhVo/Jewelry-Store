<?php
    require "../config/ketnoi.php";

    // Handle status update
    if (isset($_POST['update_status'])) {
        $id_sp = $_POST['id_sp'];
        $trang_thai = $_POST['trang_thai'];
        
        // Update query
        $update_sql = "UPDATE sanpham SET trang_thai = '$trang_thai' WHERE id_sp = $id_sp";
        mysqli_query($conn, $update_sql);
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $rowsPerPage = 40;
    $perRow = $page * $rowsPerPage - $rowsPerPage;
    $sql = "SELECT sanpham.*, dmsanpham.ten_dm FROM sanpham INNER JOIN dmsanpham ON sanpham.id_dm = dmsanpham.id_dm LIMIT $perRow, $rowsPerPage";
    $query = mysqli_query($conn, $sql);
?>
<link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
<h2>Quản lý sản phẩm</h2>
<div id="main">
    <p id="add-prd"><a href="quantri.php?page_layout=themsp"><span>Thêm sản phẩm mới</span></a></p>
    <table id="prds" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr id="prd-bar">
            <td width="5%">ID</td>
            <td width="25%">Tên sản phẩm</td>
            <td width="15%">Giá</td>
            <td width="10%">Loại sản phẩm</td>
            <td width="10%">Ảnh mô tả</td>
            <td width="10%">Số lượng</td>
            <td width="15%">Tình trạng</td>
            <td width="5%">Sửa</td>
            <td width="5%">Xóa</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <form method="post">
                <td><span><?php echo $row['id_sp']; ?></span></td>
                <td class="l5"><?php echo $row['ten_sp']; ?></td>
                <td class="l5"><span class="price"><?php echo $row['gia_sp']; ?> VNĐ</span></td>
                <td class="l5"><?php echo $row['ten_dm'] ?></td>
                <td><span class="thumb"><img width="60" src="anh/<?php echo $row['anh_sp']; ?>" /></span></td>
                <td><span><?php echo $row['so_luong']; ?></span></td>
                <td>
                    <select name="trang_thai">
                        <option value="Còn hàng" <?php if ($row['trang_thai'] == 'Còn hàng') echo 'selected'; ?>>Còn hàng</option>
                        <option value="Lượng hàng trong kho thấp" <?php if ($row['trang_thai'] == 'Lượng hàng trong kho thấp') echo 'selected'; ?>>Lượng hàng trong kho thấp</option>
                        <option value="Hết hàng" <?php if ($row['trang_thai'] == 'Hết hàng') echo 'selected'; ?>>Hết hàng</option>
                    </select>
                    <input type="hidden" name="id_sp" value="<?php echo $row['id_sp']; ?>" />
                </td>
                <td><a href="quantri.php?page_layout=suasp&id_sp=<?php echo $row['id_sp']; ?>"><span>Sửa</span></a></td>
                <td><a href="xoasp.php?id_sp=<?php echo  $row['id_sp']; ?> " onclick="return checkDelete();"><span>Xóa</span></a></td>
                <td><input type="submit" name="update_status" value="Cập nhật" /></td>
            </form>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham"));
    $totalPage = ceil($totalRows / $rowsPerPage);
    $listPage = '';
    for ($i = 1; $i <= $totalPage; $i++) {
        if ($i == $page) {
            $listPage .= " <span>" . $i . "</span> ";
        } else {
            $listPage .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page_layout=danhsachsp&page=' . $i . '">' . $i . '</a> ';
        }
    }
    ?>
    <p id="pagination"><?php echo $listPage; ?></p>
</div>

<script type="text/javascript">
        function checkDelete() {
            return confirm("Bạn có muốn xóa sản phẩm này không?");
        }
</script>
