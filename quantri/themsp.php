<?php
require "../cauhinh/ketnoi.php";
$sql = "SELECT * FROM sanpham";
$query = mysqli_query($conn, $sql);
$error = NULL;

if (isset($_POST['submit'])) {
    // Bẫy lỗi cho các trường dữ liệu trong Form
    // Tên sản phẩm
    if ($_POST['ten_sp'] == '') {
        $error_ten_sp = '<span style="color:red;">Vui lòng nhập tên sản phẩm<span>';
    } else {
        $ten_sp = $_POST['ten_sp'];
    }
    // Giá sản phẩm
    if ($_POST['gia_sp'] == '') {
        $error_gia_sp = '<span style="color:red;">Vui lòng nhập giá sản phẩm<span>';
    } else {
        $gia_sp = $_POST['gia_sp'];
    }
    // Khuyến mãi
    if ($_POST['khuyen_mai'] == '') {
        $error_khuyen_mai = '<span style="color:red;">Vui lòng nhập khuyến mãi<span>';
    } else {
        $khuyen_mai = $_POST['khuyen_mai'];
    }
    // Trạng thái
    if ($_POST['trang_thai'] == '') {
        $error_trang_thai = '<span style="color:red;">Vui lòng nhập trạng thái<span>';
    } else {
        $trang_thai = $_POST['trang_thai'];
    }
    // Chi tiết sản phẩm
    if ($_POST['chi_tiet_sp'] == '') {
        $error_chi_tiet_sp = '<span style="color:red;">Vui lòng nhập chi tiết sản phẩm<span>';
    } else {
        $chi_tiet_sp = $_POST['chi_tiet_sp'];
    }
    // Ảnh mô tả sản phẩm
    if ($_FILES['anh_sp']['name'] == '') {
        $error_anh_sp = '<span style="color:red;">(*)<span>';
    } else {
        $anh_sp = $_FILES['anh_sp']['name'];
        $tmp_name = $_FILES['anh_sp']['tmp_name'];
    }
    // Danh mục sản phẩm
    if ($_POST['id_dm'] == 'unselect') {
        $error_id_dm = '<span style="color:red;">(*)<span>';
    } else {
        $id_dm = $_POST['id_dm'];
    }
    // Số lượng sản phẩm
    if ($_POST['so_luong'] == '' || !is_numeric($_POST['so_luong']) || $_POST['so_luong'] < 0) {
        $error_so_luong = '<span style="color:red;">Vui lòng nhập số lượng sản phẩm hợp lệ<span>';
    } else {
        $so_luong = $_POST['so_luong'];
    }
    // Sản phẩm đặc biệt
    $dac_biet = $_POST['dac_biet'];

    // Kiểm tra tất cả các giá trị
    if (isset($ten_sp) && isset($gia_sp) && isset($khuyen_mai) && isset($trang_thai) && isset($chi_tiet_sp) && isset($anh_sp) && isset($id_dm) && isset($so_luong) && isset($dac_biet)) {

        move_uploaded_file($tmp_name, 'anh/' . $anh_sp);
        $sql = "INSERT INTO sanpham (ten_sp, gia_sp, khuyen_mai, trang_thai, chi_tiet_sp, anh_sp, id_dm, so_luong, dac_biet) 
                VALUES ('$ten_sp', $gia_sp, '$khuyen_mai', '$trang_thai', '$chi_tiet_sp', '$anh_sp', $id_dm, $so_luong, $dac_biet)";

        $query = mysqli_query($conn, $sql);
        header('location:quantri.php?page_layout=danhsachsp');
    }
}
?>

<link rel="stylesheet" type="text/css" href="css/themsp.css" />
<h2>Thêm mới sản phẩm</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
        <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><label>Tên sản phẩm</label><br /><input type="text" name="ten_sp" /><?php if (isset($error_ten_sp)) {
                    echo $error_ten_sp;
                } ?></td>
            </tr>
            <tr>
                <td><label>Ảnh mô tả</label><br /><input type="file" name="anh_sp" /><?php if (isset($error_anh_sp)) {
                    echo $error_anh_sp;
                } ?></td>
            </tr>
            <tr>
                <td><label>Loại sản phẩm</label><br />
                    <select name="id_dm">
                        <option value="unselect" selected="selected">Lựa chọn danh mục sản phẩm</option>
                        <option value=1>Nhẫn</option>
                        <option value=2>Dây chuyền</option>
                        <option value=3>Bông tai</option>
                        <option value=4>Lắc tay</option>
                        <option value=5>Charm</option>
                        <option value=6>Kiềng</option>
                        <option value=7>Vòng</option>
                        <option value=8>Mặt dây chuyền</option>
                    </select>
                    <?php if (isset($error_id_dm)) {
                        echo $error_id_dm;
                    } ?>
                </td>
            </tr>
            <tr>
                <td><label>Giá sản phẩm</label><br /><input type="text" name="gia_sp" /> VNĐ <?php if (isset($error_gia_sp)) {
                    echo $error_gia_sp;
                } ?></td>
            </tr>
            <tr>
                <td><label>Khuyến mại</label><br /><input type="text" name="khuyen_mai" value="" /><?php if (isset($error_khuyen_mai)) {
                    echo $error_khuyen_mai;
                } ?></td>
            </tr>
            <tr>
                <td><label>Tình trạng</label><br /><input type="text" name="trang_thai" value="" /><?php if (isset($error_trang_thai)) {
                    echo $error_trang_thai;
                } ?></td>
            </tr>
            <tr>
                <td><label>Số lượng sản phẩm</label><br /><input type="text" name="so_luong" value="" /><?php if (isset($error_so_luong)) {
                    echo $error_so_luong;
                } ?></td>
            </tr>
            <tr>
                <td><label>Sản phẩm đặc biệt</label><br />Có <input type="radio" name="dac_biet" value=1 /> Không <input checked="checked" type="radio" name="dac_biet" value=0 /></td>
            </tr>
            <tr>
                <td><label>Thông tin chi tiết sản phẩm</label><br /><textarea cols="60" rows="12" name="chi_tiet_sp"></textarea><?php if (isset($error_chi_tiet_sp)) {
                    echo $error_chi_tiet_sp;
                } ?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Thêm mới" /> <input type="reset" name="reset" value="Làm mới" /></td>
            </tr>
        </table>
    </form>
</div>
